<?php
namespace Arkhe_Toolkit\Meta;

defined( 'ABSPATH' ) || exit;

add_action( 'category_edit_form_fields', '\Arkhe_Toolkit\Meta\add_term_metas', 5 );
add_action( 'post_tag_edit_form_fields', '\Arkhe_Toolkit\Meta\add_term_metas', 5 );
add_action( 'edited_terms', '\Arkhe_Toolkit\Meta\save_term_metas' );  // 編集ページ用保存時フック


/*
 * ターム「編集」画面にフィールド追加
 */
function add_term_metas( $term ) {
	$the_term_id = $term->term_id;
	if ( ! class_exists( '\Arkhe' ) ) return;

	// nonce
	wp_nonce_field( 'arkhe_nonce_term_meta', 'arkhe_nonce_term_meta' );
?>
	<tr class="swell_term_meta_title">
		<th colspan="2">
			<h2>
				<span style="position:relative;top:4px">
					<?php echo \Arkhe_Toolkit::get_svg_icon( 'arkhe' ); // phpcs:ignore?>
				</span>
				<?=esc_html__( 'Arkhe Settings', 'arkhe-toolkit' )?>
			</h2>
		</th>
	</tr>
	<?php
		if ( ! isset( \Arkhe::$list_layouts ) ) :
	?>
			<tr>
				<th></th><td>※ <?=esc_html__( 'Please update the version of "Arkhe".', 'arkhe-toolkit' )?></td>
			</tr>
	<?php
		return;
		endif;
	?>
	<tr class="form-field">
		<th></th>
		<td>
			<?php
				$label    = __( 'Show "Description"', 'arkhe-toolkit' );
				$meta_val = get_term_meta( $the_term_id, 'ark_meta_show_desc', 1 );
				if ( '' === $meta_val ) {
				$meta_val = '1';
				}
				\Arkhe_Toolkit::meta_checkbox( 'ark_meta_show_desc', $label, $meta_val, true );
			?>
		</td>
	</tr>
	<tr class="form-field">
		<th><?=esc_html__( 'List layout', 'arkhe-toolkit' )?></th>
		<td>
			<?php
				$default  = __( 'Follow base settings', 'arkhe-toolkit' );
				$meta_val = get_term_meta( $the_term_id, 'ark_meta_list_type', 1 );
				\Arkhe_Toolkit::meta_select( 'ark_meta_list_type', \Arkhe::$list_layouts, $meta_val, $default );
			?>
		</td>
	</tr>
	<tr class="form-field">
		<th><?=esc_html__( 'Sidebar', 'arkhe-toolkit' )?></th>
		<td>
			<?php
				$meta_val             = get_term_meta( $the_term_id, 'ark_meta_show_sidebar', 1 );
				$show_or_hide_options = [
					'show' => _x( 'Show', 'show', 'arkhe-toolkit' ),
					'hide' => _x( 'Hide', 'show', 'arkhe-toolkit' ),
				];
				\Arkhe_Toolkit::meta_select( 'ark_meta_show_sidebar', $show_or_hide_options, $meta_val, $default );
			?>
		</td>
	</tr>
	<tr class="form-field">
		<th><?=esc_html__( 'Title position', 'arkhe-toolkit' )?></th>
		<td>
			<?php
				// タームでは none は選択肢にいれない。
				$options  = [
					'top'   => __( 'Above the content', 'arkhe-toolkit' ),
					'inner' => __( 'Inside the content', 'arkhe-toolkit' ),
				];
				$meta_val = get_term_meta( $the_term_id, 'ark_meta_ttlpos', 1 );
				\Arkhe_Toolkit::meta_select( 'ark_meta_ttlpos', $options, $meta_val, $default );
			?>
		</td>
	</tr>
	<tr class="form-field">
		<th><?=esc_html__( 'Background image for title', 'arkhe-toolkit' )?></th>
		<td>
			<?php
				$meta_val = get_term_meta( $the_term_id, 'ark_meta_ttlbg', 1 );
				\Arkhe_Toolkit::media_btns( 'ark_meta_ttlbg', $meta_val );
			?>
		</td>
	</tr>
<?php

}

// 保存処理
function save_term_metas( $term_id ) {

	if ( ! \Arkhe_Toolkit::save_meta_check( $post_id, 'arkhe_nonce_term_meta' ) ) return;

	$meta_keys = [
		'ark_meta_show_desc',
		'ark_meta_list_type',
		'ark_meta_ttlpos',
		'ark_meta_ttlbg',
		'ark_meta_show_sidebar',
	];

	// @codingStandardsIgnoreStart
	foreach ( $meta_keys as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$meta_val = $_POST[ $key ];
			if ( ! is_bool( $meta_val ) ) {
				$meta_val = wp_kses_post( $meta_val );  // 入力された値をサニタイズ
			}

			// DBアップデート
			update_term_meta( $term_id, $key, $meta_val );
		}
	}
}
