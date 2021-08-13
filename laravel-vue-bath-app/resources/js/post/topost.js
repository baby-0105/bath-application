/*
 * topost.js 投稿
 */

$(function () {
    if($('#toPost').length > 0) {
        // 画像プレビュー表示
        $("#toPost .img-label").on("change", function (e) {
            let $label = $(this),
                reader = new FileReader();

            reader.onload = function (e) {
                $label.find('img').attr('src', e.target.result);
                $label.find('.file').attr('value', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);

            $(this).next('.dlt-img').removeClass('hide');
            $(this).next('.dlt-img').addClass('flex');
        });

        // 削除後：同じ画像のアップロード可能に
        $("#toPost .img-label").on('click', function() {
            $(this).find('.file').val("");
        });

        // プレビュー画像の削除
        $("#toPost .dlt-img").on('click', function(e) {
            e.preventDefault();
            let host = $(location).attr('host');
            let protocol = $(location).attr('protocol');

            $(this).addClass('hide');
            $(this).removeClass('flex');
            $(this).prev().find('img').attr('src', `${protocol}//${host}/svg/bath-mark-light-blue.svg`);
            $(this).prev().find('.file').val("");
        });
    }
});
