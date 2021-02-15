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
add_filter( 'arkhe_root_attrs', '\Arkhe_Toolkit\hook_root_attrs' );
function hook_root_attrs( $attrs ) {

	// ドロワーの展開方法
	$attrs['data-drawer-move'] = \Arkhe_Toolkit::get_data( 'customizer', 'drawer_move' );

	if ( \Arkhe_Toolkit::get_data( 'customizer', 'header_above_drawer' ) ) {
		$attrs['data-header-above'] = '1';
	}

	return $attrs;
}


/**
 * その他、各ページへの処理（フックさせるかどうかを先に分岐させるもの）
 */
add_action( 'wp', function () {

	// ユーザー情報
	$extension = \Arkhe_Toolkit::get_data( 'extension' );
	if ( $extension['use_user_position'] ) {
		add_action( 'arkhe_after_author_name', '\Arkhe_Toolkit\hook_after_author_name' );
	}
	if ( $extension['use_user_urls'] ) {
		add_action( 'arkhe_author_links', '\Arkhe_Toolkit\hook_author_links' );
	}

	// 投稿関連
	if ( is_single() ) {
		$the_id     = get_queried_object_id();
		$customizer = \Arkhe_Toolkit::get_data( 'customizer' );

		// シェアボタン
		$show_sharebtns = apply_filters( 'arkhe_toolkit_show_sharebtns', true, $the_id );
		if ( $show_sharebtns && $customizer['show_sharebtns_top'] ) {
			add_action( 'arkhe_before_entry_content', '\Arkhe_Toolkit\hook_before_entry_content', 9 );
		}
		if ( $show_sharebtns && $customizer['show_sharebtns_bottom'] ) {
			add_action( 'arkhe_after_entry_content', '\Arkhe_Toolkit\hook_after_entry_content', 9 );
		}
	}
} );


/**
 * 著者情報に「役職」追加
 */
function hook_after_author_name( $author_id ) {
	if ( ! $author_id ) return;

	$position = get_the_author_meta( 'position', $author_id ) ?: '';

	if ( ! $position ) return;
	?>
		<span class="p-authorBox__position u-color-thin"><?php echo esc_html( $position ); ?></span>
	<?php
}


/**
 * 著者情報にSNSアイコンリンク追加
 */
function hook_author_links( $author_id ) {
	if ( ! $author_id ) return;

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
}


/**
 * シェアボタン追加
 */
function hook_before_entry_content( $the_id ) {
	if ( ! $the_id ) return;

	\Arkhe::$ex_parts_path = ARKHE_TOOLKIT_PATH;
	\Arkhe::get_part( 'share_btns', [
		'post_id'  => $the_id,
		'position' => 'top',
	] );
	\Arkhe::$ex_parts_path = '';
}
function hook_after_entry_content( $the_id ) {
	if ( ! $the_id ) return;

	\Arkhe::$ex_parts_path = ARKHE_TOOLKIT_PATH;
	\Arkhe::get_part( 'share_btns', [
		'post_id'  => $the_id,
		'position' => 'bottom',
	] );
	\Arkhe::$ex_parts_path = '';
}
