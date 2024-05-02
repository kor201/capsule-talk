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
