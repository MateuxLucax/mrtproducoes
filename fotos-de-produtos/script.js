window.setTimeout(() => {
	(document.querySelector("#navigation").style.visibility = "visible"),
		snackbar();
}, 400);

function toggleFullscreen(elem) {
	elem = elem || document.documentElement;
	if (
		!document.fullscreenElement &&
		!document.mozFullScreenElement &&
		!document.webkitFullscreenElement &&
		!document.msFullscreenElement
	) {
		if (elem.requestFullscreen) {
			elem.requestFullscreen();
		} else if (elem.msRequestFullscreen) {
			elem.msRequestFullscreen();
		} else if (elem.mozRequestFullScreen) {
			elem.mozRequestFullScreen();
		} else if (elem.webkitRequestFullscreen) {
			elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
		}
	} else {
		if (document.exitFullscreen) {
			document.exitFullscreen();
		} else if (document.msExitFullscreen) {
			document.msExitFullscreen();
		} else if (document.mozCancelFullScreen) {
			document.mozCancelFullScreen();
		} else if (document.webkitExitFullscreen) {
			document.webkitExitFullscreen();
		}
	}
}

function isTouchDevice() {
	try {
		document.createEvent("TouchEvent");
		return true;
	} catch (e) {
		return false;
	}
}

snackbarElement = document.querySelector(".snackbar");
snackbarElement = isTouchDevice()
	? (snackbarElement.innerHTML =
			"Toque em uma imagem para ampliá-la. <br/> Para voltar a navegação toque nela novamente.")
	: (snackbarElement.innerHTML =
			"Clique em uma imagem para ampliá-la. <br/> Para voltar a navegação clique nela novamente.");

function snackbar() {
	snackbarElement = document.querySelector(".snackbar");
	snackbarElement.className = "snackbar show";
	setTimeout(function() {
		snackbarElement.className = snackbarElement.className.replace("show", "");
	}, 8000);
}