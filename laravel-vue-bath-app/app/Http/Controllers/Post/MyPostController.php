<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * @return array
     */
    public function index()
    {
        return view('post.mypost')->with(['posts' => $this->myPostService->getMyPost()]);
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
}
