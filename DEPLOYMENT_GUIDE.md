# 本番環境デプロイ手順ガイド（npm不要版）

## 📋 デプロイ概要

**コミット情報**:
- 旧バージョン: `be0958f44938141dccb3b09e8b8a2e316d7ff30c`
- 新バージョン: `8fe807470746e42aefc487d5d20b8d57118812b9`
- 変更内容: フロントエンド大幅リニューアル（Vue 3 + Tailwind CSS統合、SEO強化）

**本番環境**: npm不要（ビルド済みファイルをコミット済み）

---

## 🚀 本番環境デプロイ手順（npm不要）

本番サーバーに**npmがない**場合でも、ビルド済みファイルがコミットされているので`git pull`だけでデプロイできます。

### ステップ1: 本番サーバーにSSH接続

```bash
ssh user@your-server.com
cd /path/to/production/quote-vault
```

### ステップ2: バックアップの作成

```bash
# 1. データベースバックアップ（推奨）
mysqldump -u [DB_USER] -p [DB_NAME] > backup_$(date +%Y%m%d_%H%M%S).sql

# 2. 現在のコミットIDを記録
git rev-parse HEAD > ../commit_before_deploy.txt
```

### ステップ3: 最新コードを取得

```bash
# 最新コードをプル
git pull origin master

# コミットIDを確認
git log -1 --oneline
# 出力: 12d7e8a ビルド済みアセットを追加（本番環境用）
```

### ステップ4: Composer依存関係の更新

```bash
# Composer依存関係のインストール/更新
composer install --optimize-autoloader --no-dev
```

### ステップ5: キャッシュのクリアと最適化

```bash
# キャッシュをクリア
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 本番用に最適化
php artisan config:cache
php artisan route:cache
```

### ステップ6: ファイル権限の確認

```bash
# 必要に応じて実行
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### ステップ7: 動作確認

ブラウザで以下を確認:

1. **トップページ**: https://quote-vault.jp/
   - Vue コンポーネントが動作しているか
   - ランダム名言、日替わり名言が表示されるか

2. **検索機能**: https://quote-vault.jp/search

3. **著者一覧**: https://quote-vault.jp/authors

4. **名言詳細**: https://quote-vault.jp/quotes/1

5. **ことわざ**: https://quote-vault.jp/proverbs

**ブラウザキャッシュクリア**: Ctrl+F5（またはCmd+Shift+R）

---

## ⚠️ トラブルシューティング

### 問題1: 変更が反映されない

**原因**: ブラウザキャッシュまたはLaravelキャッシュ

**解決策**:
```bash
# サーバー側
php artisan cache:clear
php artisan view:clear

# ブラウザ側
Ctrl+F5 で強制再読み込み
```

### 問題2: CSSやJSが古いまま

**原因**: mix-manifest.jsonが更新されていない

**解決策**:
```bash
# mix-manifest.jsonが最新か確認
cat public/mix-manifest.json

# 期待される内容:
# {
#     "/js/app.js": "/js/app.js?id=...",
#     "/css/app.css": "/css/app.css?id=..."
# }

# キャッシュクリア
php artisan cache:clear
```

### 問題3: Vue コンポーネントが動作しない

**原因**: app.jsが正しく読み込まれていない

**確認方法**:
1. ブラウザの開発者ツールを開く（F12）
2. Consoleタブでエラーを確認
3. Networkタブで`app.js`が正しく読み込まれているか確認

**解決策**:
```bash
# public/js/app.js のサイズを確認（3MB以上あるはず）
ls -lh public/js/app.js

# 必要に応じてgit pullをやり直す
git pull origin master --force
```

### 問題4: 500エラー

**原因**: ファイル権限またはログファイルの問題

**解決策**:
```bash
# 権限を確認
ls -la storage/

# 権限を修正
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# ログファイルを確認
tail -50 storage/logs/laravel.log
```

---

## 🔄 ロールバック手順

問題が発生した場合、前のバージョンに戻す:

```bash
# 1. 前のコミットに戻す
git checkout be0958f44938141dccb3b09e8b8a2e316d7ff30c

# 2. Composer依存関係を再インストール
composer install --optimize-autoloader --no-dev

# 3. キャッシュをクリア
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
```

---

## 📁 主な変更ファイル

### 追加されたファイル
```
resources/js/components/
  ├── ContentNavigation.vue
  ├── DailyQuote.vue
  ├── MobileNavigation.vue
  ├── QuickSearch.vue
  ├── QuoteCard.vue
  └── RandomQuote.vue

resources/views/layouts/
  └── app.blade.php              # 新レイアウト

public/
  └── site.webmanifest           # PWA設定
```

### 削除されたファイル
```
resources/views/
  └── layout.blade.php           # 旧レイアウト
```

### 更新されたファイル（主要）
```
app/Http/Controllers/
  ├── AuthorController.php
  ├── LargeCategoryController.php
  ├── QuoteController.php
  └── SearchController.php

resources/views/
  ├── home.blade.php             # トップページ完全リニューアル
  ├── authors/index.blade.php
  ├── authors/show.blade.php
  ├── largecategories/index.blade.php
  ├── largecategories/show.blade.php
  ├── quotes/show.blade.php
  └── [その他40ファイル]

public/css/app.css               # ビルド済みCSS（3.6MB → 66KB圧縮）
public/js/app.js                 # ビルド済みJS（Vue 3含む）
public/mix-manifest.json         # アセットマニフェスト
```

---

## 🎯 デプロイチェックリスト

### デプロイ前
- [ ] バックアップ完了（DB + コミットID記録）
- [ ] `.env`ファイルの本番設定確認済み

### デプロイ中
- [ ] `git pull origin master` 実行
- [ ] `composer install --no-dev` 実行
- [ ] キャッシュクリア・最適化実行

### デプロイ後
- [ ] トップページ表示確認（Ctrl+F5）
- [ ] Vue コンポーネント動作確認
- [ ] 検索機能確認
- [ ] 著者・カテゴリページ確認
- [ ] モバイル表示確認
- [ ] エラーログ確認

---

## 📞 サポート情報

### エラーログの確認場所

```bash
# Laravelログ
tail -50 storage/logs/laravel.log

# Webサーバーログ
tail -50 /var/log/apache2/error.log  # Apache
tail -50 /var/log/nginx/error.log    # Nginx
```

### 重要な設定ファイル

```bash
# 本番環境設定
cat .env | grep -E "APP_ENV|APP_DEBUG|APP_URL"

# 期待される出力:
# APP_ENV=production
# APP_DEBUG=false
# APP_URL=https://quote-vault.jp
```

---

**最終更新**: 2026年1月2日  
**対象バージョン**: 12d7e8a（ビルド済みアセット追加）
