<?php

namespace Tests\Feature;

use App\Models\Like;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeTest extends TestCase
{
    //データベースのリフレッシュ、今回は不要
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

     // 成功パターン

     // お気に入り登録
    public function testCreateLike()
    {
        $response = $this->json('POST','/api/likes',[
            'user_id' => '2',
            'product_id' => '2'
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'data' => true
        ]);
    }

    // ユーザーのお気に入り一覧表示に先ほど登録したものが含まれているか？
    public function testGetLike()
    {
        $response = $this->json('GET', '/api/likes?user_id=2');
        $response->assertStatus(200);
        // $response->assertJsonFragment([
        //     'product_id' => '2'
        // ]);
    }


    // 失敗パターン
    // 同じお気に入り登録はできない
    public function testSameCreateLike()
    {
        $response = $this->json('POST', '/api/likes', [
            'user_id' => '2',
            'product_id' => '2'
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'data' => false
        ]);
        Like::where('user_id', '2')->where('product_id', '2')->delete();  // ここでテストデータを削除する
    }

    // ユーザーのお気に入り一覧から削除
    public function testDeletedLike()
    {
        $now = Carbon::now();
        $like = new Like;
        $like->user_id = 2;
        $like->product_id = 2;
        $like->created_at = $now;
        $like->updated_at = $now;
        $like->save();
        $response = $this->deleteJson("/api/likes/{$like->id}");
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'data' => true
        ]);
    }

    // 紐づいていないユーザーのお気に入り一覧から削除はエラー
    public function testNotDeletedLike()
    {
        $response = $this->json('DELETE', "/api/likes/2");
        $response->assertJsonMissing([
            'data' => false
        ]);
    }

    // ユーザーのお気に入り一覧表示にない商品？
    public function testFailedLike()
    {
        $response = $this->json('GET', '/api/likes?user_id=2');
        $response->assertStatus(200);
        $response->assertJsonMissing([
            'product_id' => '2'
        ]);

    }
}
