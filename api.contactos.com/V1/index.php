<?php

require 'data/models/usuarios.php';
//require 'data/contactos.php';
require 'view/VistaXML.php';
require 'view/VistaJson.php';
require 'utility/ExcepcionApi.php';




$vista = new VistaJson();

//manejador de exepciones
set_exception_handler(function ($exception) use ($vista) {
    $cuerpo = array(
        "estado" => $exception->estado,
        "mensaje" => $exception->getMessage()
    );
    if ($exception->getCode()) {
        $vista->estado = $exception->getCode();
    } else {
        $vista->estado = 500;
    }

    $vista->imprimir($cuerpo);
}
);

// Extraer segmento de la url
if (isset($_GET['PATH_INFO']))
    $peticion = explode('/', $_GET['PATH_INFO']);
else
    throw new ExcepcionApi(ESTADO_URL_INCORRECTA, utf8_encode("No se reconoce la petición"));

// Obtener recurso
$recurso = array_shift($peticion);
$recursos_existentes = array('contactos', 'usuarios');

// Comprobar si existe el recurso
if (!in_array($recurso, $recursos_existentes)) {
 // Respuesta error
}

$metodo = strtolower($_SERVER['REQUEST_METHOD']);

switch ($metodo) {
    case 'get':
        // Procesar método get
        break;

    case 'post':
        // Procesar método post
		$vista->imprimir(usuarios::post($peticion));
        break;
    case 'put':
        // Procesar método put
        break;

    case 'delete':
        // Procesar método delete
        break;
    default:
        // Método no aceptado
}





?>