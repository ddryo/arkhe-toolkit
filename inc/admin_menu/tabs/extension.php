<?php
namespace Arkhe_Toolkit\Menu;

/**
 * 「拡張機能」タブの設定を登録
 */
defined( 'ABSPATH' ) || exit;

// PAGE_NAME
$page_name = 'arkhe_menu_page_extension';
$db_name   = 'extension';

// ウィジェットエリアの追加
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'Extension of widget area', 'arkhe-toolkit' ),
	'key'       => 'widget_area',
	'page_name' => $page_name,
	'db'        => $db_name,
] );

// コンテンツへの追加処理
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'Additional processing to the content', 'arkhe-toolkit' ),
	'key'       => 'content',
	'page_name' => $page_name,
	'db'        => $db_name,
] );

// 高速化機能
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'Speed-up function', 'arkhe-toolkit' ),
	'key'       => 'speed',
	'page_name' => $page_name,
	'db'        => $db_name,
] );

// 構造化データ
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'Structured Data', 'arkhe-toolkit' ),
	'key'       => 'json_ld',
	'page_name' => $page_name,
	'db'        => $db_name,
] );

// ユーザー情報の追加
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'Extension of user profile information', 'arkhe-toolkit' ),
	'key'       => 'user_meta',
	'page_name' => $page_name,
	'db'        => $db_name,
] );
