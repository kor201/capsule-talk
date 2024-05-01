# 環境構築

- [Visual Studio Code](https://code.visualstudio.com/)がインストールされていること。
- [Docker for Mac](https://docs.docker.com/get-docker/)がインストールされていること。

## 証明書インポート

```
cd ~/capsule-talk

sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain docker/nginx/ssl/server.crt
```

## .env ファイルの入手

開発者にメッセージ

## 環境構築

```
# hosts に dev.capsule-talk.com を追加

cd ~/

sudo bash -c "echo '127.0.0.1 dev.capsule-talk.com' >> /etc/hosts"

# ディレクトリ移動
cd ~/capsule-talk

# 初期化(初回のみ実行)
make init

# コンテナ立ち上げ(2回目以降)
make up

# コンテナ削除（開発終了時）
make down
```

## 以下開発めも

### frontend

```

// プロジェクト作成
docker compose run --rm nextjs sh -c 'npx create-next-app . --typescript'

```

### backend

```
// プロジェクト作成
composer create-project laravel/laravel:^11.0 laravel

// ログインパッケージインストール
// sanctum
https://readouble.com/laravel/11.x/ja/sanctum.html
// fortify
https://readouble.com/laravel/11.x/ja/fortify.html

// docker compose exec laravel composer require laravel/breeze
docker compose exec laravel php artisan install:api
docker compose exec laravel php artisan migrate
```
