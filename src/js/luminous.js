import { Luminous, LuminousGallery } from 'luminous-lightbox';

/**
 * 画像パスをセット
 */
const setDataLuminous = (img) => {
	// data-srcがあれば読み取る
	let src = img.getAttribute('data-src');
	if (!src) {
		// data-srcがなければ普通に src を取得
		src = img.getAttribute('src');
	}

	// 画像ソースなければ continue
	if (!src) return false;

	// フルサイズの画像パスを取得 luminousをセットする処理を開始
	const fullSizeSrc = src.replace(/-[0-9]*x[0-9]*\./, '.');

	img.setAttribute('data-luminous', fullSizeSrc);

	return true;
};

/**
 * Luminousをセット
 */
const setLuminous = () => {
	// ギャラリーブロックの画像は先にグループ化して処理
	const galleys = document.querySelectorAll('.c-postContent .wp-block-gallery');
	galleys.forEach((galley) => {
		const galleyImgs = galley.querySelectorAll('img');
		galleyImgs.forEach((img) => {
			if (setDataLuminous(img)) {
				img.classList.add('luminous');
			}
		});
		if (0 < galleyImgs.length) {
			new LuminousGallery(
				galleyImgs,
				{ arrowNavigation: true },
				{ sourceAttribute: 'data-luminous' }
			);
		}
	});

	// 残った普通の画像
	// const contentImgs = document.querySelectorAll('.c-postContent img:not(.u-lb-off)');
	const contentImgs = document.querySelectorAll(
		'.c-postContent .wp-block-image:not(.u-lb-off) img, .c-postContent img.u-lb-on'
	);

	// 画像が一枚もなければreturn
	if (1 > contentImgs.length) {
		return;
	}
	const isGroup = false;
	const imglist = [];

	for (let i = 0; i < contentImgs.length; i++) {
		// 画像データ
		const img = contentImgs[i];
		const imgClassName = img.className;
		const imgParent = img.parentNode;

		// 親がaタグの場合
		if ('A' === imgParent.tagName) {
			continue;
		}

		// 画像に すでに luminous がついていれば continue
		if (-1 !== imgClassName.indexOf('luminous')) {
			continue;
		}

		if (setDataLuminous(img)) {
			img.classList.add('luminous');

			// Luminou発動
			if (!isGroup) {
				new Luminous(img, {
					sourceAttribute: 'data-luminous',
				});
			} else {
				// グループ化がオンの時、リストに保持
				imglist.push(img);
			}
		}
	}

	if (isGroup && 0 < imglist.length) {
		new LuminousGallery(
			imglist,
			{ arrowNavigation: true },
			{ sourceAttribute: 'data-luminous' }
		);
	}
};

window.addEventListener('load', function () {
	setLuminous();
});
