<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$db = 'extension';

?>
<!-- <h3 class="pcpp-setting__h3">キャッシュ</h3> -->
<?php
$remove_settings = [
	'cache_header' => __( 'ヘッダーをキャッシュする', 'arkhe-toolkit' ),
	'cache_footer' => __( 'フッターをキャッシュする', 'arkhe-toolkit' ),

];
foreach ( $remove_settings as $key => $label ) {
	\Arkhe_Toolkit::output_checkbox([
		'db'    => $db,
		'key'   => $key,
		'label' => $label,
	]);
}


	// \Arkhe_Toolkit::output_text_field([
	// 	'db'    => $db,
	// 	'key'   => 'amazon_access_key',
	// 	'label' => 'アクセスキー',
	// ]);
?>
