// valide un formulaire par etape generer par le mod-form.
$.validate = {
	req			: function (value){
		return (value);
	},
	mail		: function (email){
		var regexp = /^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i;
	 	return regexp.test(email);
	},
	int			: function (value){
		var regexp = /^[0-9]+$/;
		regexp.test(value);
	},
	reg			: function (value,regexp){
		regexp.test(value);
	},
	alpha_num	: function (value){
		var regexp = /^[0-9a-zA-Z]+$/;
		regexp.test(value);
	},
	min			: function (value,min){
		return (value.length>=min);
	},
	max			: function (value,max){
		return (value.length<=max);
	},
	equal		: function (value,equal){
		return (value==equal);
	},
	url			: function (url){
		var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	    return regexp.test(url);
	},
	ip			: function (ip){
		var regexp = /\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/;
		return regexp.test(ip);
	},
	date		: function (value,meta){
		return true;
	},
	tel			: function (tel,meta){
		var regexp = /^0[0-9]([-. ]?\d{2}){4}[-. ]?$/;
		return regexp.test(tel);
	}
}

	/**/
	$.validateStep = function (stepID){
		var error = 0;
		var validateList = $("#"+stepID).find(".validate");

		$.each(validateList, function(indexValidateList, valItem) {
			var item = $(valItem);
			var item = $(valItem);
			var itemError = itemValidate(item)
			error = error + itemError;
		});

		return (error==0);
	}

	$.validateForm = function (selector){
		console.log(selector);
		var error = 0;
		var validateList = $(selector).find(".validate");

		$.each(validateList, function(indexValidateList, valItem) {
			var item = $(valItem);
			var itemError = itemValidate(item)
			error = error + itemError;
		});
		return (error==0);
	}

	/* Fonction validate */
	function itemValidate(item){
		var validateListItem = item.data("validate");
		    var error = 0;
		    var value = (item.val()=="")?"":item.val();
		    $.each(validateListItem.split("|"), function(indexValidate, validateID) {

				if (value!="" || validateID == "req"){
					var valueData = (item.data(validateID)==undefined)?"":item.data(validateID);
					/* Une exception pour equal */
				    if(validateID=="equal")
					valueData = $("[name="+valueData+"]").val();
					var funcEval = "$.validate."+validateID+"('"+value+"','"+valueData+"');";
					console.log(eval(funcEval));
					if(!eval(funcEval)){
						error++;
						item.parents(".form-item").addClass("form-item-alert").find(".bt-popover").popover('show');;
					}
				}
			});
			return error;
	}

	$(document).on("focusout",".validate",function (e){
	    itemValidate($(this));
	})
