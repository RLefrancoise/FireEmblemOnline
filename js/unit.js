function next_unit_info()
{
	var area = $('#unit_dynamic_area');

	var children = area.children();
	if(children.toArray().length <= 1) return;

	var elems = new Array();

	children.each(function(){
		var e = $(this);
		elems.push(e);
	});

	var index = 0;

	for(var i = 0 ; i < elems.length ; i++)
	{
		if(elems[i].css('display') == 'block')
		{
			index = i;
			elems[i].fadeTo(500, 0.0, function() {
				elems[index].css('display', 'none');
				if(index == elems.length - 1)
				{
					elems[0].css('display', 'block');
					elems[0].css('opacity', '1.0');
				}
				else
				{
					elems[index+1].css('display', 'block');
					elems[index+1].css('opacity', '1.0');

				}
			});
			break;
		}
	}
}

function previous_unit_info()
{
	var area = $('#unit_dynamic_area');

	var children = area.children();
	if(children.toArray().length <= 1) return;

	var elems = new Array();

	children.each(function(){
		var e = $(this);
		elems.push(e);
	});

	var index = 0;

	for(var i = 0 ; i < elems.length ; i++)
	{
		if(elems[i].css('display') == 'block')
		{
			index = i;
			elems[i].fadeTo(500, 0.0, function() {
				elems[index].css('display', 'none');
				if(index == 0)
				{
					elems[elems.length - 1].css('display', 'block');
					elems[elems.length - 1].css('opacity', '1.0');
				}
				else
				{
					elems[index-1].css('display', 'block');
					elems[index-1].css('opacity', '1.0');

				}
			});
			break;
		}
	}
}

function draw_biorhythm_wave(wave_json, turns_number, current_turn)
{
	wave_json = jQuery.parseJSON(wave_json);
	var currentDotSize = 1, dotSizeInc = 0.5, waveOpacity = 0.5, waveOpacityInc = 0.1;

	var c = document.getElementById("biorhythm_canvas");
	var ctx = c.getContext("2d");

	var startX = 10; //margin-left
	//var endX = 10; //margin-right

	var width = c.width - startX;
	var height = c.height;
	var centerY = c.height / 2;

	var waveXStep = Math.floor(width.toFixed(3) / turns_number.toFixed(3));

	var lineYStep = 20;

	ctx.lineCap = "butt";

	setInterval(function() {
		ctx.clearRect(0, 0, c.width, c.height);

		//draw center line
		ctx.beginPath();
		ctx.moveTo(startX,centerY);
		ctx.lineTo(width,centerY);
		ctx.lineWidth = 2;
		ctx.fillStyle = "#ffffff";
		ctx.strokeStyle = "#ffffff";
		ctx.fill();
		ctx.stroke();

		//draw status lines
		ctx.beginPath();
		ctx.moveTo(startX, centerY - lineYStep);
		ctx.lineTo(width,centerY - lineYStep);
		ctx.lineWidth = 1;
		ctx.fillStyle = "rgba(128,128,128,1)";
		ctx.strokeStyle = "rgba(128,128,128,1)";
		ctx.fill();
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo(startX, centerY - 2 * lineYStep);
		ctx.lineTo(width,centerY - 2 * lineYStep);
		ctx.lineWidth = 1;
		ctx.fillStyle = "rgba(128,128,128,1)";
		ctx.strokeStyle = "rgba(128,128,128,1)";
		ctx.fill();
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo(startX, centerY + lineYStep);
		ctx.lineTo(width,centerY + lineYStep);
		ctx.lineWidth = 1;
		ctx.fillStyle = "rgba(128,128,128,1)";
		ctx.strokeStyle = "rgba(128,128,128,1)";
		ctx.fill();
		ctx.stroke();

		ctx.beginPath();
		ctx.moveTo(startX, centerY + 2 * lineYStep);
		ctx.lineTo(width,centerY + 2 * lineYStep);
		ctx.lineWidth = 1;
		ctx.fillStyle = "rgba(128,128,128,1)";
		ctx.strokeStyle = "rgba(128,128,128,1)";
		ctx.fill();
		ctx.stroke();

		//build wave points array
		var currentWaveY = centerY;
		var dotx, doty;
		var points = new Array();
		var prev_status = '';

		for(var i = 1 ; i <= turns_number + 1; i++)
		{

			var status = (wave_json[i] != undefined) ? wave_json[i] : wave_json[1];

			if(prev_status != status)
			{
				if(i - 2 > 0)
				{
					points.push([(startX + (i - 2) * waveXStep), currentWaveY]);
				}
				else
				{
					points.push([startX, currentWaveY]);
				}

				switch(status)
				{
					case "best":
						currentWaveY = centerY - 2 * lineYStep;
						break;
					case "good":
						currentWaveY = centerY - lineYStep;
						break;
					case "normal":
						currentWaveY = centerY;
						break;
					case "bad":
						currentWaveY = centerY + lineYStep;
						break;
					case "worst":
						currentWaveY = centerY + 2 * lineYStep;
						break;
				}

				points.push([startX + (i - 1) * waveXStep, currentWaveY]);
			}

			if(i == current_turn)
			{
				dotx = startX + (i - 1) * waveXStep;
				doty = currentWaveY;
			}

			prev_status = status;
		}

		//draw wave

		for(i = 0 ; i < points.length - 1; i+=1)
		{
			ctx.beginPath();
			ctx.lineWidth = 1;
			ctx.strokeStyle = "rgba(0,255,255," + waveOpacity + ")";

			ctx.moveTo(points[i][0], points[i][1]);
			ctx.lineTo(points[i+1][0], points[i+1][1]);
			ctx.stroke();
		}

		ctx.beginPath();
		ctx.strokeStyle = "rgba(128,128,192,0.75)";
		ctx.fillStyle = "rgba(192,192,255,1)";
		ctx.lineWidth = 2;
		ctx.arc(dotx, doty, currentDotSize, 0, Math.PI * 2, false);
		ctx.fill();
		ctx.stroke();

		ctx.beginPath();
		ctx.strokeStyle = "rgba(128,128,192,0.5)";
		ctx.lineWidth = 2;
		ctx.arc(dotx, doty, currentDotSize * 2, 0, Math.PI * 2, false);
		ctx.stroke();

		ctx.beginPath();
		ctx.strokeStyle = "rgba(128,128,192,0.25)";
		ctx.lineWidth = 2;
		ctx.arc(dotx, doty, currentDotSize * 3, 0, Math.PI * 2, false);
		ctx.stroke();

		//animations stuff
		currentDotSize += dotSizeInc;
		if(currentDotSize > 3) {
			dotSizeInc = -dotSizeInc;
			currentDotSize = 2;
		} else if(currentDotSize < 1) {
			dotSizeInc = -dotSizeInc;
			currentDotSize = 1;
		}

		waveOpacity += waveOpacityInc;
		if(waveOpacity > 1) {
			waveOpacityInc = -waveOpacityInc;
			waveOpacity = 1;
		} else if(waveOpacity < 0.5) {
			waveOpacityInc = -waveOpacityInc;
			waveOpacity = 0.5;
		}
	}, 200);
}




