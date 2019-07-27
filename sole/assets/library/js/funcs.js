function pseudo(id,css){
    id = id+"-pseudoStyle";
    var element = document.getElementById(id);
    if(element == null){
        styleTag = document.createElement("style");
        styleTag.id = id;
        styleTag.innerHTML = css;
        document.getElementsByTagName("head")[0].appendChild(styleTag);
    }else{
        element.innerHTML = css;
    }
}

jQuery(function($){
	//tap
	$.fn.tap = function(func,selector){
		var moveflag = 0;
		var count = 0;
		var fOption = {
			touchstart:function(){
				count = 1;
				moveflag = 0;
			},
			touchmove:function(){
				moveflag = 1;
			},
			touchend:function(e){
				if(moveflag == 0){
					func(e,$(this));
				}
			},
			click:function(e){
				if(count == 0){
					func(e,$(this));
				}
				count = 0;
			}
		};
		if(typeof selector === "undefined"){
			$(this).on(fOption);
		}else{
			$(this).on(fOption,selector);
		}
		return this;
	}

	//scroll
	$.fn.smooth = function(selector,speed){
		var sp = typeof selector === "number" ? selector : $(selector).offset().top;
		var speed = typeof speed !== "undefined" ? speed : 1000;
		$(this).tap(function(e){
			e.preventDefault();
			$("body,html").animate({scrollTop:sp},speed);
		});
		return this;
	}

	//height
	$.fn.syncHeight = function(selector){
	    var h = $(selector).outerHeight();
	    $(this).height(h);
	    return this;
	}
});