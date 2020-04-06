# Cadastro Simplificado de prestadores para IntranetOne

IOProvider requires IntranetOne

## Conteúdo

- [Instalação](#instalação)
- [Webpack](#webpack)

## Instalação

```sh
composer require dataview/ioprovider
```

Instalar o pacote com php artisan

```sh
php artisan io-provider:install
```

```sh
php artisan config:cache
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
