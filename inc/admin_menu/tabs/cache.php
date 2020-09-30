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
	'title'     => __( 'キャッシュ機能の設定', 'arkhe-toolkit' ),
	'key'       => 'cache',
	'page_name' => $page_name,
] );


/**
 * キャッシュのリセットボタン
 */
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'キャッシュのリセット', 'arkhe-toolkit' ),
	'key'       => 'cache_reset',
	'page_name' => $page_name,
	'page_cb'   => '\Arkhe_Toolkit\cache_reset_cb',
] );

function cache_reset_cb() {
	?>
	<button type="button" class="arkhe-btn-clearCache button button-primary button-large">
		<?=esc_attr__( 'キャッシュクリア', 'arkhe-toolkit' )?>
	</button>
	<?php
}
