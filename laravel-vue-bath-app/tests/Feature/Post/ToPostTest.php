<?php

namespace Tests\Feature\Post;

use App\Models\Bath;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * お風呂投稿 Featureテスト
 */
class ToPostTest extends TestCase
{

    use DatabaseTransactions; // FactoryのテストデータをDBに保存させない

    public function testGetPage()
    {
        $response = $this->get('/post/topost');
        $response->assertStatus(302);
    }

    /**
     * 投稿用のお風呂の検索
     *
     * @return void
     */
    public function testSearchBathName()
    {
        // 都道府県検索
        $place = Bath::where('place', '東京都')->first();
        $this->assertNotNull($place);
        $place = Bath::where('place', '韓国')->first();
        $this->assertNull($place);
        $place = Bath::where('place', 'トウキョウ')->first();
        $this->assertNull($place);
        $place = Bath::where('place', 'tokyo')->first();
        $this->assertNull($place);
        $place = Bath::where('place', '東京')->first();
        $this->assertNull($place);

        // キーワード検索（ひらがな/カタカナ一致）
        $keyword1 = Bath::where('name', 'like', "%ああ%")->first();
        $this->assertNotNull($keyword1);
        $keyword2 = Bath::where('name', 'like', "%a%")->first();
        $this->assertNotNull($keyword2);
        $keyword3 = Bath::where('name', 'like', "%かかかかかかk%")->first();
        $this->assertNull($keyword3);
    }

    /**
     * 投稿画面 投稿処理と、投稿後リダイレクトまでのテスト
     *
     * @return void
     */
    public function testPost()
    {
            $user = factory(User::class)->create();
            $post = factory(Post::class)->create();

            $this->actingAs($user)->get('/post/mypost');

            $data = [
                'bath_id' => $post->bath_id,
                'user_id' => $post->user_id,
                'title' => $post->title,
                'thoughts' => $post->thoughts,
                'main_image_path' => $post->main_image_path,
                'sub_picture1_path' => $post->sub_picture1_path,
                'sub_picture2_path' => $post->sub_picture2_path,
                'sub_picture3_path' => $post->sub_picture3_path,
                'eval_cd' => $post->eval_cd,
                'hot_water_eval_cd' => $post->hot_water_eval_cd,
                'rock_eval_cd' => $post->rock_eval_cd,
                'sauna_eval_cd' => $post->sauna_eval_cd,
            ];

            $response = $this->withoutMiddleware()->post('/post/topost', $data);

            $response->assertRedirect('/post/mypost');
            $this->assertDatabaseHas('posts', $data);
    }
}
