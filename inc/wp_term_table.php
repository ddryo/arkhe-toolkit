<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * 管理画面のターム一覧テーブルの表示をカスタマイズする
 */

add_filter( 'manage_edit-category_columns', 'arkhe_plus_hook__add_term_columns' );
add_filter( 'manage_edit-post_tag_columns', 'arkhe_plus_hook__add_term_columns' );
add_filter( 'manage_category_custom_column', 'arkhe_plus_hook__output_term_columns', 10, 3 );
add_filter( 'manage_post_tag_custom_column', 'arkhe_plus_hook__output_term_columns', 10, 3 );
// add_filter( 'manage_edit-category_sortable_columns', 'arkhe_plus_hook__add_term_sortable' );
// add_filter( 'manage_edit-post_tag_sortable_columns', 'arkhe_plus_hook__add_term_sortable' );


/**
 * カテゴリー・タグ一覧テーブルに IDのカラム 追加
 */
if ( ! function_exists( 'arkhe_plus_hook__add_term_columns' ) ) :
function arkhe_plus_hook__add_term_columns( $columns ) {
	return array_merge(
		array_slice( $columns, 0, 2 ),
		['term_id' => 'ID' ],
		array_slice( $columns, 2 )
	);
}
endif;


/**
 * IDカラムの出力
 */
if ( ! function_exists( 'arkhe_plus_hook__output_term_columns' ) ) :
function arkhe_plus_hook__output_term_columns( $content, $column_name, $term_id ) {
	if ( 'term_id' === $column_name ) {
		$content = $term_id;
	}
	return $content;
}
endif;


/**
 * カテゴリー・タグ一覧：IDでソート可能に
 */
// if ( ! function_exists( 'arkhe_plus_hook__add_term_sortable' ) ) :
// function arkhe_plus_hook__add_term_sortable( $columns ) {
// 	$columns['term_id'] = 'ID';
// 	return $columns;
// }
// endif;
