
$(function () {
    const AJAX_TIMEOUT = 30000;


    // SNS認証：本登録用モーダル
    if($(".sns-update-profile").length > 0){
        let $nameError    = $('.sns-update-profile .name-error'),
            $emailError   = $('.sns-update-profile .email-error'),
            $timeoutError = $('.sns-update-profile .timeout-error'),
            $statusError  = $('.sns-update-profile .status-error');

        $(".sns-update-profile .submit").on('click', function(e){
            let path = $(this).parents('form').attr('action');

            e.preventDefault();
            $nameError.text('');
            $emailError.text('');
            $timeoutError.text('');
            $statusError.text('');

            $.ajax({
                type    : 'POST',
                dataType: 'json',
                url: path,
                timeout : AJAX_TIMEOUT,
                headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    name : $('.sns-update-profile input[name="name"]') .val(),
                    email: $('.sns-update-profile input[name="email"]').val(),
                },
            })
            .done(function(data) {
                console.log(data);
                $('.sns-update-profile').addClass('hide');
                $('.sns-update-profile').removeClass('flex');
                $('.popup-mail-confirm').removeClass('hide');
                $('.popup-mail-confirm').addClass('flex');
            })
            .fail(function(xhr) {
                console.log(xhr);
                if (419 === xhr.status) {
                    $statusError.html('セッションが無効になりました。再読み込みします。');
                    window.location.reload();
                } else if (4 === xhr.readyState && !xhr.responseJSON) {
                    $statusError.html('認証できませんでした。');
                } else if(0 === xhr.status) {
                    $statusError.html('認証できませんでした。<br>通信環境をお確かめいただき、 <br>時間をおいてやり直してください。');
                } else {
                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;

                            if(errors.name)   { $nameError.text(errors.name); }
                            if(errors.email)  { $emailError.text(errors.email); }
                            if(errors.status) { $statusError.text(errors.status); }
                        } else if (xhr.responseJSON.message) {
                            $statusError.html(xhr.responseJSON.message);
                        }
                    } else {
                        $timeoutError.html("認証できませんでした。<br>通信環境をお確かめいただき、 <br>時間をおいてやり直してください。");
                    }
                }
            })
        });
    }
});
