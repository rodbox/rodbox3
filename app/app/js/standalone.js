jQuery(document).ready(function($) {
	
	if(window.navigator.standalone){
		if (localStorage.session == "true") {
			var data = {
			 	user: {
			    		id 	: localStorage.id,
			    		user	: localStorage.user,
			    		name	: localStorage.user,
			  }
			};
			$.get("http://rodbox.fr/app/app-session.php", data, function() {
			    	if (window.location.search == "") {
			      		window.location.href = localStorage.current;
			    	}
			},"JSON");
		}
		
	}
});