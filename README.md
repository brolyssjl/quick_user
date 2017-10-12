# Quick User

Aplicación web básica para la gestión de usuarios:

1. Listar usuarios
2. Crear usuarios
3. Editar Usuarios
4. Borrar usuarios

La aplicación está desarrollada en Laravel 5.5, para la base de datos usa MYSQL, y para la parte del Frontend Materialize css para facilitar la maquetación y evitarnos escribir desde cero nuestro css; además Vuejs que es el framework por defecto que nos provee laravel y nos facilita mucho nuestro código JavaScript gracias a que está orientado a componentes. 

La aplicación también cuenta con registro de usuarios mediante formulario de registro o si bien lo requieren pueden en este caso autenticarse mediante Facebook. Para la autenticación con redes sociales usé el paquete oficial de Laravel denominado Socialite que nos facilita la autenticación mediante OAuth, y soporta la gran mayoría de redes sociales; para más información pueden visitar el repositorio oficial de [Socialite](https://github.com/laravel/socialite). 

Cuando se registran usuarios la aplicación permite notificaciones por email para verificar la cuenta del usuario antes de poder iniciar sesión en el sistema (para efectos de pruebas usé Mailtrap para poder realizar el envío de notificaciones por email. Mailtrap nos provee de una capa gratuita que nos puede ser de gran utilidad, pueden ir a [https://mailtrap.io/](https://mailtrap.io/)).

Si vas a correr la aplicación en tu computadora local te recomiendo que uses Homestead ya que te provee de un ambiente virtual ya configurado para Laravel por lo que evitas tener que configurar tu sistema operativo. Para empezar si no tienes instalado ni configurado Homestead y no lo vas a usar, debes tener instalado PHP y composer ya que es nuestro manejador de dependencias en PHP. Puedes ver la documentación de Laravel si tienes dudas en lo que necesitas [Laravel](https://laravel.com/docs/5.5).

Suponiendo que tienes todo lo necesario en tu computadora local:

1. Descarga el repositorio
2. Genera el archivo que contiene las variables de entorno donde vas a configurar: El acceso a la base de datos en MYSQL, tus credenciales de acceso para las notificaciones para Mailtrap, y también las credenciales de acceso a tu aplicación en Facebook.(Puedes usar de base el archivo .env.example para generar tu archivo .env que usa Laravel)
3. Instala las dependencias con composer: ``` composer install ```
4. Para el Frontend usamos también un gestor de paquetes que en este caso es [yarn](https://yarnpkg.com/en/) (recuerda que debes tener instalado nodejs). Instalas las dependencias con el comando ``` yarn ```
5. Compila los assets ejecutando los comandos que están disponibles en el archivo package.json, puedes usar:
``` yarn run dev ```
6. Ya con esto puedes correr la aplicación en el servidor de tu preferencia: nginx, apache, xampp, lampp, etc.
7. No olvides ejecutar las migraciones con ``` php artisan migrate ```
8. También hay datos semillas si necesitas poblar la base de datos, por lo que el comando: ``` php artisan db:seed ``` te ayudará.
