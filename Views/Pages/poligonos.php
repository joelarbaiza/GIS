<?php



// Obtener todos los polígonos para mostrar
$poligonos = $insPoligono->obtenerPoligonos();



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
            <label class="card-title pt-2">Módulo Polígono</ñ>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="text-center mb-3">

                            <div class="input-group">

                                <div class="input-group-append">

                                    <a href="poligonosAdd" class="btn btn-outline-info">
                                        <i class="fas fa-draw-polygon"></i> Registrar Polígono
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive ">

                            <table class="table table-bordered table-striped" id="tb_poligono">

                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Empresa</th>
                                        <th>P1</th>
                                        <th>P2</th>
                                        <th>P3</th>
                                        <th>P4</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($poligonos as $poligono) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($poligono['id_poligono']) ?></td>
                                            <td><?= htmlspecialchars($poligono['nombre_comercial']) ?></td>
                                            <td><?= htmlspecialchars($poligono['p1']) ?></td>
                                            <td><?= htmlspecialchars($poligono['p2']) ?></td>
                                            <td><?= htmlspecialchars($poligono['p3']) ?></td>
                                            <td><?= htmlspecialchars($poligono['p4']) ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <form method="POST" action="poligonosUpdate" class="form-inline">

                                                        <input type="hidden" name="id_poligono" value="<?= htmlspecialchars($poligono['id_poligono']) ?>">

                                                        <button type="submit" class="btn btn-outline-success ml-1">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="Controllers/poligonoController.php" class="form-inline">
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id_poligono" value="<?= htmlspecialchars($poligono['id_poligono']) ?>">

                                                        <button type="submit" class="btn btn-outline-danger btn-delete ml-1" id="btnEliminarProDetalle">
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
        <!-- /.card-body -->
    </div>

</div>

</html>