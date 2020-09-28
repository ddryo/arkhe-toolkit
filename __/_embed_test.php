<?php
/**
 * oEmbed 停止
 */
if ( 0 ) {
	add_action( 'wp_enqueue_scripts', function() {
		// embed系script除外
		wp_deregister_script( 'wp-embed' );
	});

	remove_action('wp_head','rest_output_link_wp_head'); //Bad value : https://api.w.org/ を消す	
	remove_action('wp_head','wp_oembed_add_discovery_links'); // Remove oEmbed discovery links.
	remove_action('wp_head','wp_oembed_add_host_js'); // Remove oEmbed-specific JavaScript
	// remove_action('template_redirect', 'rest_output_link_header', 11 ); // ?
	// wp_oembed_add_provider('https://*', 'https://hatenablog.com/oembed'); // はてな

	// oembed無効 : Turn off oEmbed auto discovery.
	add_filter('embed_oembed_discover', '__return_false');

	//Embeds
	remove_action( 'parse_query', 'wp_oembed_parse_query' );
	remove_action( 'wp_head', 'wp_oembed_remove_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_remove_host_js' );
	//本文中のURLが内部リンクの場合にWordpressがoembedをしてしまうのを解除(WP4.5.3向けの対策)
	remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result' );



	// embed_maybe_make_link -> 機能停止中は全部こっち
	add_filter('embed_maybe_make_link', function( $output, $url ) {
		return 'maybe!' . $url;
	},99,2);


	add_filter('embed_oembed_html', function( $cache, $url, $attr, $post_ID ) {
		return 'oembed!' . $url;
	},99,4);
}
