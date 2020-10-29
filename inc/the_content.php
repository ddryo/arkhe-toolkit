<?php
namespace Arkhe_Toolkit;

add_action( 'wp', function() {

	global $wp_embed;

	$use_lazysizes = apply_filters( 'arkhe_toolkit_use_lazysizes', \Arkhe_Toolkit::get_data( 'extension', 'use_lazysizes' ) );

	if ( ! is_admin() ) {

		// ショートコード展開より後に実行する処理たち

		add_filter( 'the_content', [ $wp_embed, 'autoembed' ], 12 ); // 再利用ブロックでも埋め込みを有効化する
		if ( \Arkhe_Toolkit::get_data( 'extension', 'use_lazysizes' ) ) {
			add_filter( 'wp_lazy_loading_enabled', '__return_false' );
			add_filter( 'the_content', '\Arkhe_Toolkit\remove_empty_p', 12 );
		}
		if ( $use_lazysizes ) {
			add_filter( 'the_content', '\Arkhe_Toolkit\add_lazyload', 12 );
		}
		// add_filter( 'the_content', '\Arkhe_Toolkit\add_toc' ], 12 );
	};

	// カスタムHTMLウィジェット にも処理を追加
	add_filter( 'widget_text', 'do_shortcode' );
	add_filter( 'widget_text', [ $wp_embed, 'autoembed' ], 12 );

	// テキストウィジェット にも処理を追加
	add_filter( 'widget_text_content', [ $wp_embed, 'autoembed' ], 12 );

	if ( $use_lazysizes ) {
		add_filter( 'widget_text', '\Arkhe_Toolkit\add_lazyload', 12 );
		add_filter( 'widget_text_content', '\Arkhe_Toolkit\add_lazyload', 12 );
	}
});



/**
 * 空のpタグを除去
 */
function remove_empty_p( $content ) {
	$content = str_replace( '<p></p>', '', $content );
	return $content;
}


/**
 * lazyloadを追加
 */
function add_lazyload( $content ) {

	// サーバーサイドレンダー, wp-json/wp/v2 からはフック通さない
	if ( defined( 'REST_REQUEST' )  ) return $content;

	$content = preg_replace_callback(
		'/<(img|video|iframe)([^>]*)>/',
		function( $matches ) {

			$tag   = $matches[1];
			$props = rtrim( $matches[2], '/' );

			// すでにlazyload設定が済んでいれば何もせず返す
			if ( strpos( $props, ' data-src=' ) !== false || strpos( $props, ' data-srcset=' ) !== false ) {
				return $matches[0];
			}

			// インライン画像の場合は -no-lb つけるだけ
			if ( 'img' === $tag && strpos( $props, 'style=' ) !== false ) {
				$props = str_replace( ' class="', ' class="-no-lb ', $props );
				return '<' . $tag . $props . '>';
			}

			// srcを取得
			preg_match( '/\ssrc="([^"]*)"/', $props, $src_matches );
			$src = ( $src_matches ) ? $src_matches[1] : '';
			if ( ! $src ) return $matches[0]; // srcなければ何もせず返す

			// src を data-srcへ
			$props = str_replace( ' src=', ' src="' . ARKHE_PLACEHOLDER . '" data-src=', $props );

			// srcset を data-srcsetへ
			$props = str_replace( ' srcset=', ' data-srcset=', $props );

			// width , height指定を取得
			preg_match( '/\swidth="([0-9]*)"/', $props, $width_matches );
			preg_match( '/\sheight="([0-9]*)"/', $props, $height_matches );
			$width  = ( $width_matches ) ? $width_matches[1] : '';
			$height = ( $height_matches ) ? $height_matches[1] : '';

			if ( $width && $height ) {
				// widthもheightもある時
				$props .= ' data-aspectratio="' . $width . '/' . $height . '"';
			} else {
				$img_size = \Arkhe_Toolkit::get_media_px_size( $src );

				if ( $img_size ) {
					$ratio  = $img_size['width'] . '/' . $img_size['height'];
					$props .= ' data-aspectratio="' . $ratio . '"';

					// width すらない時
					if ( ! $width ) {
						$props .= ' width="' . $img_size['width'] . '"';
					}
				}
			}

			// クラスの追加
			if ( strpos( $props, 'class=' ) === false ) {
				// class自体がまだがなければ
				$props .= ' class="lazyload" ';
			} else {
				// クラスの中身を調べる
				$props = preg_replace_callback(
					'/class="([^"]*)"/',
					function( $class_match ) {
						$class_value = $class_match[1];
						// クラスにまだ 'lazyload' が付与されていなければ
						if ( strpos( $class_value, 'lazyload' ) === false ) {
							return 'class="' . $class_value . ' lazyload"';
						}
						return $class_match[0];
						},
					$props
				);
				// $props = preg_replace( '/class="([^"]*)"/', 'class="$1 lazyload"', $props );
			}

			return '<' . $tag . $props . '>';
		},
		$content
	);

	return $content;
}
