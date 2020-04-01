var albunsContainer = document.querySelector(".albuns__container");

document.addEventListener("DOMContentLoaded", function() {
	resetPage();
	displayAlbums();
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

async function displayAlbums() {
	carregando(true);
	var xmlreq = CriaRequest();

	xmlreq.open("GET", `./../controllers/albuns.php?page=${getPage()}`, true);

	xmlreq.onreadystatechange = await function() {
		if (xmlreq.readyState == 4) {
			if (xmlreq.status == 200) {
				var requestResponse = JSON.parse(xmlreq.response);
				if (requestResponse !== "") {
					if (requestResponse.length > 0) {
						hideLoader();
						printAlbums(requestResponse);
						addPage();
						carregando(false);
					} else {
						destroyLoader(true);
					}
				} else {
					hideLoader();
				}
			} else {
				alert("Erro ao carregar os álbuns, tente recarregar a página.");
			}
		}
	};
	xmlreq.send(null);
}

window.onscroll = function() {
	if (
		window.innerHeight + window.pageYOffset >= document.body.offsetHeight &&
		getCarregando() === false
	) {
		this.showLoader();
		this.displayAlbums();
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

function printAlbums(albums) {
	albums.forEach(album => {
		let markup = `<a href="album/?id=${album.codigo}"  class="album-link__cta">
                            <div class="album-link__container">
                                <img src="${album.capa}" alt="Capa ${album.codigo}" loading="lazy" class="album-link__img">
                                <span class="album-link__title">
                                    <span class="album-link__title--span">
                                        ${album.titulo}
                                    </span>
                                </span>
                            </div>
						</a>`;
		albunsContainer.insertAdjacentHTML("beforeend", markup);
	});
	albums = undefined;
}

function carregando(status) {
	document.querySelector("#loading").value = status;
}

function getCarregando() {
	return document.querySelector("#loading").value === "true";
}
