# Dockerを使ってLaravelの開発環境を構築

こちらのrepositoryでは、Laravelの開発環境をDockerで構築する手順を記す。
すでにプロジェクトファイルはローカルで作成していたため、プロジェクトディレクトリを移植した。
<br>
<br>

## 構築手順
***
dockerはインストールしている前提で進める。

```
matsunoMBP:docker-laravel-ec naoki$ docker -v
Docker version 20.10.2, build 2291f61
```
<br>

### 1.イメージやDockerfileを使ってビルド
***

- 下記コマンドでまだイメージが作成されていなければ、イメージを作成して、さらにコンテナを作成・起動します。
- もし、すでにコンテナが存在すれば、イメージ・コンテナの再作成は行わず、（停止中の）コンテナを起動するだけです
- -dがないとバックグラウンドで起動できないので入力忘れに注意！

```
docker-compose up -d
```

dockerアプリで起動していることを確認する
<br><br>

### 2.Laravelインストール
***
Dockerfileにてcomposerのインストール済みであるため、composerのインストール確認をする。

まずは、phpコンテナに入る。(phpとはアプリ名を指す)
```
docker-compose exec php bash
```

コンテナに入った後

```
root@d1138847703d:/var/www/html/laravel-app# composer --version
```

バージョン確認できたら、Laraveのインストールを実施。(ver.8でインストール)
```
composer create-project --prefer-dist "laravel/laravel=8.*" travel-app[お好きなアプリ名を入力]
```
<br>

### 3.LaravelとMySQLの接続
***
Laravleでの開発が行えるようにMySQLとの接続を設定します。

エディターでlaravel-appを開いて.envを開きます。

まずは`docker-compose.yml`を確認する。
```
db:
    image: mysql:5.7
    ports:
      - '3306:3306'
    environment:
      MYSQL_DATABASE: db_name
      MYSQL_USER: db_user
      MYSQL_PASSWORD: db_password
```

Laravelの`.env`を下記で入力

```
DB_CONNECTION=mysql
DB_HOST=db（←コンテナ名）
DB_PORT=3306（←コンテナ側のポート番号）
DB_DATABASE=db_name
DB_USERNAME=db_user
DB_PASSWORD=db_password
```
<br>

### 4.MySQLの認証方法変更
***

MySQL8.0で使う場合は、MySQL 8〜ではデフォルトの認証方法が変更になっているようです。

まずは、MySQLコンテナに入り、MySQLにログイン
```
docker-compose exec mysql bash
mysql -u root -p
```

データベースの切り替え、ユーザーごとの認証方式を確認する。
```
mysql> use mysql
mysql> select user, host, plugin from user;
+------------------+-----------+-----------------------+
| user             | host      | plugin                |
+------------------+-----------+-----------------------+
| hoge             | localhost | caching_sha2_password |
| mysql.infoschema | localhost | caching_sha2_password |
| mysql.session    | localhost | caching_sha2_password |
| mysql.sys        | localhost | caching_sha2_password |
| root             | localhost | caching_sha2_password |
+------------------+-----------+-----------------------+
```

この場合、hogeで認証がうまくいっていない.

hogeの認証方法を変更します。
```
mysql> alter user 'hoge'@'localhost' identified with mysql_native_password by 'ここにパスワード';
```

プラグインが「mysql_native_password」になれば成功
<br>
<br>



## 接続確認
***
phpコンテナのLaravelプロジェクトで動かす

```
php artisan serve --host 0.0.0.0
```

マイグレーションが問題ないかも確認する。
```
php artisan migrate
```
<br>

## コンテナ停止
***

```
docker-compose down
```