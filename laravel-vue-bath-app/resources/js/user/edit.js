/*
 * edit.js ユーザー情報編集
 */

$(function () {
    if($('#userEdit').length > 0) {
        const $imgLabel = $("#userEdit .img-label");

        // 画像プレビュー表示
        $imgLabel.on("change", function (e) {
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
        $imgLabel.on('click', function() {
            $(this).find('.file').val("");
        });

        // プレビュー画像の削除
        $("#userEdit .dlt-img").on('click', function(e) {
            e.preventDefault();
            let host = $(location).attr('host');
            let protocol = $(location).attr('protocol');

            $(this).addClass('hide');
            $(this).removeClass('flex');
            $(this).prev().find('img').attr('src', `${protocol}//${host}/svg/bath-mark-light-blue.svg`);
            $(this).prev().find('.file').val("");
            $(this).prev().find('.current-icon').val("");
        });

        // 初期：プロフィール画像ありの場合、削除ボタン表示
        if($imgLabel.find('.current-icon').val() != null) {
            $imgLabel.next('.dlt-img').removeClass('hide');
            $imgLabel.next('.dlt-img').addClass('flex');
        }
    }
});
