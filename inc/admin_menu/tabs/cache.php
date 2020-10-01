<?php
namespace Arkhe_Toolkit;

/**
 * 「キャッシュ」タブの設定を登録
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// PAGE_NAME
$page_name = 'arkhe_menu_page_cache';


/**
 * キャッシュのオン・オフ
 */
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'Cache settings', 'arkhe-toolkit' ),
	'key'       => 'cache',
	'page_name' => $page_name,
] );


/**
 * キャッシュのリセットボタン
 */
\Arkhe_Toolkit::add_menu_section( [
	// 'title'     => __( 'Clear Cache', 'arkhe-toolkit' ),
	'key'       => 'cache_reset',
	'page_name' => $page_name,
	'page_cb'   => '\Arkhe_Toolkit\cache_reset_cb',
] );

function cache_reset_cb() {
	?>
	<button type="button" class="arkhe-btn-clearCache button">
		<?=esc_attr__( 'Clear Cache', 'arkhe-toolkit' )?>
	</button>
	<?php
}
