<?php

$empresas = $insEmpresa->obtenerEmpresas();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Empresas en Mapa</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuZ0DRq6YxRN1Qrcir3dbyv3o8bhES0oc"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>


<div class="container-fluid">
    <br>
    <?php

    if (isset($_SESSION['message'])) {
        echo "<script>
    Swal.fire({
        title: 'Mensaje',
        text: '{$_SESSION['message']}',
        icon: '{$_SESSION['message_type']}'
    });
</script>";
        // Borrar el mensaje después de mostrarlo
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }


    ?>


    <div class="card">
        <div class="card-header">
            <label class="card-title pt-2">Módulo Empresa</label>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">



                    <div class="card-body">
                        <div class="text-center mb-3">

                            <div class="input-group">

                                <div class="input-group-append">
                                    <a href="empresasAdd" class="btn btn-outline-info">
                                        <i class="fas fa-building"></i> Registrar Empresa
                                    </a>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="tb_poligono">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>RUC</th>
                                        <th>Nombre Comercial</th>
                                        <th>Razón Social</th>
                                        <th>Giro de Negocio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($empresas as $empresa) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($empresa['id_empresa']) ?></td>
                                            <td><?= htmlspecialchars($empresa['numero_ruc']) ?></td>
                                            <td><?= htmlspecialchars($empresa['nombre_comercial']) ?></td>
                                            <td><?= htmlspecialchars($empresa['razon_social']) ?></td>
                                            <td><?= htmlspecialchars($empresa['nombre_giro']) ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <form method="POST" action="empresasUpdate" class="form-inline">
                                                        <input type="hidden" name="id_empresa" value="<?= htmlspecialchars($empresa['id_empresa']) ?>">
                                                        <button type="submit" class="btn btn-outline-success ml-1"><i class="fas fa-edit"></i></button>
                                                    </form>
                                                    <form method="POST" action="Controllers/empresaController.php" class="form-inline">
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id_empresa" value="<?= htmlspecialchars($empresa['id_empresa']) ?>">
                                                        <input type="hidden" name="numero_ruc" value="<?= htmlspecialchars($empresa['numero_ruc']) ?>">
                                                        <button type="submit" class="btn btn-outline-danger btn-delete ml-1">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</html>