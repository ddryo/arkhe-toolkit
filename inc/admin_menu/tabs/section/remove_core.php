<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$db = 'remove';

?>
<!-- <h3 class="pcpp-setting__h3">てすとお</h3> -->
<?php
$remove_settings = [
	'remove_wpver'       => __( 'WordPressのバージョン情報を出力しない', 'arkhe-toolkit' ),
	'remove_rel_link'    => __( 'rel="prev/next"を出力しない', 'arkhe-toolkit' ),
	'remove_wlwmanifest' => __( 'Windows Live Writeの連携停止', 'arkhe-toolkit' ),
	'remove_rsd_link'    => __( 'EditURI(RSD Link)の停止', 'arkhe-toolkit' ),
	'remove_emoji'       => __( '絵文字用のスクリプトの読み込みをしない', 'arkhe-toolkit' ),
	'remove_srcset'      => __( '画像のsrcsetを出力しない', 'arkhe-toolkit' ),
	'remove_wptexturize' => __( '記号の自動変換を停止する(wptexturize無効化)', 'arkhe-toolkit' ),
	'remove_feed_link'   => __( 'RSSフィードを停止する', 'arkhe-toolkit' ),
];
foreach ( $remove_settings as $key => $label ) {
	\Arkhe_Toolkit::output_checkbox([
		'db'    => $db,
		'key'   => $key,
		'label' => $label,
	]);
}