function getControlPoints(x0,y0,x1,y1,x2,y2,t){
    //  x0,y0,x1,y1 are the coordinates of the end (knot) pts of this segment
    //  x2,y2 is the next knot -- not connected here but needed to calculate p2
    //  p1 is the control point calculated here, from x1 back toward x0.
    //  p2 is the next control point, calculated here and returned to become the
    //  next segment's p1.
    //  t is the 'tension' which controls how far the control points spread.

    //  Scaling factors: distances from this knot to the previous and following knots.
    var d01=Math.sqrt(Math.pow(x1-x0,2)+Math.pow(y1-y0,2));
    var d12=Math.sqrt(Math.pow(x2-x1,2)+Math.pow(y2-y1,2));

    var fa=t*d01/(d01+d12);
    var fb=t-fa;

    var p1x=x1+fa*(x0-x2);
    var p1y=y1+fa*(y0-y2);

    var p2x=x1-fb*(x0-x2);
    var p2y=y1-fb*(y0-y2);

    return [p1x,p1y,p2x,p2y]
}

function drawSpline(ctx,pts,t,closed){
    ctx.lineWidth=2;
    ctx.save();
    var cp=[];   // array of control points, as x0,y0,x1,y1,...
    var n=pts.length;

    if(closed){
        //   Append and prepend knots and control points to close the curve
        pts.push(pts[0],pts[1],pts[2],pts[3]);
        pts.unshift(pts[n-1]);
        pts.unshift(pts[n-1]);
        for(var i=0;i<n;i+=2){
            cp=cp.concat(getControlPoints(pts[i],pts[i+1],pts[i+2],pts[i+3],pts[i+4],pts[i+5],t));
        }
        cp=cp.concat(cp[0],cp[1]);
        for(var i=2;i<n+2;i+=2){
            var color="cyan";
            ctx.strokeStyle="cyan";
            ctx.beginPath();
            ctx.moveTo(pts[i],pts[i+1]);
            ctx.bezierCurveTo(cp[2*i-2],cp[2*i-1],cp[2*i],cp[2*i+1],pts[i+2],pts[i+3]);
            ctx.stroke();
            ctx.closePath();
        }
    }else{
        // Draw an open curve, not connected at the ends
        for(var i=0;i<n-4;i+=2){
            cp=cp.concat(getControlPoints(pts[i],pts[i+1],pts[i+2],pts[i+3],pts[i+4],pts[i+5],t));
        }
        for(var i=2;i<pts.length-5;i+=2){
            var color="cyan";
            ctx.strokeStyle="cyan";
            ctx.beginPath();
            ctx.moveTo(pts[i],pts[i+1]);
            ctx.bezierCurveTo(cp[2*i-2],cp[2*i-1],cp[2*i],cp[2*i+1],pts[i+2],pts[i+3]);
            ctx.stroke();
            ctx.closePath();
        }
        //  For open curves the first and last arcs are simple quadratics.
        var color="cyan";  // brown
        ctx.strokeStyle="cyan";
        ctx.beginPath();
        ctx.moveTo(pts[0],pts[1]);
        ctx.quadraticCurveTo(cp[0],cp[1],pts[2],pts[3]);
        ctx.stroke();
        ctx.closePath();

        var color="cyan";  // indigo
        ctx.strokeStyle="cyan";
        ctx.beginPath();
        ctx.moveTo(pts[n-2],pts[n-1]);
        ctx.quadraticCurveTo(cp[2*n-10],cp[2*n-9],pts[n-4],pts[n-3]);
        ctx.stroke();
        ctx.closePath();
    }
    ctx.restore();
}