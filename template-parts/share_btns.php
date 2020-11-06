<?php
/**
 * SNSシェアボタン用テンプレート
 * @phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
 */

defined( 'ABSPATH' ) || exit;


$settings    = \Arkhe_Toolkit::get_data( 'customizer' );
$the_id      = $args['post_id'] ?: get_the_ID();
$position    = $args['position'] ?: '';
$share_url   = get_permalink( $the_id );
$share_title = html_entity_decode( get_the_title( $the_id ) );

// $hashtags     = $settings['share_hashtags'];
// $via          = $settings['share_via'];
$show_urlcopy = $settings['show_share_urlcopy'];

$share_btns = [
	'facebook' => [
		'check_key'   => 'show_share_fb',
		'title'       => __( 'Share on Facebook', 'arkhe-toolkit' ),
		'href'        => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $share_url ),
		'window_size' => 'height=800,width=600',
	],
	'twitter' => [
		'check_key'   => 'show_share_tw',
		'title'       => __( 'Share on Twitter', 'arkhe-toolkit' ),
		'href'        => 'https://twitter.com/share?',
		'window_size' => 'height=400,width=600',
		'querys'      => [
			'url'  => $share_url,
			'text' => $share_title,
		],
	],
	'hatebu' => [
		'check_key'   => 'show_share_hatebu',
		'title'       => __( 'Register in Hatena Bookmark', 'arkhe-toolkit' ),
		'href'        => '//b.hatena.ne.jp/add?mode=confirm&url=' . urlencode( $share_url ),
		'window_size' => 'height=600,width=1000',
	],
	'pocket' => [
		'check_key' => 'show_share_pocket',
		'title'     => __( 'Save to Pocket', 'arkhe-toolkit' ),
		'href'      => 'https://getpocket.com/edit?',
		'querys'    => [
			'url'   => $share_url,
			'title' => $share_title,
		],
	],
	'pinterest' => [
		'check_key' => 'show_share_pin',
		'title'     => __( 'Save pin', 'arkhe-toolkit' ),
		'href'      => 'https://jp.pinterest.com/pin/create/button/',
		'attrs'     => 'data-pin-do="buttonBookmark" data-pin-custom="true" data-pin-lang="ja"',
	],
	'line' => [
		'check_key' => 'show_share_line',
		'title'     => __( 'Send to LINE', 'arkhe-toolkit' ),
		'href'      => 'https://social-plugins.line.me/lineit/share?',
		'querys'    => [
			'url'   => $share_url,
			'text'  => $share_title,
		],
	],
];

?>
<div class="c-shareBtns" data-pos="<?=esc_attr( $position )?>">

	<?php do_action( 'arkhe_toolkit_before_share_btns_list' ); ?>

	<ul class="c-shareBtns__list">
		<?php foreach ( $share_btns as $key => $data ) : ?>
		<?php
			if ( ! $settings[ $data['check_key'] ] ) continue;

			// ピンタレストがオンの時
			if ( 'pinterest' === $key ) \Arkhe_Toolkit::$use_pinterest = true;

			// href 生成
			if ( isset( $data['querys'] ) ) :
				$querys = $data['querys'];
				if ( has_filter( 'arkhe_toolkit_share_btn_querys' ) ) {
					$querys = apply_filters( 'arkhe_toolkit_share_btn_querys', $querys, $key );
				}
				$href = $data['href'] . http_build_query( $querys, '', '&' );
			else :
				$href = $data['href'];
			endif;

			$btn_attrs  = 'href="' . esc_url( $href ) . '"';
			$btn_attrs .= ' title="' . $data['title'] . '"';

			// onclick
			if ( isset( $data['window_size'] ) ) :
				$window_size = $data['window_size'];
				$onclick     = "javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,${window_size}');return false;";
				$btn_attrs  .= ' onclick="' . $onclick . '"';
			endif;

			// 追加の属性があれば
			if ( isset( $data['attrs'] ) ) $btn_attrs .= ' ' . $data['attrs'];

			?>
			<li class="c-shareBtns__item -<?=$key?>">
				<a class="c-shareBtns__btn u-flex--c" <?=$btn_attrs?> target="_blank" role="button">
					<?php echo \Arkhe_Toolkit::get_svg_icon( $key, 'c-shareBtns__icon' ); ?>
				</a>
			</li>
		<?php endforeach; ?>
		<?php if ( $show_urlcopy ) : ?>
			<?php \Arkhe_Toolkit::$use_clipboard_js = true; ?>
			<li class="c-shareBtns__item -copy">
				<div class="c-urlcopy c-shareBtns__btn" data-clipboard-text="<?=esc_url( $share_url )?>" title="<?=__( 'Copy the URL', 'arkhe-toolkit' )?>">
					<div class="c-urlcopy__content">
						<?php echo \Arkhe_Toolkit::get_svg_icon( 'clipboard-copy', 'c-shareBtns__icon -to-copy' ); ?>
						<?php echo \Arkhe_Toolkit::get_svg_icon( 'clipboard-copied', 'c-shareBtns__icon -copied' ); ?>
					</div>
				</div>
				<div class="c-copyedPoppup">URL Copied!</div>
			</li>
		<?php endif; ?>
	</ul>
</div>
