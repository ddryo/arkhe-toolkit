<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'admin_bar_menu', function ( $wp_admin_bar ) {
	// 「カスタマイズ」
	if ( is_admin() ) {
		$wp_admin_bar->add_menu(
			[
				'id'    => 'customize',
				// phpcs:ignore WordPress.WP.I18n.MissingArgDomain
				'title' => '<span class="ab-icon"></span><span class="ab-label">' . __( 'Customize' ) . '</span>',
				'href'  => admin_url( 'customize.php' ),
			]
		);
	}

	$arkhe_menu_id = 'arkhe_settings';

	// 親メニュー
	$wp_admin_bar->add_menu(
		[
			'id'    => $arkhe_menu_id,
			'title' => '<span class="ab-icon "></span><span class="ab-label">' . __( 'Arkhe Settings', 'arkhe-toolkit' ) . '</span>',
			'href'  => admin_url( 'admin.php?page=arkhe_settings' ),
			'meta'  => [
				'class' => 'arkhe-menu',
			],
		]
	);

	// サブメニュー
	$wp_admin_bar->add_menu(
		[
			'parent' => $arkhe_menu_id,
			'id'     => $arkhe_menu_id . '_menu',
			'meta'   => [],
			'title'  => __( 'To setting page', 'arkhe-toolkit' ),
			'href'   => admin_url( 'admin.php?page=arkhe_settings' ),
		]
	);
	$wp_admin_bar->add_menu(
		[
			'parent' => $arkhe_menu_id,
			'id'     => $arkhe_menu_id . '_clear_cache',
			'meta'   => [
				'class' => 'arkhe-btn-clearCache',
			],
			'title'  => __( 'Clear Cache', 'arkhe-toolkit' ),
			'href'   => '###',
		]
	);

}, 99 );
