/*
 * header.js ヘッダー
 */

$(function () {
    if($('#header').length > 0) {
        $('#nav .link').hover(function() {
            $(this).find('.nav-bg').toggleClass('square-hover');
        });

        // Menuの開閉
        $('#header #burger').on('click', function() {
            $('#header #nav').addClass('nav-is-open');
        });
        $('#header #closeNav').on('click', function() {
            $('#header #nav').removeClass('nav-is-open');
        });
    }
});
