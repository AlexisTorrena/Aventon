# Aventon
proyecto de ingeniería de software 2 UNLP


#Ambiente de desarrollo

Pasos para replicar el ambiente de desarrollo:

1- Instalar XAMMP https://www.apachefriends.org/es/index.html (disponible en windows, max y linux) recordar path de instalacion. 

2 - Inicializar XAMMP control panel como administrador. hacer click en el boton start donde dice mySql para iniciar el servidor de base de datos.

3 - en el path de instalacion de xammp (en mi caso lo instale en el disco D)
D:\xampp\php\ abrir el archivo php.ini, en la linea 891 aprox , borrar el ";" de esta linea ";extension=intl" para habilar la dll.

4- Solo si usas Windows, instalar Cygwin es para emular comandows de linux en windows, muchos ejemplos y cursos son en linux o mac y los comandos son diferentes en windows.
https://cygwin.com/install.html

5- Instalar un editor de texto
Recomiendo Visual Studio Code (https://code.visualstudio.com/) disponible para windows, mac, y linux , es open source, tiene mucho soporte de la comunidad, soporta infinidad de lenguajes y pluguins es muy utilizado.

Pero pueden utilizar el que quieran phpStorm, Sublime, netbeans, notepad++, block de notas, etc.

6 Inicializar XAMMP control panel como administrador. Hacer click en shell (consola), tipear :
mysql -u root -h 127.0.0.1

7 - Crear la base de datos local vacia, asi ya sabemos que nombre utilizar por todos los devs

correr el siguiente script en la enterior consola:

create database aventon;
CREATE USER 'aventon@localhost' IDENTIFIED BY 'aventon';
GRANT ALL ON aventon.* TO 'aventon@localhost';

correr comando "show databases;" para verificar que este en la lista de bases de datos locales.

8 - instalar y configurar composer ya sea para windows o linux.

https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx

despues abrir una nueva ventana de cmd y teclear composer, si reconoce el comando esta bien configurado.

9 - abir cmd , posicionarce en el path donde desea crear el proyecto y ajecutar la siguiente linea: Tarda bastante

composer create-project --prefer-dist laravel/laravel aventon

10 - entrar al directorio aventon , ejecutar en la consola php artisan serve

eso levanta el servidor local en el puerto 8000

entrar a localhost:8000 desde el navegador sin cerrar la consola y listo deberian ver la pagina de laravel.
