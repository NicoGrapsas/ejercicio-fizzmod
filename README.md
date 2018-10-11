# ejercicio-fizzmod

## Requisitos:
- PHP >= 7
- Composer (https://getcomposer.org/)

## Instalacion:
`"git clone https://github.com/NicoGrapsas/ejercicio-fizzmod.git" ProjectName`
`"cd ProjectName"`
`"composer install"
##### Configuracion Apache:
 - DocumentRoot debe apuntar a la carpeta public.
 - AllowOverride All

***

# API

- /products/all: Devuelve todos los productos en formato JSON.
- /products/:id: Devuelve el producto con el id provisto en formato JSON.
- /products/:id/enable: Setea status=1
- /products/:id/disable: Seatea status=-1
- /products/seed: Llena la base de datos con el archivo products.json
- /products/truncate: Limpia la base de datos.

***

# Otros recursos:

[Documentacion del framework FlighthPHP](http://flightphp.com/)

