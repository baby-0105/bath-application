/*
 * mypost.js My投稿一覧
 */

$(function () {
    if($('#myPost').length > 0) {

        // 投稿削除
        $('#myPost .index .dlt-post').on('click', function() {
            let postId = $(this).prev('.post-id').attr('value');

            $('#myPost .popup-delete').removeClass('hide');
            $('#myPost .popup-delete').addClass('flex');
            $('#myPost #postId').attr('value', postId);
        });

        let hoverSubImg = (function() {
            let mainImgSrc;
            $('#myPost .sub-img-list').hover(
                function() { // マウス乗った時
                    let subImgSrc = $(this).find('.sub-img').attr('src'),
                        $mainImg = $(this).parents('.sub-imgs').prev('.main-img-block').find('.main-img');
                    mainImgSrc = $mainImg.attr('src');
                    $mainImg.attr('src', subImgSrc);
                },
                function() { // マウス外れた時
                    const $mainImg = $(this).parents('.sub-imgs').prev('.main-img-block').find('.main-img');
                    $mainImg.attr('src', mainImgSrc);
                }
            );
        })();
    }
});
