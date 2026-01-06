# kintaikanri — ローカル開発用 README

このリポジトリは Laravel アプリケーションです。以下はローカルで素早く動かすための手順です。

## 前提

- OS: Linux（Debian/Ubuntu 系想定）
- 必要なソフト: `php`, `node`, `npm`, `composer`（またはローカル `composer.phar`）
- SQLite を利用する場合、PHP に `php-sqlite3` が必要です

## クイックセットアップ（初回）

プロジェクトルートで実行:

```bash
# 環境ファイルを作成
cp .env.example .env

# SQLite を使う場合（ファイル作成）
mkdir -p database
touch database/database.sqlite

# Composer 依存をインストール
php composer.phar install --no-interaction || composer install --no-interaction

# アプリキー生成
php artisan key:generate

# DB マイグレーションとシード（開発用: 既存データを消しても良い場合）
php artisan migrate:fresh --seed --force

# ストレージリンク作成とパーミッション
php artisan storage:link || true
chmod -R 775 storage bootstrap/cache || true

# Node 依存とアセットビルド
npm install
npm run build
```

※ システムに `php-sqlite3` がない場合（Debian/Ubuntu 系）:

```bash
sudo apt update
sudo apt install -y php-sqlite3
```

## 開発サーバの起動

```bash
# 開発サーバを起動
php artisan serve --host=0.0.0.0 --port=8000
# ブラウザで: http://127.0.0.1:8000
```

停止は `Ctrl+C` を押すか、バックグラウンド実行ではプロセスを停止してください。

## Docker での起動（任意）

```bash
docker compose up -d --build
# 停止
docker compose down
```

## 補足

- アセットを再ビルドするには `npm run build` を実行してください。
- 本番環境向けの設定やセキュリティ対策は別途必要です。
