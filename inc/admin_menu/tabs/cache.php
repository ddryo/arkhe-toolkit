<?php
namespace Arkhe_Toolkit\Menu;

/**
 * 「キャッシュ」タブの設定を登録
 */
defined( 'ABSPATH' ) || exit;

// PAGE_NAME
$db_name   = 'cache';
$page_name = \Arkhe_Toolkit::MENU_PAGE_PREFIX . $db_name;

/**
 * キャッシュのオン・オフ
 */
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'Parts cache', 'arkhe-toolkit' ),
	'key'       => 'cache',
	'page_name' => $page_name,
	'db'        => $db_name,
	'page_cb'   => '\Arkhe_Toolkit\Menu\cb_cache',
] );

function cb_cache( $args ) {
	$remove_settings = [
		'cache_header'  => __( 'Cache header', 'arkhe-toolkit' ),
		'cache_sidebar' => __( 'Cache sidebar', 'arkhe-toolkit' ),
		'cache_footer'  => __( 'Cache footer', 'arkhe-toolkit' ),
	];
	foreach ( $remove_settings as $key => $label ) {
		\Arkhe_Toolkit::output_checkbox([
			'db'    => $args['db'],
			'key'   => $key,
			'label' => $label,
		]);
	}
?>
	<br>
	<button type="button" class="arkhe-btn-clearCache button">
		<?=esc_attr__( 'Clear Cache', 'arkhe-toolkit' )?>
	</button>
<?php
}
