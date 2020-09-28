<?php
use \Arkhe_Toolkit\Admin_Menu;
if ( ! defined( 'ABSPATH' ) ) exit;

// 同じキーに配列で保存する設定
// $setting_tabs = [
// 	'speed'     => __( '高速化', 'arkhe-toolkit' ),
// 	'remove'    => __( '機能停止', 'arkhe-toolkit' ),
// 	'reset'     => __( 'リセット', 'arkhe-toolkit' ),
// ];

$setting_tabs          = \Arkhe_Toolkit::$menu_tabs;
$setting_tabs['reset'] = __( 'リセット', 'arkhe-toolkit' );

// 現在のタブ
$now_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'speed';

// メッセージ用
$green_message = '';

// Settings API は $_REQUEST でデータが渡ってくる
if ( isset( $_REQUEST['settings-updated'] ) && $_REQUEST['settings-updated'] ) {
	$green_message = '設定を保存しました。';
}

// メッセージの表示
if ( $green_message ) {
	echo '<div class="notice updated is-dismissible"><p>' . $green_message . '</p></div>';
}
?>

<div id="arkhe-menu" class="arkhe-menu">

	<h1 class="arkhe-menu__title">Arkhe設定</h1>

	<?php
		$data = \Arkhe_Toolkit::get_data();
		// echo '<pre style="margin-left: 100px;">';
		// var_dump( $data );
		// echo '</pre>';
	?>

	<div class="nav-tab-wrapper">
		<?php
			foreach ( $setting_tabs as $key => $val ) :
			$tab_url   = admin_url( 'admin.php?page=arkhe_settings' ) . '&tab=' . $key;
			$nav_class = ( $now_tab === $key ) ? 'nav-tab nav-tab-active' : 'nav-tab';

			echo '<a href="' . esc_url( $tab_url ) . '" class="' . esc_attr( $nav_class ) . '">' . esc_html( $val ) . '</a>';
			endforeach;
		?>
	</div>
	<div class="arkhe-menu__body">
		<form method="POST" action="options.php">
		<?php
			// foreach ( $setting_tabs as $key => $val ) :
			$key = $now_tab;
			// $tab_class = ( $now_tab === $key ) ? 'tab-contents act_' : 'tab-contents';
			// echo '<div class="' . esc_attr( $tab_class ) . '">';

			// ファイルがあればそれを読み込む。
			// if ( file_exists( ARKHE_TOOLKIT_PATH . 'inc/admin_menu/tabs/' . $key . '.php' ) ) :
			// 	include_once ARKHE_TOOLKIT_PATH . 'inc/admin_menu/tabs/' . $key . '.php';
			// else :
				// ファイルなければ
				do_settings_sections( \Arkhe_Toolkit::MENU_PAGE_NAMES[ $key ] );
				submit_button( '', 'primary large', 'submit_' . $key );
			// endif;

			// echo '</div>';
			// endforeach;

			settings_fields( 'arkhe_menu_group_' . $key ); // settings_fieldsがnonceなどを出力するだけ
		?>
		</form>
	</div>
</div>
