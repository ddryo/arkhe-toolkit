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
	<tr class="form-field">
		<th><?=esc_html__( 'List layout', 'arkhe-toolkit' )?></th>
		<td>
			<?php
				$default  = __( 'Follow base settings', 'arkhe-toolkit' );
				$meta_val = get_term_meta( $the_term_id, 'ark_meta_list_type', 1 );
				if ( class_exists( '\Arkhe' ) && isset( \Arkhe::$list_layouts ) ) {
					\Arkhe_Toolkit::meta_select( 'ark_meta_list_type', \Arkhe::$list_layouts, $meta_val, $default );
				} else {
					echo '※ ' . esc_html__( 'Please update the version of "Arkhe".', 'arkhe-toolkit' );
				}
			?>
		</td>
	</tr>
<?php
}

// 保存処理
function save_term_metas( $term_id ) {

	$meta_array = [
		'ark_meta_list_type',
	];
	foreach ( $meta_array as $metakey ) {
		if ( isset( $_POST[ $metakey ] ) ) {
			update_term_meta( $term_id, $metakey, $_POST[ $metakey ] );
		}
	}
}
