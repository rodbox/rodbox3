$(document).ready(function(){
/* Source = http://stackoverflow.com/questions/3326494/parsing-css-in-javascript-jquery */
/* Je l'ai modifier pour detecter les alias selecteurs. */
/* Cela retourne les alias de facons independante mais rajoute un index alias avec la liste des selecteur alias et un compteur pour ne pas avoir a le faire a chaque fois. */

$.appcss = {
	parseCSS: function(css) {
	    var rules = {};
	    css = this.removeComments(css);
	    var blocks = css.split('}');
	    blocks.pop();
	    var len = blocks.length;
	    for (var i = 0; i < len; i++)
	    {
	        var pair = blocks[i].split('{');
	        
	        /* On sépare les alias selecteurs */
	        rulesAlias = pair[0].split(',');
	        var lenAlias = rulesAlias.length;
	        /* Pour tout les alias selecteurs */
	        for(var y = 0; y < lenAlias; y++) {
	        	/* Suppression des espaces indésirable du selecteur */
	        	var val = rulesAlias[y].replace(/\n/g,"");
	        	/* On attribut les regles css sous forme de tableau au selecteur qui sert d'index */
	        	rules[val] = this.parseCSSBlock(pair[1]);
	        	/* Si il y a des alias */
	        	if(lenAlias>1){
	        		rules[val]["alias"]= [];
	        		rules[val]["alias"]["selector"]=rulesAlias; /* contient les selecteurs de tout les alias */
	        		rules[val]["alias"]["count"]=lenAlias; /* compteur des alias */
	        	}
	        	/* Si il n'y a pas d'alias */
	        	else
	        		rules[val]["alias"]=false;
	        }
	    }
	    return rules;
	},
	parseCSSBlock: function(css) { 
	    var rule = {};
	    var declarations = css.split(';');
	    declarations.pop();
	    var len = declarations.length;
	    for (var i = 0; i < len; i++)
	    {
	        var loc = declarations[i].indexOf(':');
	        var property = $.trim(declarations[i].substring(0, loc));
	        var value = $.trim(declarations[i].substring(loc + 1));

	        if (property != "" && value != "")
	            rule[property] = value;
	    }
	    return rule;
	},
	removeComments: function(css) {
	    return css.replace(/\/\*(\r|\n|.)*\*\//g,"");
	}
}

	/* Création de la liste a partir du fichier css */
	/* Les fichiers css a parser */
	var icomoon = "css/icomoon/style.css";
	var simplelineicons = "css/simple-line-icons/simple-line-icons.css";
	var fontAW = "css/font-awesome/css/font-awesome.css";
	var bootstrap = "css/bootstrap/css/bootstrap.css";
	var code = "css/code/style.css";
	/* Fin des fichiers css a parser */

	$.get(code, function(data) {
		var r = $('.result');
		var ul = $("<ul>",{"id":"code","class":"list-icon localsearch"});
		// var cssWithoutComment = $.appcss.removeComments(data);
		var cssRules = $.appcss.parseCSS(data);

		$.each(cssRules, function(index, val) {
			// on ne recherche que les selecteurs :before
			if(index.search(":before")>0){
				/* Construction de la liste */
				var className = index.replace(":before","");
				className = className.replace(".","");
				var i = $('<i>',{'class':className,'data-hex':val.content});
				var li = $('<li>');
				li.append(i);
				li.append(className);
				if (val.alias){
					var helper = val.alias.selector;
					var selector="";
					for (var i = helper.length - 1; i >= 0; i--) {
						selector = helper[i].replace(":before","").replace(".","")+" | "+selector;
					};
					selector = selector.substring(0,selector.length-2);
					li.append("<br><small class='help' title='"+selector+"'>"+val.alias.count+" alias</small> ");
				}
				ul.append("\n\t");
				ul.append(li);
				/* Fin de Construction de la liste */	
			}
		});
		/* Insertion de la liste */	
		r.html(ul);
	});

});