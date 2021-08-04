#!/bin/bashx

#使い方 : $ bash ./bin/zip.sh 1-2-4

#引数 : プラグインのバージョン
version=$1

#上の階層へ
cd ..

#zプラグインファイルをip化
zip -r arkhe-toolkit.zip arkhe-toolkit -x "*/.*" "*/__*" "*/bin*" "*/node_modules*" "*/vendor*" "*/src/*" "*gulpfile.js" "*phpcs.xml" "*README.md"

#設定ファイル系削除
zip --delete arkhe-toolkit.zip  "arkhe-toolkit/composer*" "arkhe-toolkit/webpack*" "arkhe-toolkit/package*"

#zipファイルを移動
mv arkhe-toolkit.zip ./arkhe-cdn/arkhe-toolkit-${version}.zip
