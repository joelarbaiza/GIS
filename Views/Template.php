<?php
require_once __DIR__ . '/../Conexion/conexionBD.php';
$pdo = obtenerConexion();

require_once 'Controllers/empresaController.php';
require_once 'Controllers/poligonoController.php';
require_once 'Controllers/perfilController.php';
require_once 'Controllers/inicioController.php';

$insEmpresa = new empresaController;
$insPoligono = new poligonoController;
$insPerfil = new perfilController;
$insInicio = new inicioController;


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GIS CIX</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="Views/Resources/dist/img/logo.png" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="Views/Resources/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="Views/Resources/dist/css/adminlte.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="Views/Resources/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="Views/Resources/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="Views/Resources/plugins/datatables-select/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="Views/Resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <!--HEADER-->
        <?php include "Modules/Header.php"; ?>

        <!-- Main Sidebar Container -->
        <!--MENU-->
        <?php include "Modules/Menu.php"; ?>

        <div class="content-wrapper">
            <?php
            if (isset($_GET["Pages"])) {
                $page = $_GET["Pages"];
                if (in_array($page, ["Inicio", "empresas", "gironegocio", "poligonos", "crud_giro", "empresasUpdate", "empresasAdd", "poligonosUpdate", "poligonosAdd", "perfil"])) {
                    include "Pages/" . $page . ".php";
                }
            } else {
                include "Views\Pages\Inicio.php";
            }
            ?>

        </div>
        <!--FOOTER-->
        <?php include "Modules/Footer.php"; ?>

        <!-- jQuery -->
        <script src="Views/Resources/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="Views/Resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>




        <!-- DataTables  & Plugins -->
        <script src="Views/Resources/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="Views/Resources/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="Views/Resources/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="Views/Resources/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="Views/Resources/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="Views/Resources/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="Views/Resources/plugins/jszip/jszip.min.js"></script>
        <script src="Views/Resources/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="Views/Resources/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="Views/Resources/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="Views/Resources/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="Views/Resources/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="Views/Resources/plugins/datatables-select/js/dataTables.select.min.js"></script>

        <!-- AdminLTE App -->
        <script src="Views/Resources/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="Views/Resources/dist/js/demo.js"></script>
        <script src="Views/Resources/dist/js/jspoligono.js"></script>
        <script src="Views/js/ajax.js"></script>


        <script src="Resources/plugins/sweetalert2/sweetalert2.all.min.js"></script>


</body>

</html>