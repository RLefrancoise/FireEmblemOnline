function loadMap(mapName, mapData) {

	canvas.Scene.new({
		//attributes
		name: 'MapScene',
		materials: {
			images: {
				swamp: base_url + 'img/tilesets/swamp.png',
				swamp2: base_url + 'img/tilesets/swamp2.png',
				ch7x_tileset: base_url + 'img/tilesets/ch7x_tileset.png',
				cursor: base_url + 'img/cursor2.png'
			}
		},
		
		//functions
		
		//-- ready (initialize)
		ready: function(stage) {
		
			var self = this;
			
			//cursor
			this.cursor = this.createElement();
			this.cursor.drawImage("cursor");
			this.cursor.x = 0;
			this.cursor.y = 0;
			
			//map
			this.map = this.createElement();
			
			
			this.tiled = canvas.Tiled.new();
			this.tiled.load(this, this.map, base_url + 'files/maps/' + mapName + '.json');
			
			this.tiled.ready(function() {
				var tileW = this.getTileWidth(),
				tileH = this.getTileHeight(),
				width = this.getWidthPixel(),
				height = this.getHeightPixel(),
				layerObj = this.getLayerObject();
				
				console.log('map ' + mapName + ' ready : ', width, height, tileW, tileH, layerObj);
				
				//scrolling
				self.scrolling = canvas.Scrolling.new(self, tileH, tileW);
				self.scrolling.setMainElement(self.cursor);
				
				self.scrolling.addScroll({
					element: self.map,
					speed: tileW,
					block: true,
					width: this.getWidthPixel(),
					height: this.getHeightPixel()
					
				});
				
				//keyboard events
				canvas.Input.keyDown(Input.Right, function() {
					self.cursor.x += tileW;
					if(self.cursor.x >= width) self.cursor.x = width - tileW;
				});
				
				canvas.Input.keyDown(Input.Left, function() {
					self.cursor.x -= tileW;
					if(self.cursor.x < 0) self.cursor.x = 0;
				});
				
				canvas.Input.keyDown(Input.Up, function() {
					self.cursor.y -= tileH;
					if(self.cursor.y < 0) self.cursor.y = 0;
				});
				
				canvas.Input.keyDown(Input.Bottom, function() {
					self.cursor.y += tileH;
					if(self.cursor.y >= height) self.cursor.y = height - tileH;
				});
				
				
				
				self.map.append(self.cursor);
			});
			
			stage.append(this.map);
		},
		
		render: function(stage) {
			//scrolling
			if(this.scrolling) this.scrolling.update();
			
			//refresh stage
			stage.refresh();
		}
	
	});
}