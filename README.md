# gestorDeTareas-app - Aplicación web para gestionar tareas

* [2025]

## Descripción


## Características Principales



## Requisitos del Sistema

-   Framework principal: Laravel 11
-   PHP >= 8.2.12
-   Mysql 8.3

## Instalación

1. Clonar el repositorio:

    ```
    git clone https://github.com/lucianoAguilarWD/contacts-app.git
    ```

### Dentro de la carpeta del proyecto abrir terminal y ejecutar los siguientes comandos

2. Instalar dependencias:
    
    ```
    npm install
    ```
    
    ```
    composer install
    ```
    

4. configuración:

    ```
    cp .env.example .env
    ```
    
    ```
    php artisan key:generate
    ```
    
    ```
    php artisan storage:link
    ```
5. Ejecutar las migraciones:

    ```
    php artisan migrate --force
    ```
 

## Uso

Después de la instalación, puedes acceder al sistema a través del link que da artisan serve.

  * Puede probar los distintos roles usando las siguientes cuentas:
  
    -   usuario@usuario.com || pw: usuario123 || rol: usuario

## Licencia

Este proyecto está licenciado bajo la Licencia MIT - ver el archivo [LICENSE.md](LICENSE.md) para más detalles.
