<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bath\SearchRequest;
use App\Http\Requests\Post\ToPostRequest;
use App\Services\Bath\SearchService;
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
    /** お風呂検索サービス */
    private $searchService;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(
        CodeNameService $codeNameService,
        ToPostService $toPostService,
        SearchService $searchService
    )
    {
        $this->codeNameService = $codeNameService;
        $this->toPostService = $toPostService;
        $this->searchService = $searchService;
    }

    /**
     * お風呂投稿ページを返す
     *
     * @return array
     */
    public function show()
    {
        return view('post.topost')->with([
            'evals' => $this->codeNameService->getCodeNames('EVAL'),
            'prefectures' => json_encode($this->codeNameService->getCodeNames('PREFECTURE')),
        ]);
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
            $bathName = $this->toPostService->getBathName($request->bath_code);
            $this->toPostService->createPost([
                'user_id' => auth()->user()->id,
                'title' => $bathName,
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

            $this->toPostService->updateTheBath($bathName, [
                'eval_cd' => $this->toPostService->getEvalAvg($bathName, 'eval_cd'),
                'hot_water_eval_cd' => $this->toPostService->getEvalAvg($bathName, 'hot_water_eval_cd'),
                'rock_eval_cd' => $this->toPostService->getEvalAvg($bathName, 'rock_eval_cd'),
                'sauna_eval_cd' => $this->toPostService->getEvalAvg($bathName, 'sauna_eval_cd'),
            ]);
        });
        return redirect()->route('post.mypost');
    }

    /**
     * 投稿用のお風呂の検索
     *
     * @param SearchRequest $request 検索用リクエスト インスタンス
     * @return json お風呂検索結果
     */
    public function search(SearchRequest $request)
    {
        $bathQuery = $this->searchService->getQueryBath();
        if(isset($request->prefecture)) {
            $bathQuery->where('place', $this->codeNameService->getName('PREFECTURE', $request->prefecture))->get();
        }
        if(isset($request->keyword)) {
            $bathQuery->where('name', 'like', "%$request->keyword%")->get();
        }
        return response()->json($bathQuery->get());
    }
}
