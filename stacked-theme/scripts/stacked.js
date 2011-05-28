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

	$('.more-less').each(function() {
		var $this = $(this);

		$this.click(function(){
			var classList = $this.attr('class').split(/\s+/);

			if($this.hasClass('less')) {
				$this.removeClass('less').addClass('more');
				$.each( classList, function(index, item) {
					if(item.indexOf('post-') != -1) {
						var $post = $('.entry-content.' + item);
						$post.parent().toggleClass('less');
					}
				});
			} else if($this.hasClass('more')){
				$this.removeClass('more').addClass('less');
				$.each( classList, function(index, item) {
					if(item.indexOf('post-') != -1) {
						var $post = $('.entry-content.' + item);
						$post.parent().toggleClass('less');
					}
				});
			}
		});
	});
});