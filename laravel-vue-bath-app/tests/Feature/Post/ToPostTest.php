<?php

namespace Tests\Feature\Post;

use App\Models\Bath;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * お風呂投稿 Featureテスト
 */
class ToPostTest extends TestCase
{
    public function testGetPage()
    {
        $response = $this->get('/post/topost');
        $response->assertStatus(302);
    }

    // public function testResponseJson()
    // {
    // }

    /**
     * 投稿用のお風呂の検索
     *
     * @return void
     */
    public function testSearchBathName()
    {
        // 都道府県検索
        $place = Bath::where('place', '東京都')->first();
        $this->assertNotNull($place); // Nullで無ければtrue
        $place = Bath::where('place', '韓国')->first();
        $this->assertNull($place);
        $place = Bath::where('place', 'トウキョウ')->first();
        $this->assertNull($place);
        $place = Bath::where('place', 'tokyo')->first();
        $this->assertNull($place);
        $place = Bath::where('place', '東京')->first();
        $this->assertNull($place);

        // キーワード検索（ひらがな/カタカナ一致）
        $keyword1 = Bath::where('name', 'like', "%ああ%")->first(); // nameカラムに、「あ」があることの確認
        $this->assertNotNull($keyword1);
        $keyword2 = Bath::where('name', 'like', "%a%")->first(); // nameカラムに、「a」があることの確認
        $this->assertNotNull($keyword2);
        $keyword3 = Bath::where('name', 'like', "%かかかかかかk%")->first(); // nameカラムに、「かかかかかかk」がないことの確認
        $this->assertNull($keyword3);
    }

    // public function testPost()
    // {
    //     // 画像アップロードテスト
    //     Storage::fake('main_images');
    //     $file = UploadedFile::fake()->image('avatar.jpg');
    //     $response = $this->json('POST', '/post/topost', [
    //         'main_image_path' => $file,
    //     ]);
    //     Storage::disk('main_images')->assertExists($file->hashName());
    //     Storage::disk('main_images')->assertMissing('missing.jpg');
    // }
}
