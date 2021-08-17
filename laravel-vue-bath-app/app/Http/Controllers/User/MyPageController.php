<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\CodeNameService;
use App\Services\User\UserInfoService;

/**
 * マイページ コントローラー
 */
class MyPageController extends Controller
{
    /** コード名称 サービス */
    private $codeNameService;
    /** ユーザー情報 サービス */
    private $userInfoService;

    /**
     * コンストラクタ
     *
     * @param CodeNameService $codeNameService コード名称サービスのインスタンス
     */
    public function __construct(
        CodeNameService $codeNameService,
        UserInfoService $userInfoService
    )
    {
        $this->codeNameService = $codeNameService;
        $this->userInfoService = $userInfoService;
    }

    /**
     * マイページ描画
     *
     * @return array ユーザー情報を返す
     */
    public function show()
    {
        return view('user.mypage')->with([
            'prefecture' => $this->codeNameService->getName('PREFECTURE', $this->userInfoService->getUserInfo()->prefecture_cd),
            'user_info'  => $this->userInfoService->getUserInfo(),
            'icon_path'  => $this->userInfoService->getUserInfo()->getIconPath(),
        ]);
    }
}
