<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 20210125 コードレビュー依頼

作成後初めてのコードレビュー依頼となります。

仕様書(スプレッドシート)で記載していたAPIは一通り作成いたしました。

(StripeのCheckout決済のためのSessionID作成のAPIも作成しています)

※管理者権限のことはまだ実装していません。作るAPIの追加としては商品登録と削除の機能かと思いますので、StoreとDestroyを作れば終わりかと思います。

## 確認いただきたい箇所

### その1
今回みていただきたい箇所は、CartsController.phpとLikesController.phpのStoreアクションです。

単純に$requestに対するレコードを作成すればいいのですが、idをユニークにしているので
user_idやproduct_idが重複してもインサートされてしまい、id違いの同じデータのレコードが複数できてしまいます。

これを制御するには下記のようなif文で組んでみようかと思ったんですが、今の構文で良いか自信がないです。

もしくはフロント側で同じ商品に対してカートに入れようとしたりお気に入りしたりしようとした際にalertで弾きたいです。

### その2
一部クエリビルダやDB::rawを使って生クエリを使っているのでコードが汚いように思います。。。

Laravelなら、Eloquentの書き方で統一した方がよろしいでしょうか？


##　その他(補足)
その他Controllerも作成していますので合わせてご確認よろしくお願いいたします。

(もし、テストする場合は、必要に応じてローカルテストできるようダミーデータとしていくつかシーディングファイルを作っております)

ご確認よろしくお願いいたします。


# 20210128 2回目コードレビュー依頼

Modelを使ったリレーションに変更(勉強のため)

全てのAPIは作成完了、商品登録(画像アップロード)は後ほど。

php ユニットテストの勉強に着手することとする。





# 20210131 現状の実装

PHPunitを用いたテストコードを実装した。

DBについては、テストコード用のローカルDBを用意。
DB変更については、phpunit.xmlではなく.env.testingを別に用意して対応。


すべてのテストについては未実施。(あくまでテストコードについての勉強の位置付け)



APIのレスポンス確認がメインであるため、単体テストではなく、機能面のフューチャーテストのみとなる。