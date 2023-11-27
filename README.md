# BackendUnikasasLaravel
**Introducción**

Este repositorio contiene el proyecto desarrollado para la empresa Unikasas.
El software está desarrollado en Laravel.

**Integrantes**

Los desarrolladores del proyecto son:
- Maria Juliana Gonzalez Tapias
- Miguel Angel Guevara Rodriguez
- Sebastian Fierro Cubillos
- Angela Johana Ruiz Acosta
- Ivan Edilson Arevalo Rodriguez
- Yeisson Estiven Ortiz Torres

**Entorno para ejecutar la aplicación de manera local:**

Para desarrollar la aplicación hemos dispuesto dos alternativas: XAMPP (Apache y MySQL) o Docker.

La ejecución en Docker se debe realizar desde la rama Docker de este repositorio.
La ejecución en XAMPP se recomienda realizar desde la rama development.

**Requisitos XAMPP:**
- MariaDB ^10.4.22
- PHP ^8.0.2

**Paso a paso para la ejecución XAMPP**
- 1. Ejecutar XAMPP.
- 2. Clonar el repositorio.
- 3. Descargar el archivo .env del siguiente link: https://drive.google.com/file/d/1VKQADISoXneKMYQwK3xLXtA3-VGKfIE9/view?usp=sharing o crear un archivo .env dentro del root del repositorio y copiar el contenido del archivo .env.example en el archivo .env recien creado.
- 4. Descomentar las variables de entorno para XAMPP que se encuentran comentadas.
![image](https://user-images.githubusercontent.com/90289220/173258037-4219a3cd-c444-4342-a6e4-6dc9ef3cdd28.png)

- 5. Crear una base de datos en un servidor local que se encuentre en el puerto 3306. El nombre de la base de datos debe ser: dbunikasas
- 6. En la terminal de comandos, ubicado en la ruta del repositorio, ejecutar el comando: composer install. Para instalar las librerias requeridas para la ejecución del aplicativo.
- 7. Una vez terminada la ejecución del comando anterior ahora se debe ejecutar el comando: php artisan migrate:fresh --seed
- 8. Por ultimo, ejecutar el comando php artisan serve.
- 9. El aplicativo estará disponible dentro del puerto 8000 del localhost.

**Requisitos Docker**
- Docker instalado.

**Paso a paso para la ejecución en Docker:**
- 1. Ejecutar Docker.
- 2. Clonar el repositorio.
- 3. Descargar el archivo .env del siguiente link: https://drive.google.com/file/d/1VKQADISoXneKMYQwK3xLXtA3-VGKfIE9/view?usp=sharing o crear un archivo .env dentro del root del repositorio y copiar el contenido del archivo .env.example en el archivo .env recien creado.
- 4. Descomentar las variables de entorno para DOCKER que se encuentran comentadas.
![image](https://user-images.githubusercontent.com/90289220/173258037-4219a3cd-c444-4342-a6e4-6dc9ef3cdd28.png)

- 5. En la terminal de comandos, ubicado en la ruta del repositorio, ejecutar el comando: composer install. Para instalar las librerias requeridas para la ejecución del aplicativo.
- 6. En la terminal de comando debemos movernos a la carpeta run_project. Para realizar esta acción debemos ejecutar el comando: cd ./run_project 
- 7. Por ultimo, se debe ejecutar el comando: .\start.bat
- 8. El aplicativo estará disponible dentro del puerto 80 del localhost.

**Autenticación**
Para ingresar al sistema se puede realizar mediante los siguientes datos de usuario:

 - Correo electronico: ortizyeison2183@gmail.com
 - Password: 1003614209
 - Correo electronico: miguelguevara1071@gmail.com
 - Password: 1071304206
