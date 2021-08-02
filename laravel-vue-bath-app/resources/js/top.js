$(function () {
    if($('#toppage').length > 0) {
        $('#nav .link').hover(function() {
            $(this).find('.nav-bg').toggleClass('square-hover');
        });

        $('.top-page .search-btn').hover(
            function() {
                $(this).find('.bath-mark').attr('src', 'svg/bath-mark-orange.svg');
            },
            function() {
                $(this).find('.bath-mark').attr('src', 'svg/bath-mark-light-blue.svg');
            }
        );
    }
});