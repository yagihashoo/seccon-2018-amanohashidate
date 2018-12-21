# 天橋立

## 問題文

```html
<a href="http://amanohashidate.pwn.ja.seccon" target="_blank">XSS HELL</a>
```

## FLAG

```
No flag
```

## FLAG URL

```
http://amanohashidate.pwn.ja.seccon/unsolved
```

## デプロイ方法

```sh
make setup
make up
make init
```

## Write-up

- Attack PointなしなのでWrite-up割愛。ルールの解説のみ。
- XSS Challengeをチーム間で出題し合う形式。
  - 問題はHTML形式で登録する
  - 1チーム1問まで問題を公開できる
  - HTML内からの外部スクリプトの参照などはCSPで禁止する
- Defense point付与タイミングで解かれていない問題の作成チームにDefense pointが付与される
- 他チームの問題を解くことでDefense pointの獲得を防ぐことができる