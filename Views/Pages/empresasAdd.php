<?php

$result = $insEmpresa->listar_giro_de_negocio();

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
                <label class="card-title"><i class="fas fa-building pr-1"></i> Registro de Empresa</label>
            </div>
            <div class="card-body">
                <form method="POST" action="Controllers/empresaController.php">
                    <input type="hidden" name="action" value="add">

                    <div class="form-group">
                        <label for="numero_ruc" class="text-secondary">RUC</label>
                        <input type="text" class="form-control" id="numero_ruc" name="numero_ruc" maxlength="11" placeholder="RUC">
                    </div>

                    <div class="form-group">
                        <label for="nombre_comercial" class="text-secondary">Nombre Comercial</label>
                        <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" placeholder="Nombre Comercial">
                    </div>

                    <div class="form-group">
                        <label for="razon_social" class="text-secondary">Razón Social</label>
                        <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Razón Social">
                    </div>

                    <div class="form-group">
                        <label for="giro_de_negocio" class="text-secondary">Giro de Negocio</label>
                        <select class="form-control" id="giro_de_negocio" name="giro_de_negocio" id="giro_de_negocio">
                            <?php


                            $result = $insEmpresa->listar_giro_de_negocio();
                            foreach ($result as $giro) :

                            ?>
                                <option value="<?php echo htmlspecialchars($giro['id_giro']); ?>"><?php echo htmlspecialchars($giro['nombre_giro']); ?></option>


                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle pr-2"></i>Registrar Empresa</button>
                        <a href="empresas" class="btn btn-danger"><i class="fa fa-times-circle pr-2"></i>Cancelar</a>
                    </div>
                </form>
            </div>
        </div>


    </div>

</body>

</html>