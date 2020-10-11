<?php
/**
 * 「キャッシュ機能」タブ > キャッシュセクション
 */
$remove_settings = [
	'cache_header'  => __( 'Cache header', 'arkhe-toolkit' ),
	'cache_sidebar' => __( 'Cache sidebar', 'arkhe-toolkit' ),
	'cache_footer'  => __( 'Cache footer', 'arkhe-toolkit' ),
];
foreach ( $remove_settings as $key => $label ) {
	\Arkhe_Toolkit::output_checkbox([
		'db'    => $cb_args['db'],
		'key'   => $key,
		'label' => $label,
	]);
}
?>
<br>
<button type="button" class="arkhe-btn-clearCache button">
	<?=esc_attr__( 'Clear Cache', 'arkhe-toolkit' )?>
</button>
