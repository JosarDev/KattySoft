# CodeIgniter 4 Framework

## English Version

### What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

### Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

### Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

### Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

### Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> The end of life date for PHP 7.4 was November 28, 2022.
> The end of life date for PHP 8.0 was November 26, 2023.
> If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> The end of life date for PHP 8.1 will be November 25, 2024.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

## Versión en Español

### ¿Qué es CodeIgniter?

CodeIgniter es un framework web PHP de pila completa que es ligero, rápido, flexible y seguro.
Más información se puede encontrar en el [sitio oficial](https://codeigniter.com).

Este repositorio contiene la versión distribuible del framework.
Ha sido construido a partir del
[repositorio de desarrollo](https://github.com/codeigniter4/CodeIgniter4).

Puedes encontrar más información sobre los planes para la versión 4 en [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) en los foros.

Puedes leer la [guía del usuario](https://codeigniter.com/user_guide/) correspondiente a la última versión del framework.

### Cambio Importante con index.php

`index.php` ya no está en la raíz del proyecto. ¡Se ha movido dentro de la carpeta *public*,
para una mejor seguridad y separación de componentes!

Esto significa que deberías configurar tu servidor web para "apuntar" a la carpeta *public* de tu proyecto, y
no a la raíz del proyecto. Una mejor práctica sería configurar un host virtual para que apunte allí. Una mala práctica sería apuntar tu servidor web a la raíz del proyecto y esperar entrar en *public/...*, ya que el resto de tu lógica y el
framework estarían expuestos.

**Por favor** lee la guía del usuario para una mejor explicación de cómo funciona CI4.

### Gestión del Repositorio

Usamos los problemas de GitHub, en nuestro repositorio principal, para rastrear **ERRORES** y para rastrear paquetes de trabajo de **DESARROLLO** aprobados.
Usamos nuestro [foro](http://forum.codeigniter.com) para proporcionar SOPORTE y discutir
SOLICITUDES DE FUNCIONALIDADES.

Este repositorio es uno de "distribución", construido por nuestro script de preparación de lanzamientos.
Los problemas con él pueden plantearse en nuestro foro o como problemas en el repositorio principal.

### Contribuyendo

Damos la bienvenida a las contribuciones de la comunidad.

Por favor, lee la sección [*Contribuir a CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) en el repositorio de desarrollo.

### Requisitos del Servidor

Se requiere la versión de PHP 8.1 o superior, con las siguientes extensiones instaladas:

- [intl](http://php.net/manual/es/intl.requirements.php)
- [mbstring](http://php.net/manual/es/mbstring.installation.php)

> [!ADVERTENCIA]
> La fecha de fin de vida para PHP 7.4 fue el 28 de noviembre de 2022.
> La fecha de fin de vida para PHP 8.0 fue el 26 de noviembre de 2023.
> Si todavía estás utilizando PHP 7.4 o 8.0, deberías actualizar de inmediato.
> La fecha de fin de vida para PHP 8.1 será el 25 de noviembre de 2024.

Además, asegúrate de que las siguientes extensiones estén habilitadas en tu PHP:

- json (habilitada por defecto, no la desactives)
- [mysqlnd](http://php.net/manual/es/mysqlnd.install.php) si planeas usar MySQL
- [libcurl](http://php.net/manual/es/curl.requirements.php) si planeas usar la librería HTTP\CURLRequest
