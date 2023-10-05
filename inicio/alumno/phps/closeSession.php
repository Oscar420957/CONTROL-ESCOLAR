<?php
// Archivo PHP donde se realiza el Log Out y cierra sesiones activas.

session_start(); // Se utiliza porque en la variable superglobal hay datos almacenados de la sesión.
		 // OJO: No se inicia una sesión.
 
session_unset(); // Se utiliza para limpiar todos los datos de la sesión.
		 // OJO: La sesión aún existe y se puede seguir utilizando pero ya no hay datos asociados.

session_destroy(); // Destruye en su totalidad una sesión activa. Una vez hecho esto, ya no se puede seguir utilizando la sesión.

// Finalmente, regresamos a la página del LogIn.
header ('Location: ../../');
?>