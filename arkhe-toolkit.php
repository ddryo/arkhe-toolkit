<?php
/**
 * Plugin Name: Arkhe Toolkit
 * Plugin URI: https://arkhe-theme.com
 * Description: Arkhe の機能拡張用プラグイン
 * Version: 1.0.0
 * Author: 了
 * Author URI: https://twitter.com/ddryo_loos
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: arkhe-toolkit
 * Domain Path: /languages
 *
 * @package Arkhe Plus
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 定数定義
 */
define( 'ARKHE_TOOLKIT_VERSION', ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? date_i18n( 'mdGis' ) : '1.0.0' );
define( 'ARKHE_TOOLKIT_URL', plugins_url( '/', __FILE__ ) );
define( 'ARKHE_TOOLKIT_PATH', plugin_dir_path( __FILE__ ) );


/**
 * Autoload Class files.
 */
spl_autoload_register(
	function( $classname ) {
		// Arkhe_Toolkit の付いたクラスだけを対象にする。
		if ( strpos( $classname, 'Arkhe_Toolkit' ) === false ) return;

		$classname = str_replace( '\\', '/', $classname );
		$classname = str_replace( 'Arkhe_Toolkit/', '', $classname );

		$file = ARKHE_TOOLKIT_PATH . 'class/' . $classname . '.php';
		if ( file_exists( $file ) ) {
			require $file;
		}
	}
);


/**
 * プラグイン実行クラス
 */
class Arkhe_Toolkit extends \Arkhe_Toolkit\Data {

	use \Arkhe_Toolkit\Output_Field, \Arkhe_Toolkit\Utility;

	public function __construct() {

		// テーマチェック
		$theme_data     = wp_get_theme();
		$theme_name     = $theme_data->get( 'Name' );
		$theme_template = $theme_data->get( 'Template' ); // 子テーマが使われている時、'arkhe' になる

		if ( 'Arkhe' !== $theme_name && 'arkhe' !== $theme_template ) return;

		// 翻訳ファイルを登録
		$locale = apply_filters( 'plugin_locale', determine_locale(), 'arkhe-toolkit' );
		load_textdomain( 'arkhe-toolkit', ARKHE_TOOLKIT_PATH . 'languages/arkhe-toolkit-' . $locale . '.mo' );

		// データセット
		self::init();

		// 管理メニュー
		require_once ARKHE_TOOLKIT_PATH . 'inc/admin_menu.php';
		require_once ARKHE_TOOLKIT_PATH . 'inc/admin_toolbar.php';

		// ユーザーメタの追加
		require_once ARKHE_TOOLKIT_PATH . 'inc/user_meta.php';

		// ファイルの読み込み
		require_once ARKHE_TOOLKIT_PATH . 'inc/enqueue_scripts.php';

		// 管理画面の表示
		require_once ARKHE_TOOLKIT_PATH . 'inc/wp_posts_table.php';
		require_once ARKHE_TOOLKIT_PATH . 'inc/wp_term_table.php';

		// 機能削除
		require_once ARKHE_TOOLKIT_PATH . 'inc/remove.php';

		// その他、フック処理
		// Hooks::init();
		require_once ARKHE_TOOLKIT_PATH . 'inc/hooks.php';

		// ショートコード
		require_once ARKHE_TOOLKIT_PATH . 'inc/shortcode.php';

		// キャッシュ
		require_once ARKHE_TOOLKIT_PATH . 'inc/cache.php';
		require_once ARKHE_TOOLKIT_PATH . 'inc/cache_clear.php';

		// ajax
		require_once ARKHE_TOOLKIT_PATH . 'inc/ajax.php';

		// アップデート
		// require_once ARKHE_TOOLKIT_PATH . 'inc/update.php';
	}
}


/**
 * プラグインファイルの実行
 */
add_action( 'plugins_loaded', function() {
	new Arkhe_Toolkit();
} );
