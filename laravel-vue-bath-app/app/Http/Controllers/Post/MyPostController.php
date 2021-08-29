<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\SelectOrderRequest;
use App\Services\Post\MyPostService;

/**
 * My投稿一覧ページ コントローラー
 */
class MyPostController extends Controller
{
    private $myPostService;

    /**
     * コンストラクタ
     *
     * @param MyPostService $myPostService My投稿 サービスクラス インスタンス
     * @return void
     */
    public function __construct(MyPostService $myPostService)
    {
        $this->myPostService = $myPostService;
    }

    /**
     * My投稿一覧表示
     *
     * @return array 最新順に並んだ投稿
     */
    public function index()
    {
        return view('post.mypost')->with(['posts' => $this->myPostService->getLatestMyPost()]);
    }

    /**
     * My投稿一覧の投稿を削除する
     *
     * @param Request $request リクエストクラス インスタンス
     * @return void
     */
    public function delete(Request $request)
    {
        $this->myPostService->deletePost($request->postId);
        return redirect()->route('post.mypost');
    }

    /**
     * 投稿を選択した順番に並び替えたものを返す
     *
     * @param SelectOrderRequest $request　My投稿選択 リクエストクラス
     * @return json 並び替えた投稿
     */
    public function selectOrder(SelectOrderRequest $request)
    {
        if($request->selectOrder == 'new') {
            return response()->json($this->myPostService->getLatestMyPost());
        }
        if($request->selectOrder == 'eval') {
            return response()->json($this->myPostService->getHighEvalOrder('eval_cd'));
        }
        if($request->selectOrder == 'hot_water_eval') {
            return response()->json($this->myPostService->getHighEvalOrder('hot_water_eval_cd'));
        }
        if($request->selectOrder == 'rock_eval') {
            return response()->json($this->myPostService->getHighEvalOrder('rock_eval_cd'));
        }
        if($request->selectOrder == 'sauna_eval') {
            return response()->json($this->myPostService->getHighEvalOrder('sauna_eval_cd'));
        }
    }
}
