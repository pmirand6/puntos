## Sistema de Puntos (Marcadores)

Sistema realizado para La Nacion. Esta aplicación resuelve los siguientes puntos del Test Enviado

#### Puntos de Evaluación

> Implementar en PHP, en lo posible utilizar Laravel (puede ser otro framework) los endpoints necesarios para

>- Agregar un nuevo punto 
>- Eliminar un punto
>- Actualizar la ubicación 
>- Obtener la ubicación
>- Obtener los puntos más cercanos de x punto
>- Definir un limite de puntos de cercania


Se introduce para resolver estos puntos el concepto de marcadores, acoplandose al paradigma de la aplicacion Google Maps
#### Instalación

1 Clonar el proyecto

`git clone https://github.com/pmirand6/puntos.git`

2 Crear Base de Datos en MySql

`CREATE DATABASE puntos
 CHARACTER SET latin1
 COLLATE latin1_swedish_ci;`
 
3 Ejecutar composer install
 
`composer install`

4 Verificar el archivo .env para la correcta conexión con la base de datos
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=puntos
DB_USERNAME=root
DB_PASSWORD=
```
5 Ejecutar las migraciones

`php artisan migrate`

6 Ejecutar los seeders

`php artisan db:seed --class=MarcadorSeeder`

7 Crear Stored Procedure y Funcion para obtener la ubicación de los puntos cercanos

- Se deben correr los archivos sql que se encuentran en la carpeta BD del proyecto
 
 **Debe recordar que debe definir el `definer` en los archivos SQL antes de su implementación**
 Los scripts vienen definidos con el definidor `CREATE DEFINER = 'root'@'localhost'`
 
8 (Opcional) Ejecutar las pruebas unitarias con `phpunit`

9 Ejecute el servidor

`php artisan serve`

#### Librerias Implementadas


Para esta aplicación se utilizaron las librerias

- [Google Maps API](https://developers.google.com/maps/documentation/javascript/tutorial?hl=es)
- [Jquery](https://jquery.com/)
- [SweetAlert2](https://sweetalert2.github.io/)
- [BulmaCss](https://bulma.io/documentation/)

### Resolución de puntos distantes
>- Obtener los puntos más cercanos de x punto
>- Definir un limite de puntos de cercania

Con el objetivo de resolver estos dos puntos de la evaluación se utiliza la [Fórmula del Semiverseno](https://es.wikipedia.org/wiki/F%C3%B3rmula_del_semiverseno)

La implementación de dicha formula en Mysql es decripta [aquí](https://developers.google.com/maps/solutions/store-locator/clothing-store-locator)

Se aplica dicha lógica en la función de MySql *FU_CALCULAR_DISTANCIA* ajustando para la devolución en Kilometros y la cantidad de resultados a mostrar

### Documentación del Proyecto
En la carpeta del proyecto *Documentacion* se ecuentran los diagramas del analisís funcional realizados para el Test.



## Author
- **Pablo Miranda**

