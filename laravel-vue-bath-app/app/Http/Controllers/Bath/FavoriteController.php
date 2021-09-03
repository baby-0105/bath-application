<?php

namespace App\Http\Controllers\Bath;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bath\FavoriteRequest;
use App\Models\Bath;
use App\Services\Bath\FavoriteService;
use Illuminate\Http\Request;

/**
 * お風呂お気に入り登録　コントローラー
 */
class FavoriteController extends Controller
{

    /** お風呂お気に入りサービス */
    private $favoriteService;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    /**
     * お気に入り登録一覧を表示する
     *
     * @return void
     */
    public function index()
    {
        return view('bath.favorite')->with([
            'favoritedBaths' => $this->favoriteService->favoritedBath(),
        ]);
    }

    /**
     * お気に入り登録をする
     *
     * @param FavoriteRequest $request お気に入りリクエストクラス インスタンス
     * @return json お気に入り状態がtrueだと返す
     */
    public function addFavorite(FavoriteRequest $request)
    {
        $this->favoriteService->addFavorite([
            'user_id' => auth()->id(),
            'bath_id' => $request->bathId,
        ]);
        return response()->json($request->bathId);
    }

    /**
     * お気に入り解除をする
     *
     * @param Request $request リクエストクラス インスタンス
     * @return json お気に入り状態がfalseだと返す
     */
    public function unFavorite(Request $request)
    {
        $this->favoriteService->unFavorite($request->bathId);
        return response()->json($request->bathId);
    }
}
