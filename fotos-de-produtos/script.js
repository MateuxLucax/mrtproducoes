var gallery = document.querySelector(".gallery");

document.addEventListener("DOMContentLoaded", function() {
	resetPage();
	displayAlbum();
	snackbar();
});

function CriaRequest() {
	try {
		request = new XMLHttpRequest();
	} catch (IEAtual) {
		try {
			request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (IEAntigo) {
			try {
				request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (falha) {
				request = false;
			}
		}
	}

	if (!request) alert("Seu Navegador não suporta Ajax!");
	else return request;
}

async function displayAlbum() {
	carregando(true);
	var xmlreq = CriaRequest();

	xmlreq.open(
		"GET",
		`./../controllers/album.php?page=${getPage()}&id=${getAlbum()}`,
		true
	);

	xmlreq.onreadystatechange = await function() {
		if (xmlreq.readyState == 4) {
			if (xmlreq.status == 200) {
				var requestResponse = JSON.parse(xmlreq.response);
				if (requestResponse !== "") {
					if (requestResponse.length > 0) {
						hideLoader();
						printAlbum(requestResponse);
						addPage();
						carregando(false);
					} else {
						destroyLoader(true);
					}
				} else {
					hideLoader();
				}
			} else {
				alert("Erro ao carregar as fotos, tente recarregar a página.");
			}
		}
	};
	xmlreq.send(null);
}

window.onscroll = function() {
	if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
		mybutton.style.opacity = "1";
		mybutton.style.visibility = "visible";
		mybutton.style.display = "flex";
	} else {
		mybutton.style.opacity = "0";
		mybutton.style.visibility = "hidden";
		mybutton.style.display = "hidden";
	}

	if (
		(window.innerHeight + Math.ceil(window.pageYOffset) >=
			document.body.offsetHeight &&
			getCarregando() === false) ||
		(window.innerHeight + window.pageYOffset >= document.body.offsetHeight &&
			getCarregando() === false) ||
		(window.innerHeight + window.scrollY >= document.body.scrollHeight - 2 &&
			getCarregando() === false)
	) {
		this.showLoader();
		this.displayAlbum();
	}
};

function hideLoader() {
	if (destroyLoader() === false) {
		var clipsLoaderElement = document.querySelector(".clips__loader");
		clipsLoaderElement.style.display = "none";
	}
}

function showLoader() {
	if (destroyLoader() === false) {
		var clipsLoaderElement = document.querySelector(".clips__loader");
		clipsLoaderElement.style.display = "flex";
	}
}

function destroyLoader(destroy = false) {
	if (destroy === true) {
		document.querySelector(".loader-value").remove();
		document.querySelector(".loader").remove();
		document.querySelector(".clips__loader").remove();
	}

	return destroy;
}

function addPage() {
	pageElement = document.querySelector("#page");
	pageNumber = parseInt(pageElement.value);
	pageNumber++;
	pageElement.value = pageNumber;
}

function resetPage() {
	pageElement = document.querySelector("#page").value = 1;
}

function getPage() {
	pageElement = document.querySelector("#page");
	return parseInt(pageElement.value);
}

function printAlbum(album) {
	album.forEach(foto => {
		let markup = `<img src="${foto.link}" loading="lazy" onclick="toggleFullscreen(this)" alt="Foto ${foto.codigo_foto}">`;
		gallery.insertAdjacentHTML("beforeend", markup);
	});
	album = undefined;
}

function carregando(status) {
	document.querySelector("#loading").value = status;
}

function getCarregando() {
	return document.querySelector("#loading").value === "true";
}

function getAlbum() {
	return parseInt(document.querySelector("#album").value);
}
