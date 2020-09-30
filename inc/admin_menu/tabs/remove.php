<?php
namespace Arkhe_Toolkit;

/**
 * 「機能停止」タブの設定項目
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// PAGE_NAME
$page_name = 'arkhe_menu_page_remove';

/**
 * テストセクション
 */
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'WordPress本体の機能', 'arkhe-toolkit' ),
	'key'       => 'remove_core',
	'page_name' => $page_name,
] );
