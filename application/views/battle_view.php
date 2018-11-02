<div style="width:960px;height:720px;margin:auto;padding:10px;">
    <canvas id="canvas" width="960" height="720" style="border:1px solid black;">Votre navigateur ne supporte pas HTML5, veuillez le mettre à jour pour jouer.</canvas>
</div>

<script type="text/javascript">

loadJSCallback = function() {
    console.log('ready');

    var scene = new BattleScene(document.getElementById('canvas'));

    $.getJSON('map/load', {
        mapName: 'map1_64'
    }).done(function(data) {
        if(data.success) {
            console.log('load map');
            scene.load_map(data.data);
        } else {
            alert(data);
        }

    }).fail(function(error) {
        alert(error);
    });
}
</script>