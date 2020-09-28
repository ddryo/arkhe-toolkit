<?php
/**
 * 拡張機能タブの設定項目
 */
$page_name = \Arkhe_Toolkit::MENU_PAGE_NAMES['extension'];

/**
 * テストセクション
 */
$section_name = 'arkhe_section_test';
add_settings_section(
	$section_name,
	__( 'テストセクション', 'arkhe-toolkit' ),
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
	[ 'filename' => 'test' ]
);
