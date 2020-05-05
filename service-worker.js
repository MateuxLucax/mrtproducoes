const staticCacheName = "mrt-pwa-v3";
const filesToCache = [
	// Pages
	"offline.html",

	// Manifesto
	"manifest.json",

	// Ícones
	"assets/img/icons/icon-72x72.png",
	"assets/img/icons/icon-96x96.png",
	"assets/img/icons/icon-128x128.png",
	"assets/img/icons/icon-144x144.png",
	"assets/img/icons/icon-152x152.png",
	"assets/img/icons/icon-192x192.png",
	"assets/img/icons/icon-384x384.png",
	"assets/img/icons/icon-512x512.png",
	"assets/img/icons/logo.png",
	"assets/img/icons/favicon.png",

	// Estilo
	"assets/css/style.css",

	// Imagens
	"assets/img/albuns/fundo.jpg",
	"assets/img/albuns/fundo-mobile.jpg",
	"assets/img/clipes/fundo.jpg",
	"assets/img/clipes/fundo-mobile.jpg",
	"assets/img/fotos-de-produtos/fundo.jpg",
	"assets/img/fotos-de-produtos/fundo-mobile.jpg",
	"assets/img/pagina-inicial/fundo.jpg",
	"assets/img/pagina-inicial/fundo-mobile.jpg",
	"assets/img/sobre/fundo.jpg",
	"assets/img/sobre/fundo-mobile.jpg",
	"assets/img/parceiros/fundo.jpg",
	"assets/img/parceiros/fundo-mobile.jpg",
];

// Clear cache on activate
this.addEventListener("activate", function (event) {
	var cachesToKeep = [staticCacheName];

	event.waitUntil(
		caches.keys().then(function (keyList) {
			return Promise.all(
				keyList.map(function (key) {
					if (cachesToKeep.indexOf(key) === -1) {
						return caches.delete(key);
					}
				})
			);
		})
	);
});

// Cache on install
this.addEventListener("install", (event) => {
	this.skipWaiting();
	event.waitUntil(
		caches.open(staticCacheName).then((cache) => {
			return cache.addAll(filesToCache);
		})
	);
});

// Serve from Cache
this.addEventListener("fetch", (event) => {
	event.respondWith(
		caches
			.match(event.request)
			.then((response) => {
				return response || fetch(event.request);
			})
			.catch(() => {
				return caches.match("offline.html");
			})
	);
});
