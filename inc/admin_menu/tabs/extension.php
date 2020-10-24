<?php
namespace Arkhe_Toolkit;

/**
 * 「拡張機能」タブの設定を登録
 */
defined( 'ABSPATH' ) || exit;

// PAGE_NAME
$page_name = 'arkhe_menu_page_extension';

// ウィジェットエリアの追加
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'Extension of widget area', 'arkhe-toolkit' ),
	'key'       => 'widget_area',
	'page_name' => $page_name,
	'db'        => 'extension',
] );

// ユーザー情報の追加
\Arkhe_Toolkit::add_menu_section( [
	'title'     => __( 'Extension of user profile information', 'arkhe-toolkit' ),
	'key'       => 'user_meta',
	'page_name' => $page_name,
	'db'        => 'extension',
] );
