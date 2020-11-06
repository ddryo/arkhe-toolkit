document.addEventListener('DOMContentLoaded', function () {
	const ClipboardJS = window.ClipboardJS;
	if (!ClipboardJS) return;
	const clipboard = new ClipboardJS('.c-urlcopy');
	clipboard.on('success', function (e) {
		const btn = e.trigger;
		btn.classList.add('-done');
		setTimeout(() => {
			btn.classList.remove('-done');
		}, 3000);
	});
});
