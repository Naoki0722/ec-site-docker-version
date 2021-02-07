<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StripeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // 成功パターン

    // セッション取得
    public function testCreateSession()
    {
        $response = $this->postJson('/api/stripes',[
            'title' => 'テスト',
            'image' => 'https://s3.ap-northeast-1.amazonaws.com/ritolab.com/images/article/59575876b4551/122/1ff40d3f44d06aea4af50788341b9c41.png',
            'price' => 9000,
            'description' => 'せつめいです'
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'success'
        ]);
    }
}
