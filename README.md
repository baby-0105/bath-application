# bath-application

## Dockerコマンド
```
$ cd /Users/ShoyaBaba/application/my-app/bath-application/laravel-vue-bath-app

$ docker-compose exec app bash
$ cd laravel-vue-bath-app

$ npm run watch-poll ➡️ 自動コンパイル
$ exit
```

## PHPUnit コマンドメモ
```
$ vendor/bin/phpunit

$ vendor/bin/phpunit --filter メソッド名

$ vendor/bin/phpunit ./tests/Unit/テストファイル名
```

## 本番環境用
```
# npm run prod → 必須(本番環境でcss/jsの読み取りを早くする→圧縮)
```

## スクレイピング
```
http://localhost:8000/check_scraping アクセス
```
