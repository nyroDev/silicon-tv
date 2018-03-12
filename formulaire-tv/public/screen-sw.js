var version = '1.0',
    cacheName = 'silicon-cache-'+version;

self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(cacheName)
    );
});

self.addEventListener('activate', function(event) {
    event.waitUntil(Promise.all([
        // Once SW is activated, claim all clients to be sure they are directly handled by SW to avoid page reload
        self.clients.claim(),
        // Remove old caches
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames.filter(function(curCacheName) {
                    return curCacheName.startsWith('silicon-') &&
                         curCacheName != cacheName;
                }).map(function(cacheName) {
                    return caches.delete(cacheName);
                })
            );
        })
    ]));
});

self.addEventListener('fetch', function(event) {

    // Ignore element not request for screen page
    if (!event.request.referrer.indexOf('ecran.siliconcomte.fr/screen') === -1
        && event.request.url.indexOf('ecran.siliconcomte.fr/screen') === -1) {
        return event.respondWith(fetch(event.request);
    }

    event.respondWith(
        caches.match(event.request).then(function(response) {
            if (response) {
                // Found in cache, use it
                return response;
            }

            return fetch(event.request).then(function(response) {
                return caches.open(cacheName).then(function(cache) {
                    // Put it in cache for later usage
                    cache.put(event.request.url, response.clone());
                    return response;
                });
            });
        })
    );
});
