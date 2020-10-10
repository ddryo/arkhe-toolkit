<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

// 設定タブのリスト
$setting_tabs = \Arkhe_Toolkit::$menu_tabs;

// 特殊なタブを追加
$setting_tabs['reset'] = __( 'Reset', 'arkhe-toolkit' );

// 現在のタブを取得
$now_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'extension';

// 設定保存完了時、$_REQUEST でデータが渡ってくる
if ( isset( $_REQUEST['settings-updated'] ) && $_REQUEST['settings-updated'] ) {
	$green_message = __( 'Your settings have been saved.', 'arkhe-toolkit' ); // 設定を保存しました。
	echo '<div class="notice updated is-dismissible"><p>' . esc_html( $green_message ) . '</p></div>';
}

?>

<div id="arkhe-menu" class="arkhe-menu wrap">

	<div class="arkhe-menu__head">
		<h1 class="arkhe-menu__title">
			<?=esc_html__( 'Arkhe Settings', 'arkhe-toolkit' )?>
		</h1>

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
	</div>
	<div class="arkhe-menu__body">
		<?php
			// 特殊な設定のタブ
			if ( 'reset' === $now_tab ) :
			include __DIR__ . '/tabs/' . $now_tab . '.php';
			else :
		?>
			<form method="POST" action="options.php">
				<?php
					// 設定項目の出力
					do_settings_sections( 'arkhe_menu_page_' . $now_tab );

					// nonceなどを出力
					settings_fields( 'arkhe_menu_group_' . $now_tab );

					// 保存ボタン
					submit_button( '', 'primary large', 'submit_' . $now_tab );
				?>
			</form>
		<?php endif; ?>
	</div>
</div>
