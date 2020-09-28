#!/bin/bashx

#使い方 : $ bash ./bin/update.sh 1-0-0

#引数 : プラグインのバージョン
version=$1

#上の階層へ
cd ..

#zプラグインファイルをip化
zip -r useful-blocks-pro.zip useful-blocks-pro -x "*._*" "*__MACOSX*" "*.DS_Store" "*.git*" "*.vscode*" "*/_nouse/*" "*/src/*" "*/bin/*" "*gulpfile.js" "*webpack.config.js" "*/node_modules/*" "*package.json" "*package-lock.json" "*composer.json" "*README.md"

#設定ファイル系削除
zip --delete useful-blocks-pro.zip  "useful-blocks-pro/.*"

#zipファイルを移動
mv useful-blocks-pro.zip ./Versions/pro/zip/useful-blocks-pro-${version}.zip