<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/GIS" class="brand-link">
        <img src="Views/Resources/dist/img/menu.png" class="brand-image img-circle elevation-5" alt="AdminLTE Logo">
        <span class="ml-2 brand-text font-weight-light">GIS CIX</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="Views/Resources/dist/img/admin.png" class="img-circle elevation-4" alt="User Image">
            </div>
            <div class="info">
                <form action="perfil" method="post">
                    <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                    <button style="background-color: transparent; border:none; color: #C3C6C9; outline: none;"> <?php echo $_SESSION['nombre'] . ' ' .  $_SESSION['apellido']; ?></button>
                </form>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->

                <li class="nav-header">Menú de Navegación</li>
                <li class="nav-item">
                    <a href="/GIS" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p class="text">Inicio</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="empresas" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p class="text">Empresa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="gironegocio" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Giro de Negocio</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="poligonos" class="nav-link">
                        <i class="nav-icon fas fa-draw-polygon"></i>
                        <p>Polígono</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>