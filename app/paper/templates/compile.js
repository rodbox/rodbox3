paper.install(window);
/*** window.onload ***/

	window.onload = function() {
		paper.setup('myCanvas');
		var path;
		
	
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
/* End Function list */
/*** End window.onload ***/
}