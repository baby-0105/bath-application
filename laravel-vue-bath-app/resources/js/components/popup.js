/*
 * popup.js ポップアップ用 共通JS
 */

$(function () {
    if($('#popup').length > 0) {
        $('#popup #close').on('click', function() {
            $(this).parents('#popup').removeClass('flex');
            $(this).parents('#popup').addClass('hide');
        });
    }
});
