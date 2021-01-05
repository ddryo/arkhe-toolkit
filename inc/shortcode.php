<?php
/**
 * ショートコードを登録する
 */
namespace Arkhe_Toolkit\Shortcode;

add_filter( 'widget_text', 'do_shortcode' );

/**
 * <br> 系
 */
function spbr( $args ) {
	return '<br class="u-only-sp">';
}
add_shortcode( 'spbr', '\Arkhe_Toolkit\Shortcode\spbr' );

function pcbr( $args ) {
	return '<br class="u-only-pc">';
}
add_shortcode( 'pcbr', '\Arkhe_Toolkit\Shortcode\pcbr' );


/**
 * アイコン
 */
function icon( $args ) {
	if ( empty( $args ) ) return;

	$iconname = isset( $args['class'] ) ? $args['class'] : $args[0];
	return '<i class="' . $iconname . '"></i>';
}
add_shortcode( 'icon', '\Arkhe_Toolkit\Shortcode\icon' );


/**
 * 再利用ブロックの呼び出し
 */
function echo_wp_block( $args ) {

	$reuse_id = isset( $args['id'] ) ? (int) $args['id'] : 0;
	$class    = isset( $args['class'] ) ? $args['class'] : '';

	$q_args = [
		'post_type'      => 'wp_block',
		'p'              => $reuse_id,
		'no_found_rows'  => true,
		'posts_per_page' => 1,
	];

	$the_query = new \WP_Query( $q_args );
	$content   = '';
	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) :
			$the_query->the_post();
			$content = get_the_content(); // 'the_content'フックを通させない
	endwhile;
	endif;
	wp_reset_postdata();

	// ブロックでセットしたクラスを受け取れるように
	$wrap_class = 'c-reuseBlock c-postContent';

	if ( $class ) $wrap_class .= ' ' . $class;

	return '<div class="' . esc_attr( $wrap_class ) . '">' .
		do_blocks( do_shortcode( $content ) ) .
	'</div>';
}

add_shortcode( 'reuse_block', '\Arkhe_Toolkit\Shortcode\echo_wp_block' );
