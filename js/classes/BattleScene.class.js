    HUD = new Class({
        initialize: function(scene) {
            this.scene = scene;
            this.image = new Image();
            this.image.src = "public/sprites/yuki.png";
        },

        _drawPlayerInfo: function(ctx) {
            //draw face
            ctx.beginPath();
            ctx.rect(5, 5, this.image.width / 4, this.image.height / 16);
            ctx.fillStyle = '#000000';
            ctx.fill();
            ctx.strokeStyle = "#888888";
            ctx.lineWidth = 1;
            ctx.stroke();

            ctx.drawImage(this.image, 0, 0, this.image.width / 4, this.image.height / 16, 5 , 5, this.image.width / 4, this.image.height / 16);

            //draw life bar
            var barWidth = 50, barHeight = this.image.height / 32;
            var grd = ctx.createLinearGradient(5 + this.image.width / 4 + 5, 5, 5 + this.image.width / 4 + 5 + barWidth, 5);


            grd.addColorStop(0, '#880000');
            grd.addColorStop(1, '#FF0000');
            ctx.fillStyle = grd;
            ctx.fillRect(5 + this.image.width / 4 + 5, 5, barWidth, barHeight);

            ctx.beginPath();
            ctx.rect(5 + this.image.width / 4 + 5, 5, barWidth / 2, barHeight);
            grd.addColorStop(0, '#008800');
            grd.addColorStop(1, '#00FF00');
            ctx.fillStyle = grd;
            ctx.fill();

            ctx.beginPath();
            ctx.rect(5 + this.image.width / 4 + 5, 5 + barHeight, barWidth, barHeight);
            ctx.strokeStyle = 'black';
            ctx.lineWidth = 1;
            ctx.stroke();

            //draw mana bar
            var barWidth = 50, barHeight = this.image.height / 32;
            var grd = ctx.createLinearGradient(5 + this.image.width / 4 + 5, 5 + barHeight, 5 + this.image.width / 4 + 5 + barWidth, 5 + barHeight);

            ctx.beginPath();
            grd.addColorStop(0, '#880000');
            grd.addColorStop(1, '#FF0000');
            ctx.fillStyle = grd;
            ctx.fillRect(5 + this.image.width / 4 + 5, 5 + barHeight, barWidth, barHeight);


            ctx.beginPath();
            ctx.rect(5 + this.image.width / 4 + 5, 5 + barHeight, barWidth / 3, barHeight);
            grd.addColorStop(0, '#000088');
            grd.addColorStop(1, '#0000FF');
            ctx.fillStyle = grd;
            ctx.fill();

            ctx.rect(5 + this.image.width / 4 + 5, 5 + barHeight, barWidth, barHeight);
            ctx.strokeStyle = 'black';
            ctx.lineWidth = 1;
            ctx.stroke();
        },
        draw: function(ctx) {
            this._drawPlayerInfo(ctx);
        }
    });

    BattleScene = new Class({
        initialize: function(canvas) {
            var self = this;

            this.map = null;
            this.player = null;
            this.canvas = null;
            //this.hud = new HUD(this);

            this.canUpdate = true;
            this.playerIsSpawned = false;

            this.canvas = canvas; //document.getElementById('canvas');
            this.canvas.receiveInput = true; // custom value to handle input or not
            this.canvas.tabIndex = 1000; //to use key events

            this.mousex = 0;
            this.mousey = 0;

            var ctx = this.canvas.getContext('2d');
            ctx.font = 'normal 10pt Arial';

            // Gestion du clavier
            this.canvas.addEventListener('keyup', function(event) { Key.onKeyup(event); }, false);
            this.canvas.addEventListener('keydown', function(event) { Key.onKeydown(event); }, false);

            //rendering loop (25 fps)
            function updateLoop(timestamp) {
                self.update(timestamp);

                ctx.clearRect(0,0, this.canvas.width, this.canvas.height);

                if(self.map && self.map.isReady()) {
                    self.map.draw(ctx);

                    ctx.font = 'bold 14pt Arial';
                    ctx.fillStyle = '#ffffff';
                    ctx.textAlign = 'center';
                    ctx.fillText(self.map.getName(), self.canvas.width - ctx.measureText(self.map.getName()).width - 5, 25);

                    if(self.map.debug) {
                        ctx.textAlign = 'left';
                        //player position
                        if(self.player) {
                            ctx.fillText('Player TX : ' + self.player.getPositionTile().x + ' TY : ' + self.player.getPositionTile().y + ' X: ' + self.player.getPixelPosition().x + ' Y: ' + self.player.getPixelPosition().y, 5, 45);
                            ctx.fillText('xOffset : ' + self.player.xOffset + ' yOffset : ' + self.player.yOffset, 5, 65);
                        }

                        //map scroll
                        ctx.fillText('xScroll : ' + self.map.xScroll + ' yScroll : ' + self.map.yScroll, 5, 25);
                        ctx.fillText('cursor X : ' + self.map.cursorx + ' cursor Y : ' + self.map.cursory, 5, 50);
                        ctx.fillText('mouse X : ' + self.mousex + ' mouse Y : ' + self.mousey, 5, 75);
                    }
                }

                //self.hud.draw(ctx);
                //if(self.map) self.hud.draw(ctx);
                requestAnimationFrame(updateLoop);
            }

            requestAnimationFrame(updateLoop);

            this.canvas.onkeydown = function(event) {
                var e = event || window.event;
                var key = e.which || e.keyCode;

                switch(key) {
                    case Key.X:
                        if(self.canvas.receiveInput && self.player) self.player.attack();
                        break;
                    case Key.Space:
                        if(self.canvas.receiveInput && self.player) self.player.displayData = !self.player.displayData;
                        else return true;
                        break;
                    case Key.BackSpace:
                        if(self.canvas.receiveInput && self.map) self.map.debug = !self.map.debug;
                        else return true;
                        break;
                    case Key.Left:
                        self.map.moveCursor('left');
                        return false;
                    case Key.Right:
                        self.map.moveCursor('right');
                        return false;
                    case Key.Up:
                        self.map.moveCursor('up');
                        return false;
                    case Key.Down:
                        self.map.moveCursor('down');
                        return false;
                    default :
                        //alert(key);
                        // Si la touche ne nous sert pas, nous n'avons aucune raison de bloquer son comportement normal.
                        return true;
                }

                return false;
            };

            this.canvas.onmousemove = function(event) {
                var e = event || window.event;

                self.mousex = e.clientX - canvas.getBoundingClientRect().left;
                self.mousey = e.clientY - canvas.getBoundingClientRect().top;

                self.map.mouseMove(self.mousex, self.mousey);
                return false;
            }
        },

        update: function(timestamp) {
            var self = this;

            if(!self.canvas.receiveInput) return;
        },

        destroy: function() {
            var self = this;

            self.map = null;
            self.player = null;
        },

        load_map: function(mapData) {
            this.map = new BattleMap(mapData, self.canvas.width, self.canvas.height);
        }
    });