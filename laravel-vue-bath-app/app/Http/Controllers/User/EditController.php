<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditRequest;
use App\Services\CodeNameService;
use App\Services\User\UserInfoService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\DB;

/**
 * ユーザー情報編集 コントローラー
 */
class EditController extends Controller
{
    /** コード名称 サービス */
    private $codeNameService;
    /** ユーザー情報 サービス */
    private $userInfoService;
    /** ユーザー サービス */
    private $userService;

    /**
     * コンストラクタ
     *
     * @param CodeNameService $codeNameService コード名称サービスのインスタンス
     */
    public function __construct(
        CodeNameService $codeNameService,
        UserInfoService $userInfoService,
        UserService $userService
    )
    {
        $this->codeNameService = $codeNameService;
        $this->userInfoService = $userInfoService;
        $this->userService = $userService;
    }

    /**
     * ユーザー情報編集ページ　描画
     *
     * @return array ユーザー情報
     */
    public function show()
    {
        return view('user.edit')->with([
            'user_info' => $this->userInfoService->getUserInfo(),
            'prefectures' => $this->codeNameService->getCodeNames('PREFECTURE'),
            'is_release' => $this->codeNameService->getCodeNames('IS_RELEASE'),
        ]);
    }

    /**
     * ユーザー情報を編集する
     *
     * @param EditRequest $request ユーザー情報編集 リクエストクラス
     */
    public function submit(EditRequest $request)
    {
        $user = DB::transaction(function () use ($request) {
            $this->userService->updateUser([ 'name' => $request->name ]);
            $this->userInfoService->updateUserInfo([
                'prefecture_cd' => $request->prefecture,
                'introduce' => $request->introduce,
                'icon_path' => $request->saveUploadImagePath(),
                'is_release' => $request->is_release,
            ]);
        });
        return redirect()->route('user.mypage');
    }
}
