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
	'title'     => __( 'Parts cache', 'arkhe-toolkit' ),
	'key'       => 'cache',
	'page_name' => $page_name,
	'db'        => 'cache',
] );
