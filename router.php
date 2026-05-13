<?php

require_once './app/controllers/partido.controller.php';
require_once './app/controllers/estadio.controller.php';
require_once './app/controllers/user.controller.php';

$partidoController = new PartidoController();
//$estadioController = new EstadioController();
//$userController = new UserController();

session_start();

// base_url para redirecciones y base tag
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

//verificacion de session
function checkSession() {
    if (!isset($_SESSION['usuario'])) {
        header("Location: " . BASE_URL . "usuarios/login");
        die();
    }
}
// accion por defecto si no se envia ninguna
$action = 'partidos';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

// PARTIDOS

if ($params[0] === "partidos") {
    if (!isset($params[1])) {//listado de partidos
        $partidoController->showPartidos();
        exit; //sino seguia ejecutando
    }
    switch ($params[1]) {
        case 'partido':
            if (isset($params[2])) {
                $partidoController->showPartido($params[2]);
            } else {
                echo "ID de partido no especificado.";
            }
        break;
        case 'crear':
            checkSession();
            $partidoController->addPartido();
        break;
        case 'agregar':
            checkSession();
            $partidoController->showAgregarPartido();
        break;
        case 'editar':
            checkSession();
            if (isset($params[2])) {
                $partidoController->showEditarPartido($params[2]);
            } else {
                echo "No se recibió el ID del partido.";
            }
        break;
        case 'actualizar':
            checkSession();
            if (isset($params[2])) {
                $partidoController->editarPartido($params[2]);
            } else if (isset($_POST['id'])) {
                $partidoController->editarPartido($_POST['id']);
            } else {
                echo "No se recibió el ID del partido para actualizar.";
            }
        break;
        case 'eliminar':
            checkSession();
            if (isset($params[2])) {
                $partidoController->eliminarPartido($params[2]);
            } else {
                echo "No se recibió el ID del partido para eliminar.";
            }
        break;
        default:
            echo "404 Page Not Found";
        break;
    }
}

// USUARIOS
if ($params[0] === "usuarios") {
    switch ($params[1]) {
        case 'login':
            $userController->showIniciarSesion();
            break;
        case 'ingresar':
            $userController->iniciarSesion();
            break;
        case 'logout':
            $userController->cerrarSesion();
            break;
        default:
            echo "404 Page Not Found";
            break;
    }
}