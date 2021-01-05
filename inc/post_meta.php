<?php
namespace Arkhe_Toolkit\Post_Meta;

use \SWELL_THEME\Parts\Setting_Field as Field;

defined( 'ABSPATH' ) || exit;

add_action( 'add_meta_boxes', '\Arkhe_Toolkit\Post_Meta\hook_add_meta_box', 5 );
add_action( 'save_post', '\Arkhe_Toolkit\Post_Meta\hook_save_post' );


/**
 * add_meta_box()
 */
function hook_add_meta_box() {
	add_meta_box(
		'arkhe_meta_for_post',
		__( 'Arkhe Settings', 'arkhe-toolkit' ),
		'\Arkhe_Toolkit\Post_Meta\cb_post_meta',
		['post', 'page' ],
		'side',
		'default',
		null
	);
}


/**
 * 【Arkhe設定】
 */
function cb_post_meta( $post ) {
	wp_nonce_field( 'arkhe_nonce_post_meta', 'arkhe_nonce_post_meta' );
	$the_id    = $post->ID;
	$post_type = $post->post_type;
	$home_id   = (int) get_option( 'page_for_posts' );
	$is_home   = $home_id === $the_id;

	$text_only_topttl = __( 'This is valid only when the title position is "Above the content".', 'arkhe-toolkit' );
?>
	<div id="arkhe_post_meta" class="ark-meta -side">
		<?php if ( 'page' === $post_type ) : ?>

			<div class="ark-meta__item">
				<?php $meta_val = get_post_meta( $the_id, 'ark_meta_ttlbg', true ); ?>
				<label for="ark_meta_ttlbg" class="ark-meta__subttl">
					<?=esc_html__( 'Background image for title', 'arkhe-toolkit' )?>
				</label>
				<div class="ark-meta__field">
					<?php \Arkhe_Toolkit::media_btns( 'ark_meta_ttlbg', $meta_val ); ?>
				</div>
				<p class="ark-meta__desc">
					<?=esc_html( $text_only_topttl )?>
				</p>
			</div>

			<div class="ark-meta__item">
				<div class="ark-meta__subttl">
					<?=esc_html__( 'Subtitle', 'arkhe-toolkit' )?>
				</div>
				<?php
					$field_args = [
						'id'   => 'ark_meta_subttl',
						'meta' => get_post_meta( $the_id, 'ark_meta_subttl', true ),
					];
					\Arkhe_Toolkit::meta_text_input( $field_args );
				?>
			</div>
		<?php elseif ( 'post' === $post_type ) : ?>

		<?php endif; ?>

		<div class="ark-meta__item">
			<div class="ark-meta__subttl">
				<?=esc_html__( 'Display settings', 'arkhe-toolkit' )?>
			</div>
			<?php
				$show_or_hide_options = [
					'show' => _x( 'Show', 'show', 'arkhe-toolkit' ),
					'hide' => _x( 'Hide', 'show', 'arkhe-toolkit' ),
				];

				$meta_items = [];

				if ( 'page' === $post_type ) :
					$meta_items['ark_meta_ttlpos'] = [
						'title'   => __( 'Title position', 'arkhe-toolkit' ),
						'options' => [
							'top'   => __( 'Above the content', 'arkhe-toolkit' ),
							'inner' => __( 'Inside the content', 'arkhe-toolkit' ),
							// 'none'  => __( 'None', 'arkhe-toolkit' ),
						],
					];
				elseif ( 'post' === $post_type ) :
					$meta_items['ark_meta_show_thumb']   = [
						'title'   => __( 'Featured image', 'arkhe-toolkit' ),
						'options' => $show_or_hide_options,
					];
					$meta_items['ark_meta_show_author']  = [
						'title'   => __( 'Author data', 'arkhe-toolkit' ),
						'options' => $show_or_hide_options,
					];
					$meta_items['ark_meta_show_related'] = [
						'title'   => __( 'Related posts', 'arkhe-toolkit' ),
						'options' => $show_or_hide_options,
					];
				endif;

				$meta_items['ark_meta_show_sidebar'] = [
					'title'       => __( 'Sidebar', 'arkhe-toolkit' ),
					'options'     => $show_or_hide_options,
					'description' => '※ ' . __( 'Only valid with the default template.', 'arkhe-toolkit' ),
				];

				foreach ( $meta_items as $key => $data ) :
					$meta_val = get_post_meta( $the_id, $key, true );
			?>
					<div class="ark-meta__field -select">
						<label for="<?=esc_attr( $key )?>" class="ark-meta__label">
							<?=esc_html( $data['title'] )?>
						</label>
						<?php \Arkhe_Toolkit::meta_select( $key, $data['options'], $meta_val ); ?>
						<?php
							if ( isset( $data['description'] ) ) :
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo '<p class="ark-meta__desc">' . $data['description'] . '</p>';
							endif;
						?>
					</div>
			<?php
				endforeach;

				$meta_checkboxes = [];

				if ( ! $is_home ) :
					$meta_checkboxes['ark_meta_hide_widget_top']    = [
						'label' => __( 'Hide top-widget', 'arkhe-toolkit' ),
					];
					$meta_checkboxes['ark_meta_hide_widget_bottom'] = [
						'label' => __( 'Hide bottom-widget', 'arkhe-toolkit' ),
					];
				endif;

				if ( 'page' === $post_type ) :
					$meta_checkboxes['ark_meta_show_excerpt'] = [
						'label'       => __( 'Show page "excerpt"', 'arkhe-toolkit' ),
						'description' => $text_only_topttl,
					];
				// elseif ( 'post' === $post_type ) :
					// $meta_checkboxes['ark_meta_show_sharebtns'] = [
					// 	'label' => __( 'Hide share buttons', 'arkhe-toolkit' ),
					// ];
				endif;

				foreach ( $meta_checkboxes as $key => $data ) :
					$meta_val = get_post_meta( $the_id, $key, true );
				?>
					<div class="ark-meta__field">
						<?php
							\Arkhe_Toolkit::meta_checkbox( $key, $data['label'], $meta_val );

							if ( isset( $data['description'] ) ) :
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo '<p class="ark-meta__desc">' . $data['description'] . '</p>';
							endif;
						?>
					</div>
				<?php
				endforeach;
			?>
		</div>
	</div>
<?php
}


/**
 * 保存処理
 */
function hook_save_post( $post_id ) {

	if ( ! \Arkhe_Toolkit::save_meta_check( $post_id, 'arkhe_nonce_post_meta' ) ) return;

	$meta_keys = [
		'ark_meta_subttl',
		'ark_meta_ttlbg',
		'ark_meta_ttlpos',
		'ark_meta_show_sidebar',
		'ark_meta_show_thumb',
		'ark_meta_show_related',
		'ark_meta_show_author',
		'ark_meta_hide_widget_top',
		'ark_meta_hide_widget_bottom',
		'ark_meta_show_excerpt',
		// 'ark_meta_hide_sharebtn',
		// 'ark_meta_show_toc',
	];

	// 値の保存
	// @codingStandardsIgnoreStart
	foreach ( $meta_keys as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$meta_val = $_POST[ $key ];
			if ( ! is_bool( $meta_val ) ) {
				$meta_val = wp_kses_post( $meta_val );  // 入力された値をサニタイズ
			}

			// DBアップデート
			update_post_meta( $post_id, $key, $meta_val );
		}
	}
}
