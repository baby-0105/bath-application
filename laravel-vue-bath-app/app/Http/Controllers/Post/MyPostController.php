<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

/**
 * My投稿一覧ページ コントローラー
 */
class MyPostController extends Controller
{
    /**
     * My投稿一覧表示
     *
     * @return array
     */
    public function index()
    {
        $data = [
            'posts' => Post::where('user_id', auth()->user()->id)->latest()->get(),
        ];
        return view('post.mypost')->with($data);
    }

    /**
     * My投稿一覧の投稿を削除する
     *
     * @param Request $request リクエストクラス インスタンス
     * @return void
     */
    public function delete(Request $request)
    {
        Post::where('id', $request->postId)->delete();
        return redirect()->route('post.mypost');
    }
}
