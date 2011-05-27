(function($){
	$.fn.scrollingDiv = function() {
		var $this = this,
			$window = $(window);

		if(typeof $this.attr('pos') == 'undefined')
			$this.attr('pos', $this.offset().top);

		$window.scroll(function(){
			var pos = $window.scrollTop() - $this.attr('pos');
			if(pos <= -10) {
				$this.css('position', 'relative');
			} else {
				$this.css('position', 'fixed');
			}
		});
	}
})(jQuery);

jQuery(document).ready(function($){
	$('#locked-navigation').scrollingDiv();
});