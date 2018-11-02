<?php

echo script_tag('js/canvasengine/core/engine-common.js', 'text/javascript') . PHP_EOL;
echo script_tag('js/canvasengine/canvasengine-1.3.2.all.min.js', 'text/javascript') . PHP_EOL;
echo script_tag('js/canvasengine/extends/Tiled.js', 'text/javascript') . PHP_EOL;
echo script_tag('js/map.js', 'text/javascript') . PHP_EOL;

?>

<script type="text/javascript">
	var canvas = CE.defines('canvas_id').
		extend(Tiled).
		extend(Input).
		extend(Scrolling).
		ready(function() {
		  canvas.Scene.call('MapScene');
		});

	loadMap('<?php echo $mapName ?>', false);
</script>

<canvas id="canvas_id" width="320" height="240"></canvas>