<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li>
            <div class="pull-left">
                <form action="perfil" method="post">
                    <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                    <input type="submit" class="btn btn-info mr-2" value="Perfil">

                </form>
            </div>
        </li>
        <li>
            <div class="pull-rigth">
                <a href="index.php?action=logout" class="btn btn-danger ml-2 mr-2 text-white">Cerrar Sesión</a>
            </div>
        </li>

    </ul>
</nav>