console.log('admin.js');

(function ($) {
	// ajax用の関数
	const doAjax = (ajaxData, doneFunc, failFunc) => {
		// ajaxUrl を正常に取得できるか
		if (window.arkheToolkitVars === undefined) return;
		const ajaxUrl = window.arkheToolkitVars.ajaxUrl;
		if (ajaxUrl === undefined) return;

		// nonce を正常に取得できるか
		const ajaxNonce = window.arkheToolkitVars.ajaxNonce;
		if (ajaxNonce === undefined) return;

		ajaxData.nonce = ajaxNonce;

		$.ajax({
			type: 'POST',
			url: ajaxUrl,
			data: ajaxData,
		})
			.done(function (returnData) {
				doneFunc(returnData);
			})
			.fail(function () {
				failFunc();
			});
	};

	// テンプレートのリセット
	$(function () {
		const $resetBtns = $('.arkhe-toolkit-reset-btn');

		$resetBtns.each(function () {
			const $resetBtn = $(this);
			$resetBtn.click(function (e) {
				const doneFunc = (returnData) => {
					alert(returnData);
					location.reload();
				};
				const failFunc = () => {
					alert('通信に失敗しました。');
				};

				const ajaxData = {
					action: 'arkhe_toolkit_reset_data',
				};

				if (!window.confirm('本当にリセットしてもいいですか？')) return;

				doAjax(ajaxData, doneFunc, failFunc);
			});
		});
	});
})(window.jQuery);
