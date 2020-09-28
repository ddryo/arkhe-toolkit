<?php
	/**
	 * テーマファイル読み込み後に動かす処理
	 */
	// public function _after_setup_theme() {

	// 	// アップデートチェック
	// 	if ( is_admin() ) {
	// 		if ( ! class_exists( '\Puc_v4_Factory' ) ) {
	// 			require_once ARKHE_TOOLKIT_PATH . 'inc/update/plugin-update-checker.php';
	// 		}
	// 		if ( class_exists( '\Puc_v4_Factory' ) ) {
	// 			try {
	// 				\Puc_v4_Factory::buildUpdateChecker(
	// 					'http://loos.s77.coreserver.jp/wp-plugin/pb/pro/update.json',
	// 					ARKHE_TOOLKIT_PATH . 'useful-blocks-pro.php',
	// 					'useful-blocks-pro'
	// 				);
	// 			} catch ( \Throwable $e ) {
	// 				echo 'Update Error: ' . $e->getMessage() . PHP_EOL;
	// 			}
	// 		}
	// 	}

	// }