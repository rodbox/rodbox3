paper.install(window);
/*** window.onload ***/

	window.onload = function() {
		paper.setup('myCanvas');
		var path;
		
	
/*** circle ***/
circle = new Tool();

	circle.onFrame = function(event){
		
	};
	circle.onResize = function(event){
		
	};
	circle.onMouseDown = function(event){
		
	};
	circle.onMouseDrag = function(event){
		var path = new Path.Circle({
                    center: event.downPoint,
                    radius: (event.downPoint - event.point).length
                    
                });
            if (colorFill()!=""){
                path.fillColor = colorFill();
                
                }
            if (colorStroke()!=""){
                path.strokeColor =  colorStroke();
            
                }
            path.removeOnDrag();
	};
	circle.onMouseMove = function(event){
		
	};
	circle.onMouseUp = function(event){
		
	};
	circle.onKeyDown = function(event){
		
	};
	circle.onKeyUp  = function(event){
		
	};
/*** end circle ***/


/*** dist ***/
dist = new Tool();

	dist.onFrame = function(event){
		
	};
	dist.onResize = function(event){
		
	};
	dist.onMouseDown = function(event){
		path = new Path();
                path.strokeColor = colorFill();
newCircle(event.point.x,event.point.y,6);
	};
	dist.onMouseDrag = function(event){
		path.add(event.point);
                path.dashArray = [10, 5]; 
	};
	dist.onMouseMove = function(event){
		
	};
	dist.onMouseUp = function(event){
		newCircle(event.point.x,event.point.y,6);
	};
	dist.onKeyDown = function(event){
		
	};
	dist.onKeyUp  = function(event){
		
	};
/*** end dist ***/


/*** drawsimple ***/
drawsimple = new Tool();

	drawsimple.onFrame = function(event){
		
	};
	drawsimple.onResize = function(event){
		
	};
	drawsimple.onMouseDown = function(event){
		 path = new Path();
               path.strokeColor = colorFill();
               path.add(event.point); 
	};
	drawsimple.onMouseDrag = function(event){
		path.add(event.middlePoint);
                
               path.smooth();
	};
	drawsimple.onMouseMove = function(event){
		
	};
	drawsimple.onMouseUp = function(event){
		
	};
	drawsimple.onKeyDown = function(event){
		
	};
	drawsimple.onKeyUp  = function(event){
		
	};
/*** end drawsimple ***/


/*** move ***/
move = new Tool();

	move.onFrame = function(event){
		
	};
	move.onResize = function(event){
		
	};
	move.onMouseDown = function(event){
		project.activeLayer.selected = false;
    if (event.item)
        event.item.selected = true;

     console.log(project.activeLayer);
var hitOptions = {
    segments: true,
    stroke: true,
    fill: true,
    tolerance: 10
};

segment = path = null;
    var hitResult = project.hitTest(event.point, hitOptions);
    if (!hitResult)
        return;

    if (event.modifiers.shift) {
        if (hitResult.type == 'segment') {
            hitResult.segment.remove();
        };
        return;
    }

    if (hitResult) {
        path = hitResult.item;
        if (hitResult.type == 'segment') {
            segment = hitResult.segment;
        } else if (hitResult.type == 'stroke') {
            var location = hitResult.location;
            segment = path.insert(location.index + 1, event.point);
            //path.smooth();
        }
    }
    movePath = hitResult.type == 'fill';
    if (movePath)
        project.activeLayer.addChild(hitResult.item);

	};
	move.onMouseDrag = function(event){
		if (segment) {
        segment.point = event.point;
       // path.smooth();
    }

    if (movePath)
        path.position += event.delta;

	};
	move.onMouseMove = function(event){
		
	};
	move.onMouseUp = function(event){
		
	};
	move.onKeyDown = function(event){
		
	};
	move.onKeyUp  = function(event){
		
	};
/*** end move ***/


/*** rail ***/
rail = new Tool();

	rail.onFrame = function(event){
		
	};
	rail.onResize = function(event){
		
	};
	rail.onMouseDown = function(event){
		tool.fixedDistance = 10;

path = new Path();
                path.strokeColor = colorFill();
                path.add(event.point);
	};
	rail.onMouseDrag = function(event){
		            path.add(event.point);

                var step = event.delta;
                step.angle += 90;
            
                var top = event.middlePoint + step;
                var bottom = event.middlePoint - step;
                
                var line = new Path();
                line.strokeColor = colorFill();
                line.add(top);
                line.add(bottom);
                 path.smooth();
	};
	rail.onMouseMove = function(event){
		
	};
	rail.onMouseUp = function(event){
		
	};
	rail.onKeyDown = function(event){
		
	};
	rail.onKeyUp  = function(event){
		
	};
/*** end rail ***/


/*** rect ***/
rect = new Tool();

	rect.onFrame = function(event){
		
	};
	rect.onResize = function(event){
		
	};
	rect.onMouseDown = function(event){
		
	};
	rect.onMouseDrag = function(event){
		 var path = new Path.Rectangle({
    point: [event.downPoint.x, event.downPoint.y],
    size: [event.point.x-event.downPoint.x, event.point.y-event.downPoint.y]
});
 if (colorFill()!=""){
                path.fillColor = colorFill();
                path.fillColor.alpha = alphaFill();
                }
            if (colorStroke()!=""){
                path.strokeColor =  colorStroke();
            path.strokeColor.alpha = alphaStroke();
                }
               path.removeOnDrag();
	};
	rect.onMouseMove = function(event){
		
	};
	rect.onMouseUp = function(event){
		
	};
	rect.onKeyDown = function(event){
		
	};
	rect.onKeyUp  = function(event){
		
	};
/*** end rect ***/


/*** roulette ***/
roulette = new Tool();

	roulette.onFrame = function(event){
		pathTroubleRoulette.rotate(10);
	};
	roulette.onResize = function(event){
		
	};
	roulette.onMouseDown = function(event){
		pathTroubleRoulette = new Path();

                pathTroubleRoulette.fillColor = colorFill();
                pathTroubleRoulette.strokeColor = colorFill();
                pathTroubleRoulette.add(event.point); 
	};
	roulette.onMouseDrag = function(event){
		 var step = event.delta / 2;
                step.angle += 90;
                
                var top = event.middlePoint + step;
                var bottom = event.middlePoint - step;
                
                pathTroubleRoulette.add(top);
                pathTroubleRoulette.insert(bottom, top-2);
              //  pathTroubleRoulette.smooth();
                pathTroubleRoulette.rotate(10);
	};
	roulette.onMouseMove = function(event){
		
	};
	roulette.onMouseUp = function(event){
		  pathTroubleRoulette.add(event.point);

                 pathTroubleRoulette.smooth();
	};
	roulette.onKeyDown = function(event){
		
	};
	roulette.onKeyUp  = function(event){
		
	};
/*** end roulette ***/


/*** round ***/
round = new Tool();

	round.onFrame = function(event){
		
	};
	round.onResize = function(event){
		
	};
	round.onMouseDown = function(event){
		tool.fixedDistance = 10;
	};
	round.onMouseDrag = function(event){
		 var myCircle = new Path.Circle({
                    radius: event.delta.length / 4,
                    center: event.middlePoint
                });

                myCircle.fillColor = colorFill();
	};
	round.onMouseMove = function(event){
		
	};
	round.onMouseUp = function(event){
		
	};
	round.onKeyDown = function(event){
		
	};
	round.onKeyUp  = function(event){
		
	};
/*** end round ***/


/*** selection ***/
selection = new Tool();

	selection.onFrame = function(event){
		
	};
	selection.onResize = function(event){
		
	};
	selection.onMouseDown = function(event){
		
	};
	selection.onMouseDrag = function(event){
		
                var downPointX = event.downPoint.x;
                var downPointY = event.downPoint.y;
                var sizeX = event.point.x-downPointX;
                var sizeY = event.point.y-downPointY;

               var path = new Path.Rectangle({
                point: [downPointX,downPointY],
                size: [sizeX, sizeY]
                });

            path.fillColor = "black";
            path.fillColor.alpha = "0.1";
            path.strokeColor =  "grey";
            path.strokeWidth =  "1";
            path.strokeJoin = 'round';
            path.dashArray = [5, 5];
          /*  path.miterLimit(1);*/
            path.removeOnDrag();
            path.removeOnUp();

var textX = new PointText({
    point: [downPointX+(sizeX/2), downPointY+13],
    content:  Math.abs(sizeX),
    fillColor: 'black',

    justification: 'center',
    fontSize:13
}).removeOnDrag().removeOnUp();

var textY = new PointText({
    point: [downPointX+11, downPointY+(sizeY/2)],
    content:  Math.abs(sizeY),
    fillColor: 'black',
    justification: 'center',
    fontSize:13
}).rotate(-90).removeOnDrag().removeOnUp();
	};
	selection.onMouseMove = function(event){
		
	};
	selection.onMouseUp = function(event){
		
	};
	selection.onKeyDown = function(event){
		
	};
	selection.onKeyUp  = function(event){
		
	};
/*** end selection ***/






/* Function list */
	function addLayerToList(data){
	   
	}

	function colorFill(){
	    return "#000";
	}
	function colorStroke(){
	    return "#000";
	}

	function alphaFill(){
	    return 1;
	}

	function alphaStroke(){
	    return 1;
	}

	function newCircle(x,y,radius){
    	var path = new Path.Circle({
	    	center: [x, y],
	    	radius: radius,
	    	fillColor :colorFill(),
	    	strokeColor: colorStroke()
		});
    }
/* End Function list */
/*** End window.onload ***/
}