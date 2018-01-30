# silicon-tv

### Configuration webpack 
```js
// webpack.config.js
Encore
// ...
.setPublicPath('/build') // Changer en fonction de la racine du serveur 
```

Build webpack pour le dev
```sh
yarn
./node_modules/.bin/encore dev
```

Ou en production
```sh
yarn
./node_modules/.bin/encore production
```