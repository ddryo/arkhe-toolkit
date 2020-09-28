<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * 管理ツールバーのカスタマイズ
 */
add_filter( 'admin_bar_menu', 'arkhe_plus_hook__admin_bar_menu', 99 );


function arkhe_plus_hook__admin_bar_menu( $wp_admin_bar ) {

	// 「カスタマイズ」
	if ( is_admin() ) {
		$wp_admin_bar->add_menu(
			[
				'id'    => 'customize',
				'title' => '<span class="ab-icon"></span><span class="ab-label">' . __( 'Customize' ) . '</span>',
				'href'  => admin_url( 'customize.php' ),
			]
		);
	}

	// 親メニュー
	$wp_admin_bar->add_menu(
		[
			'id'    => 'arkhe_settings',
			'title' => '<span class="ab-icon"></span><span class="ab-label">' . __( 'LOOS設定', 'arkhe-toolkit' ) . '</span>',
			'href'  => admin_url( 'admin.php?page=arkhe_settings' ),
			'meta'  => [
				'class' => 'swell-menu',
			],
		]
	);
	$wp_admin_bar->add_menu(
		[
			'parent' => 'arkhe_settings',
			'id'     => 'arkhe_settings_menu',
			'meta'   => [],
			'title'  => __( '設定ページへ', 'arkhe-toolkit' ),
			'href'   => admin_url( 'admin.php?page=arkhe_settings' ),
		]
	);

	// $wp_admin_bar->add_menu([
	// 	'parent' => 'arkhe_settings',
	// 	'id'     => 'arkhe_settings_manual_link',
	// 	'meta'   => ['target' => '_blank'],
	// 	'title'  => 'マニュアル',
	// 	'href'   => 'https://swell-theme.com/manual/'
	// ]);
	// $wp_admin_bar->add_menu([
	// 	'parent' => 'arkhe_settings',
	// 	'id'     => 'arkhe_settings_forum_link',
	// 	'meta'   => ['target' => '_blank'],
	// 	'title'  => 'フォーラム',
	// 	'href'   => 'https://u.swell-theme.com/community/'
	// ]);
}
