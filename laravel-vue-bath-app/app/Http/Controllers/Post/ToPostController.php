<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ToPostRequest;
use App\Models\Bath;
use App\Models\Post;
use App\Services\CodeNameService;
use App\Services\Post\ToPostService;
use Illuminate\Support\Facades\DB;

/**
 * お風呂投稿 コントローラー
 */
class ToPostController extends Controller
{

    /** コード名称 サービス */
    private $codeNameService;
    /** お風呂投稿 サービス */
    private $toPostService;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(
        CodeNameService $codeNameService,
        ToPostService $toPostService
    )
    {
        $this->codeNameService = $codeNameService;
        $this->toPostService = $toPostService;
    }

    /**
     * お風呂投稿ページを返す
     *
     * @return void
     */
    public function show()
    {
        return view('post.topost')->with(['evals' => $this->codeNameService->getCodeNames('EVAL')]);
    }

    /**
     * お風呂投稿アクション
     *
     * @param ToPostRequest $request お風呂投稿リクエストクラスのインスタンス
     * @return void
     */
    public function submit(ToPostRequest $request)
    {
        DB::transaction(function () use ($request) {
            $this->toPostService->createPost([
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'thoughts' => $request->thoughts,
                'main_image_path' => $request->saveUploadImagePath()['mainPath'],
                'sub_picture1_path' => $request->saveUploadImagePath()['sub1Path'],
                'sub_picture2_path' => $request->saveUploadImagePath()['sub2Path'],
                'sub_picture3_path' => $request->saveUploadImagePath()['sub3Path'],
                'eval_cd' => (float)$request->eval,
                'hot_water_eval_cd' => $request->hot_water_eval,
                'rock_eval_cd' => $request->rock_eval,
                'sauna_eval_cd' => $request->sauna_eval,
            ]);

            $this->toPostService->updateTheBath($request->title, [
                'eval_cd' => $this->toPostService->getEvalAvg($request->title, 'eval_cd'),
                'hot_water_eval_cd' => $this->toPostService->getEvalAvg($request->title, 'hot_water_eval_cd'),
                'rock_eval_cd' => $this->toPostService->getEvalAvg($request->title, 'rock_eval_cd'),
                'sauna_eval_cd' => $this->toPostService->getEvalAvg($request->title, 'sauna_eval_cd'),
            ]);
        });
        return redirect()->route('post.mypost');
    }
}
