<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditRequest;
use App\Models\User;
use App\Models\UserInfo;
use App\Services\CodeNameService;
use Illuminate\Support\Facades\DB;

/**
 * ユーザー情報編集 コントローラー
 */
class EditController extends Controller
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
     * ユーザー情報編集ページ　描画
     *
     * @return array ユーザー情報
     */
    public function show()
    {
        $userInfo = UserInfo::find(auth()->user()->id);
        $data = [
            'user_info' => $userInfo,
            'prefectures' => $this->codeNameService->getCodeNames('PREFECTURE'),
            'is_release' => $this->codeNameService->getCodeNames('IS_RELEASE'),
        ];
        return view('user.edit')->with($data);
    }

    /**
     * ユーザー情報を編集する
     *
     * @param EditRequest $request ユーザー情報編集 リクエストクラス
     */
    public function submit(EditRequest $request)
    {
        $iconPath = null;
        // 現在のアイコン画像を更新したかどうか
        if($request->is_change) {
            $iconImg = $request->file('icon_path');
            if($iconImg) { $iconPath = $iconImg->store('uploads', 'public'); }
        } else {
            $iconPath = $request->icon_path;
        }

        $user = DB::transaction(function () use ($request, $iconPath) {
            User::where('id', auth()->user()->id)->update([
                'name' => $request->name,
            ]);

            UserInfo::where('user_id', auth()->user()->id)
                    ->update([
                        'prefecture_cd' => $request->prefecture,
                        'introduce' => $request->introduce,
                        'icon_path' => $iconPath,
                        'is_release' => $request->is_release,
                    ]);
        });
        return redirect()->route('user.mypage');
    }
}
