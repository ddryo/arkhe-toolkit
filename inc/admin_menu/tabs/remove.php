<?php
/**
 * 機能停止タブの設定項目
 */

// PAGE_NAME
$page_name = 'arkhe_menu_page_remove';

/**
 * テストセクション
 */
$section_name = 'arkhe_section_remove_core';
add_settings_section(
	$section_name,
	__( 'WordPress本体の機能', 'arkhe-toolkit' ),
	'',
	$page_name
);

add_settings_field(
	$section_name . '_fields',
	'',
	function( $args ) {
		include __DIR__ . '/section/' . $args['filename'] . '.php';
	},
	$page_name,
	$section_name,
	[ 'filename' => 'remove_core' ]
);
