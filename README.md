# Aventon
proyecto de ingeniería de software 2 UNLP


#Ambiente de desarrollo

Pasos para replicar el ambiente de desarrollo:
1- Instalar XAMMP https://www.apachefriends.org/es/index.html (disponible en windows, max y linux) recordar path de instalacion. 

2 - Inicializar XAMMP control panel como administrador. hacer click en el boton start donde dice mySql para iniciar el servidor de base de datos.

3 - en el path de instalacion de xammp (en mi caso lo instale en el disco D)
D:\xampp\php\ abrir el archivo php.ini, en la linea 891 aprox , borrar el ";" de esta linea ";extension=intl"
