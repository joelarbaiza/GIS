<?php

require_once "Controllers/template.Controller.php";
require_once "Controllers/loginController.php";

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

// Verificar si se ha solicitado cerrar sesión
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $insLogin = new loginController();
    $insLogin->cerrarSesionControlador();
}




$template = new ControllerTemplate;

$template->ControllerTemplate();
