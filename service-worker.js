var hoje = new Date();
const staticCacheName = "mrt-producoes-1.0-" + hoje.getTime();
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
	"assets/img/sobre/fundo-mobile.jpg"
];

// Cache on install
this.addEventListener("install", event => {
	this.skipWaiting();
	event.waitUntil(
		caches.open(staticCacheName).then(cache => {
			return cache.addAll(filesToCache);
		})
	);
});

// Clear cache on activate
this.addEventListener("activate", event => {
	event.waitUntil(
		caches.keys().then(cacheNames => {
			return Promise.all(
				cacheNames
					.filter(cacheName => cacheName.startsWith("mrt-producoes-"))
					.filter(cacheName => cacheName !== staticCacheName)
					.map(cacheName => caches.delete(cacheName))
			);
		})
	);
});

// Serve from Cache
this.addEventListener("fetch", event => {
	event.respondWith(
		caches
			.match(event.request)
			.then(response => {
				return response || fetch(event.request);
			})
			.catch(() => {
				return caches.match("offline.html");
			})
	);
});
