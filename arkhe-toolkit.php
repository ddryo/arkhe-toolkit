<?php
/**
 * Plugin Name: Arkhe Toolkit
 * Plugin URI: https://arkhe-theme.com
 * Description: A plugin that extends Arkhe more conveniently
 * Version: 1.2.3
 * Author: LOOS,Inc.
 * Author URI: https://loos.co.jp/
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: arkhe-toolkit
 * Domain Path: /languages
 *
 * @package Arkhe Toolkit
 */

defined( 'ABSPATH' ) || exit;

/**
 * 定数定義
 */
define( 'ARKHE_TOOLKIT_VER', ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? date_i18n( 'mdGis' ) : '1.2.3' );
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

	use \Arkhe_Toolkit\Utility,
		\Arkhe_Toolkit\SVG_Icons,
		\Arkhe_Toolkit\Output_Menu_Field,
		\Arkhe_Toolkit\Output_Meta_Field;

	public function __construct() {

		// テーマチェック : IS_ARKHE_THEME は Arkheプラグインで共通
		if ( ! defined( 'IS_ARKHE_THEME' ) ) {
			$theme_data     = wp_get_theme();
			$theme_name     = $theme_data->get( 'Name' );
			$theme_template = $theme_data->get( 'Template' ); // 子テーマが使われている時、'arkhe' になる

			$is_arkhe_theme = ( 'Arkhe' === $theme_name || 'arkhe' === $theme_template );
			define( 'IS_ARKHE_THEME', $is_arkhe_theme );
		}

		if ( ! IS_ARKHE_THEME ) return;

		// 翻訳ファイルを登録
		if ( 'ja' === determine_locale() ) {
			load_textdomain( 'arkhe-toolkit', ARKHE_TOOLKIT_PATH . 'languages/arkhe-toolkit-ja.mo' );
		} else {
			load_plugin_textdomain( 'arkhe-toolkit' );
		}

		// データセット
		self::init();

		// setup
		require_once ARKHE_TOOLKIT_PATH . 'inc/setup.php';

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

		// ショートコード
		require_once ARKHE_TOOLKIT_PATH . 'inc/shortcode.php';

		// カスタマイザー
		require_once ARKHE_TOOLKIT_PATH . 'inc/customizer.php';

		// ウィジェット
		require_once ARKHE_TOOLKIT_PATH . 'inc/widget.php';

		// キャッシュ
		require_once ARKHE_TOOLKIT_PATH . 'inc/cache_create.php';
		require_once ARKHE_TOOLKIT_PATH . 'inc/cache_clear.php';

		// ajax
		require_once ARKHE_TOOLKIT_PATH . 'inc/ajax.php';

		// カスタムフィールド
		require_once ARKHE_TOOLKIT_PATH . 'inc/post_meta.php';

		// コンテンツフック
		require_once ARKHE_TOOLKIT_PATH . 'inc/the_content.php';

		// その他、フック処理
		require_once ARKHE_TOOLKIT_PATH . 'inc/hooks.php';
		require_once ARKHE_TOOLKIT_PATH . 'inc/overwrite.php';

		// アップデートチェック
		if ( is_admin() ) {
			require_once ARKHE_TOOLKIT_PATH . 'inc/update.php';
		}

	}

}


/**
 * プラグインファイルの実行
 */
add_action( 'plugins_loaded', function() {
	new Arkhe_Toolkit();
} );
