<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserInfo;
use App\Services\CodeNameService;

/**
 * マイページ コントローラー
 */
class MyPageController extends Controller
{
    /** コード名称 サービス */
    private $codeNameService;

    /**
     * コンストラクタ
     *
     * @param CodeNameService $codeNameService コード名称サービスのインスタンス
     */
    public function __construct(CodeNameService $codeNameService)
    {
        $this->codeNameService = $codeNameService;
    }

    /**
     * マイページ描画
     *
     * @return array ユーザー情報を返す
     */
    public function show()
    {
        $userInfo = UserInfo::find(auth()->user()->id);
        $data = [
            'prefecture' => $this->codeNameService->getName('PREFECTURE', $userInfo->prefecture_cd),
            'user_info'  => $userInfo,
            'icon_path'  => $userInfo->getIconPath(),
        ];
        return view('user.mypage')->with($data);
    }
}
