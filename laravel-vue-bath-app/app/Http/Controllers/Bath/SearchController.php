<?php

namespace App\Http\Controllers\Bath;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bath\SearchRequest;
use App\Models\Bath;
use App\Services\Bath\SearchService;
use App\Services\CodeNameService;

/**
 * お風呂検索 コントローラー
 */
class SearchController extends Controller
{

    /** コード名称サービス */
    private $codeNameService;
    /** お風呂検索サービス */
    private $searchService;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(
        CodeNameService $codeNameService,
        SearchService $searchService
    )
    {
        $this->codeNameService = $codeNameService;
        $this->searchService = $searchService;
    }

    /**
     * お風呂検索画面　描画
     *
     * @return void
     */
    public function show()
    {
        $selectData = json_encode([
            'eval' => $this->codeNameService->getCodeNames('EVAL_SEARCH'),
            'prefectures' => $this->codeNameService->getCodeNames('PREFECTURE'),
        ]);
        return view('bath.search')->with(['selectData' => $selectData]);
    }

    /**
     * お風呂情報の検索結果を返す
     *
     * @param SearchRequest $request お風呂検索リクエスト インスタンス
     * @return json
     */
    public function getInfo(SearchRequest $request)
    {
        $bathQuery = $this->searchService->getQueryBath();
        if(isset($request->prefecture)) {
            $bathQuery->where('place', $this->codeNameService->getName('PREFECTURE', $request->prefecture))->get();
        }
        if(isset($request->keyword)) {
            $bathQuery->where('closing_day', 'like', "%$request->keyword%")->get();
        }
        if(isset($request->row_eval) && isset($request->high_eval) ) {
            $bathQuery
                ->where('eval_cd', '>=', $request->row_eval)
                ->where('eval_cd', '<=', $request->high_eval)
                ->get();
        }
        if(isset($request->row_hot_water_eval) && isset($request->high_hot_water_eval) ) {
            $bathQuery
                ->where('hot_water_eval_cd', '>=', $request->row_hot_water_eval)
                ->where('hot_water_eval_cd', '<=', $request->high_hot_water_eval)
                ->get();
        }
        if(isset($request->row_rock_eval) && isset($request->high_rock_eval) ) {
            $bathQuery
                ->where('rock_eval_cd', '>=', $request->row_rock_eval)
                ->where('rock_eval_cd', '<=', $request->high_rock_eval)
                ->get();
        }
        if(isset($request->row_sauna_eval) && isset($request->high_sauna_eval) ) {
            $bathQuery
                ->where('sauna_eval_cd', '>=', $request->row_sauna_eval)
                ->where('sauna_eval_cd', '<=', $request->high_sauna_eval)
                ->get();
        }
        dd($bathQuery->get());
        return response()->json($bathQuery->get());
    }
}
