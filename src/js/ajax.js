/* eslint no-alert: 0 */
/* eslint no-console: 0 */

/**
 * ajax処理を実行する関数
 */
const sendCountFetch = async (params, doneFunc, failFunc) => {
	// ajaxUrl を正常に取得できるか
	if (window.arkheAjaxVars === undefined) return;
	const ajaxUrl = window.arkheAjaxVars.ajaxUrl;
	if (ajaxUrl === undefined) return;

	// nonce を正常に取得できるか
	const ajaxNonce = window.arkheAjaxVars.ajaxNonce;
	if (ajaxNonce === undefined) return;

	params.append('nonce', ajaxNonce);

	await fetch(ajaxUrl, {
		method: 'POST',
		cache: 'no-cache',
		body: params,
	})
		.then((response) => {
			if (response.ok) {
				// console.log などで一回 response.json() 確認で使うと、responseJSONでbodyがlockされるので注意
				return response.json();
			}
			throw new TypeError('Failed ajax!');
		})
		.then((json) => {
			doneFunc(json);
		})
		.catch((error) => {
			failFunc(error);
		});
};

// キャッシュクリア処理
const ajaxToClearCache = function (actionName) {
	const params = new URLSearchParams(); // WPのajax通す時は URLSearchParams 使う
	params.append('action', actionName);

	const doneFunc = (response) => {
		alert(response);
		location.reload();
	};
	const failFunc = (err) => {
		console.error(err);
		// location.reload();
	};

	// ajax処理
	sendCountFetch(params, doneFunc, failFunc);
};

/**
 * jQuery非依存処理
 */
document.addEventListener('DOMContentLoaded', function () {
	// キャッシュクリア
	const clearCacheBtn = document.querySelectorAll('.arkhe-btn-clearCache');
	if (0 < clearCacheBtn.length) {
		clearCacheBtn.forEach((btn) => {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				console.log('clearCache click');
				ajaxToClearCache('arkhe_toolkit_clear_cache');
			});
		});
	}
});
