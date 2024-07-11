<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['id_usuario']) && is_numeric($_POST['id_usuario'])) {
        $id = intval($_POST['id_usuario']);


        $result = $insPerfil->obtenerUsuarios($id);

        if ($result) {
            $nombre_usuario = $result['nombre_usuario'];
            $pass = $result['password'];
            $nombre = $result['nombre'];
            $apellido = $result['apellido'];
            $telefono = $result['telefono'];
            $correo = $result['correo'];


?>
            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Perfil de Usuario</title>
                <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            </head>

            <body>
                <div class="container">

                    <label class="text-center pt-5 mb-5" style="font-size: 30px;">INFORMACIÓN PERSONAL</label>
                    <form action="Controllers/perfilController.php" method="post">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre" class="text-secondary">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellido" class="text-secondary">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $apellido; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telefono" class="text-secondary">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="9" value="<?php echo $telefono; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="correo" class="text-secondary">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre_usuario" class="text-secondary">Usuario</label>
                                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $nombre_usuario; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password" class="text-secondary">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $pass; ?>" required>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check-circle pr-2"></i>Actualizar</button>
                            <a href="Inicio" class="btn btn-danger"><i class="fas fa-times-circle pr-2"></i>Cancelar</a>
                        </div>
                    </form>
                </div>

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </body>

            </html>


<?php

        }
    }
}
?>