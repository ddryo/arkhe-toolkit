<?php
/**
 * 「拡張機能」タブ > 高速化セクション
 */

\Arkhe_Toolkit::output_checkbox([
	'db'    => $cb_args['db'],
	'key'   => 'use_prefetch',
	'label' => __( 'Enable the Prefetch function', 'arkhe-toolkit' ),
]);

\Arkhe_Toolkit::output_textarea([
	'db'    => $cb_args['db'],
	'key'   => 'prefetch_prevent_keys',
	'label' => __( 'Keywords for pages not to be prefetched', 'arkhe-toolkit' ),
	'desc'  => __( 'If there are multiple, separate them with ",".', 'arkhe-toolkit' ) .
		__( 'All pages containing the specified character string will not be subject to Prefetch.', 'arkhe-toolkit' ),
]);
