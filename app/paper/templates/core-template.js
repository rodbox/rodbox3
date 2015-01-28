paper.install(window);
/*** window.onload ***/

	window.onload = function() {
		paper.setup('myCanvas');
		var path;
		
	[TOOLLIST]




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