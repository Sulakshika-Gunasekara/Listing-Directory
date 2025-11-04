// frontend/js/service-worker.js

const CACHE_NAME = "kiptra-sri-lanka-v1";
const urlsToCache = [
  "/",
  "/frontend/index.html",
  "/frontend/css/style.css",
  "/frontend/js/app.js",
];

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      if (response) {
        return response;
      }
      return fetch(event.request);
    })
  );
});
