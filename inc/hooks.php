<?php
namespace Arkhe_Toolkit;

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

	// ドロワーの展開方法
	$attrs['data-drawer-move'] = \Arkhe_Toolkit::get_data( 'customizer', 'drawer_move' );

	if ( \Arkhe_Toolkit::get_data( 'customizer', 'header_above_drawer' ) ) {
		$attrs['data-header-above'] = '1';
	}

	return $attrs;
}


/**
 * ヘッダーの属性
 */
add_action( 'arkhe_header_attrs', '\Arkhe_Toolkit\hook_header_attrs' );
function hook_header_attrs( $attrs ) {

	// ヘッダーがブロック化されていなければカスタマイザーデータ反映
	if ( ! \Arkhe::get_plugin_data( 'use_temlate_block' ) ) {
		// ボタンレイアウト
		$attrs['data-btns'] = \Arkhe_Toolkit::get_data( 'customizer', 'header_btn_layout' );
	}

	return $attrs;
}


/**
 * ページタイトルにサブタイトル追加
 */
add_action( 'arkhe_page_subtitle', function ( $page_id ) {
	$subtitle = get_post_meta( $page_id, 'ark_meta_subttl', true );
	if ( ! $subtitle ) return;

	echo '<span class="c-pageTitle__subtitle">' . esc_html( $subtitle ) . '</span>';
} );


/**
 * タイトル背景画像
 */
add_filter( 'arkhe_ttlbg_img_id', function ( $img_id, $page_id ) {
	$meta = get_post_meta( $page_id, 'ark_meta_ttlbg', true );
	if ( ! $meta ) return $img_id;
	return $meta;
}, 10, 2 );


/**
 * 著者情報に「役職」追加
 */
add_action( 'arkhe_after_author_name', function( $author_id ) {
	if ( ! $author_id ) return;
	if ( ! \Arkhe_Toolkit::get_data( 'extension', 'use_user_position' ) ) return;

	$position = get_the_author_meta( 'position', $author_id ) ?: '';

	if ( ! $position ) return;
	?>
		<span class="p-authorBox__position u-color-thin"><?php echo esc_html( $position ); ?></span>
	<?php
} );


/**
 * 著者情報にSNSアイコンリンク追加
 */
add_action( 'arkhe_author_links', function ( $author_id ) {
	if ( ! $author_id ) return;
	if ( ! \Arkhe_Toolkit::get_data( 'extension', 'use_user_urls' ) ) return;

	$icon_links              = [];
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
} );
