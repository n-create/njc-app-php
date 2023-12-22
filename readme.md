# 物件検索エンジン API サンプルコード - Lumen 版

日本情報クリエイト(株)が提供する物件検索エンジン API を利用するためのサンプルプログラムです。  
本プログラムは[Lumen PHP Framework](https://github.com/laravel/lumen)を使用しております。  
ソースの改変や画像の差し替えなどもできますのでご自由にダウンロードしご利用ください。  
こちらはサンプルでの提供のため動作保証やお問い合わせのサポート等は行っていません。

## 注意事項

本サンプルプログラムは自由に誰でも利用可能ですが、物件検索エンジン API サーバーから物件データを取得するには別途日本情報クリエイト(株)との契約が必要となります。

## 利用方法

- .env.example を .env とリネームしてください。
- 提供された API キーを.env 内の API_TOKEN_KEY に設定してください。
- 提供された API ドメイン（https://estate.njcapi.jp/api/v1/web）　を.env 内の API_DOMAIN に設定してください。
- 会社名称や電話番号の設定は、.env 内の下記値に設定してください。

  - 会社名称 => COMPANY_NAME
  - 所在地 => COMPANY_ADDRESS
  - メールアドレス => COMPANY_EMAIL
  - 電話番号 => COMPANY_TEL1
  - 電話番号 2 => COMPANY_TEL2
  - FAX 番号 => COMPANY_FAX

- Google Map API を使用する場合は Google 指定の API キーを.env 内の定数 GOOGLE_MAPS_KEY に設定してください。

## サンプルプログラムの動作環境

- 実行環境に以下のソフトウェアがインストールされている事を前提とします。
  - apache
  - php7
- 上記に加え物件検索エンジン API と SSL 接続することができる環境であること。

または php のビルトインウェブサーバーでも動作します。

`php -S localhost:8000 -t ./public`

## ライセンス

[MIT](https://github.com/tcnksm/tool/blob/master/LICENCE)

## Author

[n-create](https://github.com/n-create)
