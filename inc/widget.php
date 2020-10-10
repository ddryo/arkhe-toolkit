<?php
namespace Arkhe_Toolkit;

/**
 * ウィジェット出力
 */
add_action( 'wp', '\Arkhe_Toolkit\add_ex_widgets' );
function add_ex_widgets() {

	// ブログページ
	if ( is_home() ) {
		add_action( 'arkhe_before_home_content', '\Arkhe_Toolkit\add_before_home_widget' );
		add_action( 'arkhe_after_home_content', '\Arkhe_Toolkit\add_after_home_widget' );
	} elseif ( is_front_page() ) {
		return;
	} elseif ( is_page() ) {
		add_action( 'arkhe_before_page_content', '\Arkhe_Toolkit\add_before_page_widget' );
		add_action( 'arkhe_after_page_content', '\Arkhe_Toolkit\add_after_page_widget' );
	} elseif ( is_single() ) {
		add_action( 'arkhe_before_single_content', '\Arkhe_Toolkit\add_before_single_widget' );
		add_action( 'arkhe_after_single_content', '\Arkhe_Toolkit\add_after_single_widget' );
	}

	// 追尾サイドバー
	// arkhe_after_sidebar_content
}

// 固定ページ上部
function add_before_page_widget() {
	if ( is_active_sidebar( 'page-top' ) ) {
		echo '<div class="w-page-top">';
		dynamic_sidebar( 'page-top' );
		echo '</div>';
	}
}

// 固定ページ下部
function add_after_page_widget() {
	if ( is_active_sidebar( 'page-bottom' ) ) {
		echo '<div class="w-page-bottom">';
		dynamic_sidebar( 'page-bottom' );
		echo '</div>';
	}
}

// 投稿ページ上部
function add_before_single_widget() {
	if ( is_active_sidebar( 'single-top' ) ) {
		echo '<div class="w-single-top">';
		dynamic_sidebar( 'single-top' );
		echo '</div>';
	}
}

// 投稿ページ下部
function add_after_single_widget() {
	if ( is_active_sidebar( 'single-bottom' ) ) {
		echo '<div class="w-single-bottom">';
		dynamic_sidebar( 'single-bottom' );
		echo '</div>';
	}
}

// ブログページ上部
function add_before_home_widget() {
	if ( is_active_sidebar( 'home-top' ) ) {
		echo '<div class="w-home-top">';
		dynamic_sidebar( 'home-top' );
		echo '</div>';
	}
}

// ブログページ下部
function add_after_home_widget() {
	if ( is_active_sidebar( 'home-bottom' ) ) {
		echo '<div class="w-home-bottom">';
		dynamic_sidebar( 'home-bottom' );
		echo '</div>';
	}
}


/**
 * ウィジェット登録
 */
add_action( 'widgets_init', '\Arkhe_Toolkit\setup_widgets', 20 );
function setup_widgets() {

	// 固定ページ用
	register_sidebar(
		[
			'name'          => __( 'Top of pages', 'arkhe-toolkit' ),
			'id'            => 'page-top',
			'description'   => __( 'Widgets in this area will be displayed in the top of pages.', 'arkhe-toolkit' ),
			'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="c-widget__title -page">',
			'after_title'   => '</div>',
		]
	);
	register_sidebar(
		[
			'name'          => __( 'Bottom of pages', 'arkhe-toolkit' ),
			'id'            => 'page-bottom',
			'description'   => __( 'Widgets in this area will be displayed in the bottom of pages.', 'arkhe-toolkit' ),
			'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="c-widget__title -page">',
			'after_title'   => '</div>',
		]
	);

	// 投稿ページ用
	register_sidebar(
		[
			'name'          => __( 'Top of posts', 'arkhe-toolkit' ),
			'id'            => 'single-top',
			'description'   => __( 'Widgets in this area will be displayed in the top of posts.', 'arkhe-toolkit' ),
			'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="c-widget__title -single">',
			'after_title'   => '</div>',
		]
	);
	register_sidebar(
		[
			'name'          => __( 'Bottom of posts', 'arkhe-toolkit' ),
			'id'            => 'single-bottom',
			'description'   => __( 'Widgets in this area will be displayed in the bottom of posts.', 'arkhe-toolkit' ),
			'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="c-widget__title -single">',
			'after_title'   => '</div>',
		]
	);

	// ブログページ用
	register_sidebar(
		[
			'name'          => __( 'Top of home', 'arkhe-toolkit' ),
			'id'            => 'home-top',
			'description'   => __( 'Widgets in this area will be displayed in the top of home.', 'arkhe-toolkit' ),
			'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="c-widget__title -home">',
			'after_title'   => '</div>',
		]
	);
	register_sidebar(
		[
			'name'          => __( 'Bottom of home', 'arkhe-toolkit' ),
			'id'            => 'home-bottom',
			'description'   => __( 'Widgets in this area will be displayed in the bottom of home.', 'arkhe-toolkit' ),
			'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="c-widget__title -home">',
			'after_title'   => '</div>',
		]
	);
}
