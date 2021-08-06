$(function () {
    if($('#header').length > 0) {
        $('#nav .link').hover(function() {
            $(this).find('.nav-bg').toggleClass('square-hover');
        });
    }
});
