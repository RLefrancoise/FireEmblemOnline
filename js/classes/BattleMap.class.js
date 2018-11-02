    Tileset2 = new Class({

        initialize: function(data) {
            var self = this;

            this.name = data.name;
            this.tileWidth = data.tilewidth;
            this.tileHeight = data.tileheight;
            this.tileproperties = data.tileproperties;
            this.firstgid = data.firstgid;

            this.image = new Image();
            this.image.onload = function() {
                if(!this.complete)
                    throw new Error("Erreur de chargement du tileset nommé \"" + data.image + "\".");

                // Largeur du tileset en tiles
                self.width = this.width / self.tileWidth;
            }
            this.image.src = "img/tilesets/" + data.image;
        }
    });

    Tile = new Class({
        initialize: function(number, tileset, x, y) {
            this.tileset = tileset;
            this.number = (number - this.tileset.firstgid + 1);
            this.x = x;
            this.y = y;
        },

        getProperties: function() {
            if(this.tileset.tileproperties === undefined) return {}

            if( (this.number - 1) in this.tileset.tileproperties) {
                return this.tileset.tileproperties[this.number - 1];
            } else {
                return {};
            }
        },

        draw: function(context, xScroll, yScroll) {
            var xSourceEnTiles = this.number % this.tileset.width;
            if(xSourceEnTiles == 0) xSourceEnTiles = this.tileset.width;
            var ySourceEnTiles = Math.ceil(this.number / this.tileset.width);

            var xSource = (xSourceEnTiles - 1) * this.tileset.tileWidth;
            var ySource = (ySourceEnTiles - 1) * this.tileset.tileHeight;

            context.drawImage(this.tileset.image, xSource, ySource, this.tileset.tileWidth, this.tileset.tileHeight, Math.floor(this.x * this.tileset.tileWidth - xScroll), Math.floor(this.y * this.tileset.tileHeight - yScroll), this.tileset.tileWidth, this.tileset.tileHeight);
        }
    });

    var CHARACTER_LAYER = 3;

    BattleMap = new Class({

        initialize: function(data, windowWidth, windowHeight, callback) {
            var self = this;

            self.cursor = new Image();
            self.cursor.onload = function() {
                if(!this.complete) throw new Error("Erreur de chargement du cursor img/cursor.png");
            }
            self.cursor.src = 'img/cursor64.png';

            self.edward = new Image();
            self.edward.src = 'img/units/edward/battle_tile2.png';

            self.cursorx = 0;
            self.cursory = 0;

            self.mousex = 0;
            self.mousey = 0;

            this.debug = false;

            this.windowWidth = windowWidth;
            this.windowHeight = windowHeight;
            this.entities = new Array();
            this.player = undefined;
            this.tilesets = [];
            this.grid = [];

            //for tile drawing, according to superposition etc...
            this.layer = [];
            for(var i = 0 ; i < 7 ; i++) {
                this.layer.push([]);
            }

            self.properties = data.properties;
            self.width = data.width;
            self.height = data.height;
            self.tileWidth = data.tilewidth;
            self.tileHeight = data.tileheight;
            self.windowTileWidth = self.windowWidth / self.tileWidth;
            self.windowTileHeight = self.windowHeight / self.tileHeight;

            self.xScroll = 0;
            self.yScroll = 0;

            //panorama
            if(self.properties && self.properties.panorama) {
                self.panorama = new Image();
                self.panorama.onload = function() {
                    if(!this.complete)
                        throw new Error("Erreur de chargement du panorama nommé \"" + self.properties.panorama + "\".");
                };

                self.panorama.src = 'panoramas/' + self.properties.panorama;
            }

            //tilesets
            for(var i = 0; i < data.tilesets.length ; i++) {
                self.tilesets.push(new Tileset2(data.tilesets[i]));
            }

            //build grid
            for(var y = 0 ; y < self.height ; y++) {
                self.grid.push([]);
                for(var x = 0 ; x < self.width ; x++) {
                    self.grid[y].push([]);
                }
            }

            for(var t = 0 ; t < self.width * self.height ; t++) {
                //iterate through each tile layer
                for(var l = 0 ; l < data.layers.length ; l++) {
                    var layer = data.layers[l];

                    if(!layer.visible) continue;
                    if(layer.type != "tilelayer") continue;

                    var x = t % self.width;
                    var y = (t - x) / self.width;

                    self.grid[y][x].push( (layer.data[t] != 0) ? new Tile(layer.data[t], self.getTilesetOfTile(layer.data[t]).tileset, x, y) : null );
                }
            }

            //tile drawing ordering
            for(var y = 0 ; y < self.height ; y++) {
                for(var x = 0 ; x < self.width ; x++) {
                    for(var k = 0 ; k < self.grid[y][x].length ; k++) {
                        var tile = self.grid[y][x][k];
                        if(tile === null) continue;

                        if(tile.getProperties().layer !== undefined)
                            self.layer[k + (tile.getProperties().layer * 3)].push(tile);
                        else
                            self.layer[k].push(tile);
                    }
                }
            }

            self.ready = true;

            if(callback) callback();
        },

        //getTilesetOfTile
        getTilesetOfTile: function(tile) {
            for(var ts = this.tilesets.length - 1; ts >= 0 ; ts--) {
                if(tile >= this.tilesets[ts].firstgid) {
                    return { tileset: this.tilesets[ts], index: ts }
                }
            }

            return false;
        },

        //isReady
        isReady: function() {
            return this.ready;
        },

        //getName
        getName: function() {
            return this.properties.name;
        },

        //isWalkable
        isWalkable: function(x, y) {
            var walkable = true;

            for(var k = 0 ; k < this.grid[y][x].length ; k++) {
                var tile = this.grid[y][x][k];

                if(tile === null) continue;

                //if tile is not walkable
                if(tile.getProperties().passable && tile.getProperties().passable == "0") {
                    return false;
                }
            }

            return walkable;
        },

        //getHeight
        getHeight: function() {
            return this.height;
        },

        //getWidth
        getWidth: function() {
            return this.width;
        },

        //draw
        draw: function(context) {
            if(!this.isReady()) return;

            //panorama
            if(this.panorama) context.drawImage(this.panorama, 0, 0, this.panorama.width, this.panorama.height, 0, 0, this.windowWidth, this.windowHeight);

            //sort entities
            this.layer[CHARACTER_LAYER].sort(function(a, b){
                if(a.getPositionTile().y < b.getPositionTile().y) return -1;
                if(a.getPositionTile().y > b.getPositionTile().y) return 1;
                else return 0;
            });

            //cursor scrolling
            var x_start = this.xScroll / this.tileWidth - 1;
            var y_start = this.yScroll / this.tileHeight - 1;
            var x_end = (this.xScroll + this.windowWidth) / this.tileWidth;
            var y_end = (this.yScroll + this.windowHeight) / this.tileHeight;

            if(this.cursorx + 1 > x_end) {
                this.xScroll += (this.cursorx + 1 - x_end) * this.tileWidth;
            }

            if(this.cursorx < x_start + 1) {
                this.xScroll -= (x_start + 1 - this.cursorx) * this.tileWidth;
            }

            if(this.cursory + 1 > y_end) {
                this.yScroll += (this.cursory + 1 - y_end) * this.tileHeight;
            }

            if(this.cursory < y_start + 1) {
                this.yScroll -= (y_start + 1 - this.cursory) * this.tileHeight;
            }

            x_start = this.xScroll / this.tileWidth - 1;
            y_start = this.yScroll / this.tileHeight - 1;
            x_end = (this.xScroll + this.windowWidth) / this.tileWidth;
            y_end = (this.yScroll + this.windowHeight) / this.tileHeight;


            if(this.xScroll > this.getWidth() * this.tileWidth - this.windowWidth ) this.xScroll = this.getWidth() * this.tileWidth - this.windowWidth ;
            if(this.yScroll > this.getHeight() * this.tileHeight - this.windowHeight ) this.yScroll = this.getHeight() * this.tileHeight - this.windowHeight ;
            if(this.xScroll < 0) this.xScroll = 0;
            if(this.yScroll < 0) this.yScroll = 0;

            //draw layers
            for(var i = 0 ; i < this.layer.length ; i++) {
                for(var j = 0 ; j < this.layer[i].length ; j++) {

                    //draw only tiles or characters inside view (scrolling)
                    var el = this.layer[i][j];

                    if(el.x >= x_start && el.x <= x_end && el.y >= y_start && el.y <= y_end) {
                        el.draw(context, this.xScroll, this.yScroll);
                    }
                }
            }

            //draw cursor
            context.drawImage(this.cursor, 0, 0, this.cursor.width, this.cursor.height, this.cursorx * this.tileWidth - this.xScroll, this.cursory * this.tileHeight - this.yScroll, this.cursor.width, this.cursor.height);

            //draw mouse tile
            context.fillStyle = "#888888";
            context.globalAlpha = 0.5;
            context.fillRect(Math.floor(this.mousex / this.tileWidth) * this.tileWidth, Math.floor(this.mousey / this.tileHeight) * this.tileHeight, this.tileWidth, this.tileHeight);
            context.globalAlpha = 1;

            context.drawImage(this.edward, 0, 0, this.edward.width, this.edward.height, this.cursorx * this.tileWidth - this.xScroll, this.cursory * this.tileHeight - this.yScroll, this.cursor.width, this.cursor.height);
            
            //debug
            if(this.debug){
                for(var y = 0 ; y < this.height ; y++) {
                    for(var x = 0 ; x < this.width ; x++) {
                        if(!this.isWalkable(x, y)) {
                            context.fillStyle = "#FF0000";
                            context.globalAlpha = 0.5;
                            context.fillRect(x * this.tileWidth, y * this.tileHeight, this.tileWidth, this.tileHeight);
                            context.globalAlpha = 1;
                        }
                    }
                }
            }
        },

        //addEntity
        addEntity: function(e) {
            this.entities.push(e);

            this.layer[CHARACTER_LAYER].push(e);
        },

        //removeEntity
        removeEntity: function(id) {
            var found1 = false, found2 = false;

            //remove from entities list
            for(var i = 0 ; i < this.entities.length ; i++) {
                if(this.entities[i].id == id) {
                    this.entities.splice(i, 1);
                    found1 = true;
                }
            }

            //remove from layer array
            for(var i = 0 ; i < this.layer[CHARACTER_LAYER].length ; i++) {
                if(this.layer[CHARACTER_LAYER][i].id == id) {
                    this.layer[CHARACTER_LAYER].splice(i, 1);
                    found2 = true;
                }
            }

            return found1 && found2;
        },

        //entityIsOnMap
        entityIsOnMap: function(id) {
            for(var i = 0 ; i < this.entities.length ; i++) {
                if(this.entities[i].id == id) return true;
            }

            return false;
        },

        //getEntity
        getEntity: function(id) {
            for(var i = 0 ; i < this.entities.length ; i++) {
                if(this.entities[i].id == id) return this.entities[i];
            }

            return false;
        },

        //setPlayer
        setPlayer: function(p) {
            this.player = p;
        },

        moveCursor: function(move) {
            console.log('move cursor : ' + move);
            switch(move) {
                case 'left':
                    if(this.cursorx > 0) this.cursorx--;
                    break;
                case 'right':
                    if(this.cursorx < this.getWidth() - 1) this.cursorx++;
                    break;
                case 'up':
                    if(this.cursory > 0) this.cursory--;
                    break;
                case 'down':
                    if(this.cursory < this.getHeight() - 1) this.cursory++;
                    break;
            }
        },

        mouseMove: function(mousex, mousey) {
            this.mousex = mousex;
            this.mousey = mousey;
        }
    });