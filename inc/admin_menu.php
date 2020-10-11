<?php
namespace Arkhe_Toolkit;

/**
 * 管理画面に独自メニューを追加
 */
add_action( 'admin_menu', function () {

	// 「Arkhe設定」
	$arkhe_menu_title = 'Arkhe';

	// 設定ページを追加
	add_menu_page(
		$arkhe_menu_title, // ページタイトルタグ
		$arkhe_menu_title, // メニュータイトル
		'manage_options', // 必要な権限
		\Arkhe_Toolkit::MENU_SLUG, // このメニューを参照するスラッグ名
		'\Arkhe_Toolkit\display_setting_page', // 表示内容
		'', // アイコン
		29 // 管理画面での表示位置
	);

	// トップメニュー複製
	add_submenu_page(
		\Arkhe_Toolkit::MENU_SLUG,
		$arkhe_menu_title,
		$arkhe_menu_title,
		'manage_options',
		\Arkhe_Toolkit::MENU_SLUG,
		'\Arkhe_Toolkit\display_setting_page'
	);

	// 「再利用ブロック」を追加
	add_menu_page(
		__( 'Reusable Block', 'arkhe-toolkit' ),
		__( 'Reusable Block', 'arkhe-toolkit' ),
		'manage_options',
		'edit.php?post_type=wp_block',
		'',
		'dashicons-image-rotate',
		81 // 「設定」 の下
	);

} );


/**
 * 「Arkhe設定」の内容
 */
function display_setting_page() {
	require_once ARKHE_TOOLKIT_PATH . 'inc/admin_menu/menu_page.php';
}


/**
 * 設定の追加
 */
add_action( 'admin_init', function() {

	$menu_tabs = [
		'extension' => __( 'Extensions', 'arkhe-toolkit' ),
		'cache'     => __( 'Cache settings', 'arkhe-toolkit' ),
		'remove'    => __( 'Stop functions', 'arkhe-toolkit' ),
		// 'reset'     => __( 'Reset settings', 'arkhe-toolkit' ),
	];

	\Arkhe_Toolkit::$menu_tabs = $menu_tabs;

	foreach ( $menu_tabs as $key => $value ) {

		register_setting( 'arkhe_menu_group_' . $key, \Arkhe_Toolkit::DB_NAMES[ $key ] );
		require_once ARKHE_TOOLKIT_PATH . 'inc/admin_menu/tabs/' . $key . '.php';

	}

} );
