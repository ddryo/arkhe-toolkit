<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

trait Output_Field {

	/**
	 * チェックボックス
	 */
	public static function output_checkbox( $args = [] ) {

		extract( array_merge( [
			'db'    => '',
			'label' => '',
			'key'   => '',
		], $args ) );

		$name = \Arkhe_Toolkit::DB_NAMES[ $db ] . '[' . $key . ']';
		$val  = (string) \Arkhe_Toolkit::get_data( $db, $key );

		?>
		<div class="arkhe-menu__field -checkbox">
			<input type="hidden" name="<?=esc_attr( $name )?>" value="">
			<input type="checkbox" id="<?=esc_attr( $key )?>" name="<?=esc_attr( $name )?>" value="1" <?php checked( $val, '1' ); ?> />
			<label for="<?=esc_attr( $key )?>"><?=esc_html( $label )?></label>
		</div>
		<?php
	}


	/**
	 * テキストフィールド
	 */
	public static function output_text_field( $args ) {

		extract( array_merge( [
			'db'    => '',
			'label' => '',
			'key'   => '',
			'size'  => '',
		], $args ) );

		$name = \Arkhe_Toolkit::DB_NAMES[ $db ] . '[' . $key . ']';
		$val  = \Arkhe_Toolkit::get_data( $db, $key );

		?>
			<div class="arkhe-menu__field -text">
				<span class="arkhe-menu__label"><?=esc_html( $label )?></span>
				<div class="arkhe-menu__item">
					<input type="text" id="<?=esc_attr( $key )?>" name="<?=esc_attr( $name )?>" value="<?=esc_attr( $val )?>" size="40" />
				</div>
			</div>
		<?php
	}


	/**
	 * ラジオボタン
	 */
	public static function output_radio( $args ) {

		extract( array_merge( [
			'db'      => '',
			'key'     => '',
			'choices' => '',
		], $args ) );

		$name = \Arkhe_Toolkit::DB_NAMES[ $db ] . '[' . $key . ']';
		$val  = \Arkhe_Toolkit::get_data( $db, $key );

		?>
		<div class="arkhe-menu__field -radio">
			<?php
				foreach ( $choices as $value => $label ) :
				$radio_id = $key . '_' . $value;
				$checked  = checked( $val, $value );
			?>
					<label for="<?=esc_attr( $radio_id )?>" class="arkhe-menu__label">
						<input type="radio" id="<?=esc_attr( $radio_id )?>" name="<?=esc_attr( $name )?>" value="<?=esc_attr( $value )?>" <?php checked( $val, $value ); ?> >
						<span><?=esc_html( $label )?></span>
					</label>
			<?php endforeach; ?>
		</div>
		<?php
	}

}
