<?php
/**
 * アップデートチェック
 */
add_action( 'after_setup_theme', function() {
	if ( ! \Arkhe::$has_pro_licence || ! \Arkhe::$ex_update_path ) return;

	// echo '<pre style="margin-left: 100px;">';
	// var_dump( \Arkhe::$ex_update_path );
	// echo '</pre>';

	if ( ! class_exists( '\Puc_v4_Factory' ) ) {
		require_once ARKHE_TOOLKIT_PATH . 'inc/update/plugin-update-checker.php';
	}
	if ( class_exists( '\Puc_v4_Factory' ) ) {
		\Puc_v4_Factory::buildUpdateChecker(
			\Arkhe::$ex_update_path . 'arkhe-toolkit.json',
			ARKHE_TOOLKIT_PATH . 'arkhe-toolkit.php',
			'arkhe-toolkit'
		);
	}
});
