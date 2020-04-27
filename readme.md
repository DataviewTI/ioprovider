# Cadastro Simplificado de prestadores para IntranetOne

## Instalação

#### Composer installation

Laravel 7 or above, PHP >= 7.2.5

```sh
composer require dataview/ioprovider dev-master
```

laravel 5.6 or below, PHP >= 7 and < 7.2.5

```sh
composer require dataview/ioprovider 1.0.0
```

#### Laravel artisan installation

```sh
php artisan io-provider:install
```

## Webpack

```sh
let io = require('intranetone');
...
let user = require('intranetone-provider');
io.compile({
  services:[
    ...
    new provider(),
  ]
});
```
