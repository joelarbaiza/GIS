<?php

// Obtener todas las empresas para el selector de giros de negocio
function obtenerGiros($pdo)
{
    $stmt = $pdo->query('SELECT *  FROM giro_negocio');
    return $stmt->fetchAll();
}
$giros = obtenerGiros($pdo);



// Recoger las selecciones del formulario
$idGiro1 = isset($_POST['giro1']) ? $_POST['giro1'] : null;
$idGiro2 = isset($_POST['giro2']) ? $_POST['giro2'] : null;
$idGiro3 = isset($_POST['giro3']) ? $_POST['giro3'] : null;
$idGiro4 = isset($_POST['giro4']) ? $_POST['giro4'] : null;

$idGiro2 = intval($idGiro2);
$idGiro3 = intval($idGiro3);
$idGiro4 = intval($idGiro4);




if ((!empty($idGiro2) || !empty($idGiro3) || !empty($idGiro4)) && $idGiro1 != 'All') {
    $sql1 = "SELECT e.numero_ruc as ruc, e.nombre_comercial as nombre, gn.nombre_giro as negocio, gn.color as color, p1, p2,p3,p4,ubicacion_1,ubicacion_3 
    FROM Poligono p INNER JOIN Empresa e on p.id_empresa=e.id_empresa inner join giro_negocio gn on e.id_giro = gn.id_giro WHERE gn.id_giro IN ($idGiro2,$idGiro3,$idGiro4)";
} elseif ((!empty($idGiro2) || !empty($idGiro3) || !empty($idGiro4)) && $idGiro1 == 'All') {
    echo "<script>
    Swal.fire({
    title: 'Acción incorreta',
    text: 'Puedes filtrar por tres criterios, pero no puedes filtrar y mostrar todos al mismo tiempo.',
    icon: 'warning'
    });
    </script>";

    $sql1 = 'SELECT e.numero_ruc as ruc, e.nombre_comercial as nombre, gn.nombre_giro as negocio, gn.color as color, p1, p2,p3,p4,ubicacion_1,ubicacion_3 
    FROM Poligono p INNER JOIN Empresa e on p.id_empresa=e.id_empresa inner join giro_negocio gn on e.id_giro = gn.id_giro';
} else {
    $sql1 = 'SELECT e.numero_ruc as ruc, e.nombre_comercial as nombre, gn.nombre_giro as negocio, gn.color as color, p1, p2,p3,p4,ubicacion_1,ubicacion_3 
    FROM Poligono p INNER JOIN Empresa e on p.id_empresa=e.id_empresa inner join giro_negocio gn on e.id_giro = gn.id_giro';
}





$stmt = $pdo->prepare($sql1);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


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

<body>
    <div class="container pt-4">
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
        <h1 class="text-center text-dark mb-4">FILTRAR EMPRESAS POR EL GIRO DE NEGOCIO</h1>
        <form method="POST" action="index.php" class="d-flex justify-content-center mb-4">
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="giro1" class="text-secondary">General</label>
                    <select class="form-control" id="giro1" name="giro1">
                        <option value="">Seleccionar</option>
                        <option value="All">Mostrar Todo</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="giro2" class="text-secondary">Giro 1</label>
                    <select class="form-control" id="giro2" name="giro2">
                        <option value="">Seleccionar</option>
                        <?php foreach ($giros as $g) : ?>
                            <option value="<?= htmlspecialchars($g['id_giro']) ?>"><?= htmlspecialchars($g['nombre_giro']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="giro3" class="text-secondary">Giro 2</label>
                    <select class="form-control" id="giro3" name="giro3">
                        <option value="">Seleccionar</option>
                        <?php foreach ($giros as $g) : ?>
                            <option value="<?= htmlspecialchars($g['id_giro']) ?>"><?= htmlspecialchars($g['nombre_giro']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="giro4" class="text-secondary">Giro 3</label>
                    <select class="form-control" id="giro4" name="giro4">
                        <option value="">Seleccionar</option>
                        <?php foreach ($giros as $g) : ?>
                            <option value="<?= htmlspecialchars($g['id_giro']) ?>"><?= htmlspecialchars($g['nombre_giro']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-auto" style="margin-top: 32px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </div>

        </form>

        <div id="map" class="rounded shadow-sm" style="height: 500px;"></div>
    </div>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: {
                    lat: -6.771122076830835,
                    lng: -79.84258889028789
                },
            });

            var infowindows = []; // Para almacenar todos los infowindows

            <?php foreach ($result as $row) { ?>
                var p1 = <?php echo json_encode(explode(',', $row['p1'])); ?>;
                var p2 = <?php echo json_encode(explode(',', $row['p2'])); ?>;
                var p3 = <?php echo json_encode(explode(',', $row['p3'])); ?>;
                var p4 = <?php echo json_encode(explode(',', $row['p4'])); ?>;

                var coords = [{
                        lat: parseFloat(p1[0]),
                        lng: parseFloat(p1[1])
                    },
                    {
                        lat: parseFloat(p2[0]),
                        lng: parseFloat(p2[1])
                    },
                    {
                        lat: parseFloat(p3[0]),
                        lng: parseFloat(p3[1])
                    },
                    {
                        lat: parseFloat(p4[0]),
                        lng: parseFloat(p4[1])
                    }
                ];

                var color = <?php echo json_encode($row['color']); ?>;

                var poligono = new google.maps.Polygon({
                    paths: coords,
                    strokeColor: color,
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: color,
                    fillOpacity: 0.35
                });

                poligono.setMap(map);

                var ubicacion = <?php echo json_encode(explode(',', $row['ubicacion_1'])); ?>;
                var ruc = <?php echo json_encode($row['ruc']); ?>;
                var nombre = <?php echo json_encode($row['nombre']); ?>;
                var negocio = <?php echo json_encode($row['negocio']); ?>;
                var centroidLat = parseFloat(ubicacion[0]);
                var centroidLng = parseFloat(ubicacion[1]);

                var marker = new google.maps.Marker({
                    position: {
                        lat: centroidLat,
                        lng: centroidLng
                    },
                    map: map,
                    title: nombre
                });

                var infowindow = new google.maps.InfoWindow({
                    content: '<div><b>Empresa</b>: ' + nombre + '<br><b>RUC</b>: ' + ruc + '<br><b>Negocio</b>: ' + negocio + '</div>'
                });

                // Añadir infowindow al array
                infowindows.push(infowindow);

                // Añadir listener para abrir infowindow y cerrar otros
                marker.addListener('click', (function(infowindow, marker) {
                    return function() {
                        // Cerrar todos los infowindows
                        for (var i = 0; i < infowindows.length; i++) {
                            infowindows[i].close();
                        }
                        // Abrir el infowindow correspondiente
                        infowindow.open(map, marker);
                    };
                })(infowindow, marker));

                // Abrir todos los infowindows inicialmente
                infowindow.open(map, marker);
            <?php } ?>
        }

        window.onload = initMap;
    </script>

</body>

</html>