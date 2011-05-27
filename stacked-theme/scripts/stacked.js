(function($){
	$.fn.scrollingDiv = function() {
		var $this = this;
		$(window).scroll(function(){
			$this.css( {"top": ($(window).scrollTop()) + "px"} );
		});
	}
})(jQuery);

jQuery(document).ready(function($){
	$('#locked-navigation').scrollingDiv();
});