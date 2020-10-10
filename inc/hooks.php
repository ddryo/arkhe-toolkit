<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * カテゴリーの説明文に対するフィルター処理を緩める ( wp_filter_kses -> wp_kses_post )
 */
remove_filter( 'pre_term_description', 'wp_filter_kses' );
add_filter( 'pre_term_description', 'wp_kses_post' );


/**
 * ドロワーメニューの拡張
 */
add_action( 'arkhe_root_attrs', '\Arkhe_Toolkit\hook_root_attrs' );
function hook_root_attrs( $attrs ) {

	$drawer_move = \Arkhe_Toolkit::get_data( 'customizer', 'drawer_move' );

	// ドロワーを左から展開
	if ( 'left' === $drawer_move ) {
		$attrs = str_replace( 'drawer-move="fade"', 'drawer-move="left"', $attrs );
	}

	return $attrs;

}

/**
 * 著者情報にSNSアイコンリンク追加
 */
add_action( 'arkhe_author_links', '\Arkhe_Toolkit\author_links' );
function author_links( $author_id ) {
	if ( ! $author_id ) return;

	$icon_links              = [];
	$icon_links['home2']     = get_the_author_meta( 'site2', $author_id ) ?: '';
	$icon_links['facebook']  = get_the_author_meta( 'facebook_url', $author_id ) ?: '';
	$icon_links['twitter']   = get_the_author_meta( 'twitter_url', $author_id ) ?: '';
	$icon_links['instagram'] = get_the_author_meta( 'instagram_url', $author_id ) ?: '';
	$icon_links['pinterest'] = get_the_author_meta( 'pinterest_url', $author_id ) ?: '';
	$icon_links['github']    = get_the_author_meta( 'github_url', $author_id ) ?: '';
	$icon_links['youtube']   = get_the_author_meta( 'youtube_url', $author_id ) ?: '';
	$icon_links['amazon']    = get_the_author_meta( 'amazon_url', $author_id ) ?: '';

	// 空の要素を排除してリターン
	// return array_filter( $icon_links );
	$icon_links = array_filter( $icon_links );

	?>
	<div class="p-authorBox__iconList">
		<ul class="c-iconList">
			<?php
				foreach ( $icon_links as $key => $href ) :
				if ( empty( $href ) ) continue;
				?>
				<li class="c-iconList__item -<?=esc_attr( $key )?>">
					<a href="<?=esc_url( $href )?>" target="_blank" rel="noopener" class="c-iconList__link">
				<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?=\Arkhe_Toolkit::get_svg_icon( $key ); ?>
					</a>
				</li>
				<?php
				endforeach;
			?>
		</ul>
	</div>
	<?php
}
