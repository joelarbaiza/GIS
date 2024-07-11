<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitiza y valida el ID del cliente
    if (isset($_POST['id_empresa']) && is_numeric($_POST['id_empresa'])) {
        $id = intval($_POST['id_empresa']);

        $datos = $pdo->query("SELECT e.id_empresa , e.numero_ruc , e.nombre_comercial , e.razon_social,e.id_giro ,gn.nombre_giro from empresa e inner join giro_negocio gn on e.id_giro =gn.id_giro where e.id_empresa='$id'");

        $result = $datos->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $numero_ruc = $result['numero_ruc'];
            $nombre_comercial = $result['nombre_comercial'];
            $razon_social = $result['razon_social'];
            $giro_de_negocio = $result['id_giro'];

?>

            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <title>Gestión de Empresas</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            </head>

            <body>
                <div class="container pt-5">
                    <div class="card">
                        <div class="card-header">
                            <label class="card-title"><i class="fas fa-building pr-1"></i> Actualizar Empresa</label>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="Controllers/empresaController.php">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id_empresa" value="<?php echo $id; ?>">

                                <div class="form-group">
                                    <label for="numero_ruc" class="text-secondary">RUC</label>
                                    <input type="text" class="form-control" id="numero_ruc" name="numero_ruc" maxlength="11" placeholder="RUC" value="<?php echo $numero_ruc; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="nombre_comercial" class="text-secondary">Nombre Comercial</label>
                                    <input type="text" class="form-control" name="nombre_comercial" id="nombre_comercial" placeholder="Nombre Comercial" value="<?php echo $nombre_comercial; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="razon_social" class="text-secondary">Razón Social</label>
                                    <input type="text" id="razon_social" class="form-control" name="razon_social" placeholder="Razón Social" value="<?php echo $razon_social; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="giro_de_negocio" class="text-secondary">Giro de Negocio</label>
                                    <select class="form-control" name="giro_de_negocio" id="giro_de_negocio">
                                        <?php


                                        $result = $insEmpresa->listar_giro_de_negocio();
                                        foreach ($result as $giro) :
                                            $selected = ($giro['id_giro'] == $giro_de_negocio) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo htmlspecialchars($giro['id_giro']); ?>" <?php echo $selected; ?>><?php echo htmlspecialchars($giro['nombre_giro']); ?></option>


                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check-circle pr-2"></i>Actualizar Empresa</button>
                                    <a href="empresas" class="btn btn-danger"><i class="fas fa-times-circle pr-2"></i>Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

            </body>

            </html>
<?php

        } else {
            echo "Empresa no encontrada.";
        }
    }
}

?>