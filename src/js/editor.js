(function ($) {
	// 文字数カウント
	function countTitle(titleSelector, titleArea) {
		const ttlVal = titleArea.val();
		titleSelector.attr('data-txtct', ttlVal.length);
	}

	window.addEventListener('load', function () {
		// タイトルカウント
		(function () {
			// const isBlock = true;
			const titleSelector = $('.editor-post-title__block');
			let titleArea;
			if (0 < titleSelector.length) {
				titleArea = titleSelector.find('textarea');
			} else {
				return; // titleなかった場合
			}

			//ページ表示時に数える
			countTitle(titleSelector, titleArea);

			//入力フォーム変更時に数える
			titleArea.bind('keydown keyup keypress change', function () {
				countTitle(titleSelector, titleArea);
			});

			//フォーカスクラスの付け外し
			titleArea
				.focusin(function () {
					titleSelector.attr('data-focus', 'on');
				})
				.focusout(function () {
					titleSelector.attr('data-focus', 'off');
				});
		})();
	});
})(window.jQuery);
