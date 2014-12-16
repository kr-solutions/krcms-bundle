function text_counter (input_text, target)
{
    var input = $(input_text);
    var target = $(target);
    var max = input.attr("maxlength");
    var defaultText = input.val();

    $(input_text).keyup(function () {
        var val = input.val();
        var len = val.length;
        if (val === defaultText) {
            len = 0;
        }
        target.text(len + " van de " + max + " karakters");
    });
}

$(document).ready(function() {
	// fix sub nav on scroll
    var $win = $(window)
      , $nav = $('.subnav')
      , navTop = $('.subnav').length && $('.subnav').offset().top - 40
      , isFixed = 0;

    processScroll();

    $win.on('scroll', processScroll);

    function processScroll() {
		var i, scrollTop = $win.scrollTop()
		if (scrollTop >= navTop && !isFixed) {
			isFixed = 1;
			$nav.addClass('subnav-fixed');
		} else if (scrollTop <= navTop && isFixed) {
			isFixed = 0;
			$nav.removeClass('subnav-fixed');
		}
	}
});