<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ToPostRequest;
use App\Models\Post;
use App\Services\CodeNameService;

/**
 * お風呂投稿 コントローラー
 */
class ToPostController extends Controller
{

    private $codeNameService;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(CodeNameService $codeNameService)
    {
        $this->codeNameService = $codeNameService;
    }

    /**
     * お風呂投稿ページを返す
     *
     * @return void
     */
    public function show()
    {
        $data = [
            'evals' => $this->codeNameService->getCodeNames('EVAL'),
            'post' => Post::where('user_id', auth()->user()->id)->first(),
        ];
        return view('post.topost')->with($data);
    }

    /**
     * お風呂投稿アクション
     *
     * @param ToPostRequest $request お風呂投稿リクエストクラスのインスタンス
     * @return void
     */
    public function submit(ToPostRequest $request)
    {
        $mainPath = null;
        $sub1Path = null;
        $sub2Path = null;
        $sub3Path = null;

        $mainImg = $request->file('main_img');
        $sub1Img = $request->file('sub1_img');
        $sub2Img = $request->file('sub2_img');
        $sub3Img = $request->file('sub3_img');

        if($mainImg) { $mainPath = $mainImg->store('uploads', 'public'); }
        if($sub1Img) { $sub1Path = $sub1Img->store('uploads', 'public'); }
        if($sub2Img) { $sub2Path = $sub2Img->store('uploads', 'public'); }
        if($sub3Img) { $sub3Path = $sub3Img->store('uploads', 'public'); }

        $data = [
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'thoughts' => $request->thoughts,
            'main_image_path' => $mainPath,
            'sub_picture1_path' => $sub1Path,
            'sub_picture2_path' => $sub2Path,
            'sub_picture3_path' => $sub3Path,
            'eval_cd' => (float)$request->eval,
            'hot_water_eval_cd' => $request->hot_water_eval,
            'rock_eval_cd' => $request->rock_eval,
            'sauna_eval_cd' => $request->sauna_eval,
        ];
        Post::create($data);

        return redirect()->route('post.mypost');
    }
}
