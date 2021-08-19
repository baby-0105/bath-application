/*
 * register.js ユーザー登録
 */

$(function () {
    if($('#register').length > 0) {
        $('#registerBtn').on('click', function(e) {
            e.preventDefault();
            $(this).prop('disabled', true);
            $('#register .form').submit();
        });
    }
});
