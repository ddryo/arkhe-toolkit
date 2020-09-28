<?php
use \ARKHE_THEME\Customizer;
if ( ! defined( 'ABSPATH' ) ) exit;

// セクション : 記事下
$section = 'loos_section_after_article';
$wp_customize->add_section(
	$section,
	array(
		'title'    => __( 'Under the article', 'loos' ),
		'priority' => 10,
		'panel'    => 'loos_panel_single',
	)
);

// SNSアクションエリア設定
Customizer::big_title(
	$section,
	'sns_cta',
	array(
		'label' => __( 'SNSアクションエリア設定', 'loos' ),
	)
);

// 表示するボタン
Customizer::sub_title(
	$section,
	'sns_cta_check',
	array(
		'label' => __( '表示するボタン', 'loos' ),
	)
);

// Twitterフォローボタンを表示
Customizer::add(
	$section,
	'show_tw_follow_btn',
	array(
		'classname'   => '',
		'label'       => __( 'Twitterフォローボタン', 'loos' ),
		'type'        => 'checkbox',
	)
);

// Facebookいいねボタン
Customizer::add(
	$section,
	'show_fb_like_box',
	array(
		'classname'   => '',
		'label'       => __( 'Facebookいいねボタン', 'loos' ),
		'type'        => 'checkbox',
	)
);

// Twitterフォローボタンの対象ユーザー名
Customizer::add(
	$section,
	'tw_follow_id',
	array(
		'classname'   => '-twitter-setting',
		'label'       => __( 'Twitterフォローボタンの対象ユーザー名', 'loos' ),
		'description' => __( '@以降の文字列を指定してください。', 'loos' ),
		'type'        => 'text',
		'sanitize'    => 'wp_filter_nohtml_kses',
	)
);

// Facebookいいねボタンの対象URL
Customizer::add(
	$section,
	'fb_like_url',
	array(
		'classname'   => '-fb-setting',
		'label'       => __( 'Facebookいいねボタンの対象URL', 'loos' ),
		'type'        => 'text',
		'sanitize'    => 'wp_filter_nohtml_kses',
	)
);

// Facebookいいねボタンに使用するappID
Customizer::add(
	$section,
	'fb_like_appID',
	array(
		'classname'   => '-fb-setting',
		'label'       => __( 'Facebookいいねボタンに使用するappID', 'loos' ),
		'type'        => 'text',
		'sanitize'    => 'wp_filter_nohtml_kses',
	)
);


// 前後記事へのページリンク設定
Customizer::big_title(
	$section,
	'pn_links',
	array(
		'label' => __( '前後記事へのページリンク設定', 'loos' ),
	)
);

// 前後記事へのページリンクを表示
Customizer::add(
	$section,
	'show_page_links',
	array(
		'classname'   => '',
		'label'       => __( '前後記事へのページリンクを表示', 'loos' ),
		'type'        => 'checkbox',
	)
);

// 同じカテゴリーの記事を取得する
Customizer::add(
	$section,
	'pn_link_is_same_term',
	array(
		'classname'   => '',
		'label'       => __( '同じカテゴリーの記事を取得する', 'loos' ),
		'type'        => 'checkbox',
	)
);

// 著者情報エリアの設定
Customizer::big_title(
	$section,
	'post_author',
	array(
		'label' => __( '著者情報エリアの設定', 'loos' ),
	)
);

// 著者情報を表示
Customizer::add(
	$section,
	'show_author_box',
	array(
		'classname'   => '',
		'label'       => __( '著者情報を表示', 'loos' ),
		__( 'loos' ),
		'type'        => 'checkbox',
	)
);

// 関連記事エリアの設定
Customizer::big_title(
	$section,
	'related_posts',
	array(
		'label' => __( '関連記事エリアの設定', 'loos' ),
		__( 'loos' ),
	)
);

// 関連記事を表示
Customizer::add(
	$section,
	'show_related_posts',
	array(
		'classname'   => '',
		'label'       => __( '関連記事を表示', 'loos' ),
		__( 'loos' ),
		'type'        => 'checkbox',
	)
);



// 関連記事のレイアウト
Customizer::add(
	$section,
	'related_posts_layout',
	array(
		'classname'   => '',
		'label'       => __( '関連記事のレイアウト', 'loos' ),
		__( 'loos' ),
		'type'        => 'select',
		'choices'     => array(
			'card' => __( 'カード型', 'loos' ),
			__( 'loos' ),
			'list' => __( 'リスト型', 'loos' ),
			__( 'loos' ),
		),
	)
);

// 関連記事の取得方法
Customizer::add(
	$section,
	'post_relation_type',
	array(
		'classname'   => '-radio-button -related-post',
		'label'       => __( '関連記事の取得方法', 'loos' ),
		__( 'loos' ),
		'description' => __( 'どの情報から関連記事を取得するかどうか', 'loos' ),
		__( 'loos' ),
		'type'        => 'radio',
		'choices'     => array(
			'category' => __( 'カテゴリー', 'loos' ),
			__( 'loos' ),
			'tag'      => __( 'タグ', 'loos' ),
			__( 'loos' ),
		),
	)
);


// コメントエリアの設定
Customizer::big_title(
	$section,
	'comment_area',
	array(
		'label' => __( 'コメントエリアの設定', 'loos' ),
	)
);

// コメントエリアを表示
Customizer::add(
	$section,
	'show_comments',
	array(
		'classname'   => '',
		'label'       => __( 'コメントエリアを表示', 'loos' ),
		'type'        => 'checkbox',
	)
);
