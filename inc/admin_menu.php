<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 管理画面に独自メニューを追加
 */
add_action( 'admin_menu', function () {

	// 「Arkhe設定」を追加
	add_menu_page(
		'Arkhe設定', // ページタイトルタグ
		'Arkhe設定', // メニュータイトル
		'manage_options', // 必要な権限
		\Arkhe_Toolkit::MENU_SLUG, // このメニューを参照するスラッグ名
		'\Arkhe_Toolkit\display_setting_page', // 表示内容
		'', // アイコン
		29 // 管理画面での表示位置
	);

	// トップメニュー複製
	add_submenu_page(
		\Arkhe_Toolkit::MENU_SLUG,
		'Arkhe設定',
		__( 'Arkhe設定', 'arkhe-toolkit' ), // サブ側の名前
		'manage_options',
		\Arkhe_Toolkit::MENU_SLUG, // 親と同じに
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
		'extension' => __( '拡張機能', 'arkhe-toolkit' ),
		'cache'     => __( 'キャッシュ機能', 'arkhe-toolkit' ),
		'remove'    => __( '機能停止', 'arkhe-toolkit' ),
		// 'reset'     => __( 'リセット', 'arkhe-toolkit' ),
	];

	\Arkhe_Toolkit::$menu_tabs = $menu_tabs;

	foreach ( $menu_tabs as $key => $value ) {

		register_setting( 'arkhe_menu_group_' . $key, \Arkhe_Toolkit::DB_NAMES[ $key ] );
		require_once ARKHE_TOOLKIT_PATH . 'inc/admin_menu/tabs/' . $key . '.php';

	}

} );
