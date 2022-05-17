<p align="center"><a href="https://consiss.com/" target="_blank"><img src="https://carvaz.com/images/CARVAZ.png" width="400"></a></p>


## Pasos de análisis

- Descarga de información del [sitio](https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/CodigoPostal_Exportar.aspx). Se opta por un tipo de archivo txt
- Importación de la información de un archivo TXT se crea un comando de consola para hacer la importación 
desestructurar la información del archivo y después ingresarla a través de un modelo, pudo haber sido directa la importación usando el facade DB con el método insert, pero en esta ocasión 
por fines prácticos se optó por el uso del modelo. (El comando se puede usar de forma externa o dentro del seeder) "php artisan import:zipcodes"
- Creación de RDS en aws
- importación de la información a través del comando descrito anteriormente
- Se crea un test para empezar el deploy de la aplicación. el test se encuentra en la carpeta tests/Feature/ZipCodeTest.php
- Creación de rutas en la api, para fines de este ejercicio es de acceso público. Lo recomendable es establecer un sistema de autenticación basado en tokens.
- Resolución de performance Lo principal es no usar eloquent en lugar es utilizar el facade DB en lugar de eloquent, 
al momento de hacer la búsqueda, en este caso no se implementó un "HTTP Request" para validación antes de llegar al cuerpo del controlador debido a qué esto ocasionaría 
una consulta más, y la intención del ejercicio es que la respuesta sea más rápida.
- Para la transformación de la data se implementó un Resource, que es una capa intermedia entre el controlador y la respuesta al cliente, dando la oportunidad de formatear y/o acomodar la información, 
se implementó de forma parcial la estructura de respuesta con el standard JSON API que indica que la respuesta de un solo elemento debe de estar en el content de respuesta dentro de la propiedad data,
no sé implemento la especificación de meta por falta de información, así como "relations"
- creación de EC2 en aws
- despliegue de aplicación desde EC2 usando este repositorio
- configuración de NGINX para el despliegue de la aplicación
- apuntar un de DNS hacia la ip del EC2

## SETUP

### Clonar repositorio:
- git clone https://github.com/AndresGodinez/reto-backbone.git
### Crear RDS en AWS
[información](https://docs.aws.amazon.com/es_es/AmazonRDS/latest/UserGuide/CHAP_Tutorials.WebServerDB.CreateDBInstance.html)
### Crear EC2 en AWS
[Información](https://aws.amazon.com/es/getting-started/hands-on/deploy-wordpress-with-amazon-rds/3/)
### Setup LARAVEL
+ Ir a la raiz del proyecto:
+ composer install
+ configuration de .env
+ Permisos de escritura en la carpeta storage sudo chmod -R 775 storage && sudo chgrp -R www-data storage
+ Ejecutar las migraciones de la base de datos y seeders: php artisan migrate --seed


## Autores ✒️

* **Andrés Godínez**  - [AndresGodinez](https://github.com/AndresGodinez)



## Licencia 📄

* [MIT License](https://es.wikipedia.org/wiki/Licencia_MIT)
