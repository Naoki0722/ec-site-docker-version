<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    //データベースのリフレッシュ、今回は不要
    // use RefreshDatabase;
    

    // 成功ケース
    
    // アカウント登録のテスト(ファクトリを用いて)
    public function testFactoryUser()
    {
        $user = User::factory()->make();
        $user->save();
        $this->assertDatabaseHas('users',['name' => $user->name]);
        $response = $this->json('GET','/api/users');
        $response->assertJsonFragment([
            'name' => $user->name
        ]);
        User::where('id',$user->id)->delete();
    }

    // アカウント登録のテスト(成功)
    public function testCreateUser()
    {
        $response = $this->json('POST','/api/users',[
            'name' => 'naokidesu',
            'email' => 'test20@ates.com',
            'tell_number' => '00222990000',
            'password' => '0013820722',
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'naokidesu',
            'email' => 'test20@ates.com',
        ]);
    }

    // 登録したユーザーが拾えているか確認する
    public function testGetDataUser()
    {
        $user = User::factory()->create();
        $response = $this->json('GET', "/api/users/{$user->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
        ]);
        User::where('id', $user->id)->delete();

    } 

    // userデータ全取得テスト
    public function testIndexUser()
    {
        $response = $this->json('GET','/api/users');

        $response->assertStatus(200);
        
    }

    // userデータ変更できているかのテスト
    public function testUpdateUser()
    {
        $user = User::where('name', 'naokidesu')->first();
        $user_id = $user->id;
        $response = $this->json('PUT', "/api/users/{$user_id}", [
            'name' => '名前変更された！！',
            'email' => 'test20@ates.com',
            'tell_number' => '00222990000',
            'password' => '0013820722'
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment([
            'email' => 'test20@ates.com',
        ]);
    }


    // userデータが削除できているかのテスト(データベーステスト)
    public function testDeleteDbUser()
    {
        $user = User::factory()->create();
        User::where('id', $user->id)->delete();
        $this->assertDatabaseMissing('users',['name' => $user->name]);
    }


    // userデータが削除できているかのテスト(APIテスト)
    public function testDeleteUser()
    {
        $user = User::factory()->create();
        $response = $this->json('DELETE', "/api/users/{$user->id}");
        $response->assertStatus(200);
        User::where('id', $user->id)->delete();
    }

    // 失敗ケース

    // 既存メールアドレスでは登録できない
    public function testDuplicateUser()
    {
        $response = $this->json('POST', '/api/users', [
            'name' => 'naokidesu',
            'email' => 'test20@ates.com',
            'tell_number' => '00222990000',
            'password' => '0013820722'
        ]);

        $response->assertStatus(500);
    }

    // リクエスト不足による更新できない場合のテスト
    public function testFailedUpdateUser()
    {
        $user = User::where('name', '名前変更された！！')->first();
        $user_id = $user->id;
        $response = $this->json('PUT', "/api/users/{$user_id}", [
            'name' => '名前変更された！！',
            'email' => 'test20@ates.com',
            'password' => '0013820722'
        ]);

        $response->assertStatus(500)
                 ->assertJsonFragment([
            'email' => 'test20@ates.com',
        ]);
    }
    
    // 知らないユーザーでリクエストしたら404エラーを起こす処理
    public function testWhoDataUser()
    {
        $response = $this->json('GET', "/api/users/1000");
        
        $response->assertStatus(404);
        User::where('name', '名前変更された！！')->delete();
    } 
}
