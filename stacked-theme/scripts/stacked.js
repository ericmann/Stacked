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
			} else if($this.hasClass('more')) {
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

	$('.bio-tab').each(function() {
		var $this = $(this);

		$this.click(function() {
			$this.addClass('ignore');
			$('.bio-tab').each(function() {
				if(!$(this).hasClass('ignore'))
					collapseBio($(this));
			});
			if($this.hasClass('less')) {
				expandBio($this);
			} else if ($this.hasClass('more')) {
				collapseBio($this);
			}
			$this.removeClass('ignore');
		});
	});

	function expandBio($this) {
		var classList = $this.attr('class').split(/\s+/);

		$this.removeClass('less').addClass('more');

		$.each( classList, function(index, item) {
			if(item.indexOf('person-') != -1) {
				var $bio = $('.person-bio.' + item);
				$bio
					.css('left', $bio.parent().parent().offset().left)
					.css('display', 'inherit');
			}
		});
	}

	function collapseBio($this) {
		var classList = $this.attr('class').split(/\s+/);

		$this.removeClass('more').addClass('less');

		$.each( classList, function(index, item) {
			if(item.indexOf('person-') != -1) {
				var $bio = $('.person-bio.' + item);
				$bio.css('display', 'none');
			}
		});
	}
});