<?php
namespace Arkhe_Toolkit;

/**
 * カスタマイザーの設定項目を追加
 */
add_action( 'customize_register', '\Arkhe_Toolkit\add_customizer_setttings', 21 ); // テーマよりあとにフック
function add_customizer_setttings( $wp_customize ) {

	// ヘッダー設定に項目追加
	include_once ARKHE_TOOLKIT_PATH . 'inc/customizer/ex_header.php';

}
