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
