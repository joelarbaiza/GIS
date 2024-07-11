<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Polígonos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css" rel="stylesheet" />
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js"></script>
    <script src="https://unpkg.com/mapkick@0.2.6/dist/mapkick.js"></script>
</head>

<body>
    <div class="container pt-3">
        <div class="card mx-auto" style="max-width: 1200px;">
            <div class="card-header">
                <label class="card-title"><i class="fas fa-draw-polygon"></i> Registro de Polígono</label>
            </div>

            <div class="card-body">
                <form method="POST" action="Controllers/poligonoController.php">
                    <input type="hidden" name="action" value="add">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="id_empresa" class="text-secondary">Empresa</label>
                            <select class="form-control" id="id_empresa" name="id_empresa" required>
                                <option value="">Selecciona una empresa</option>
                                <?php
                                $empresas = $pdo->query("SELECT id_empresa, nombre_comercial FROM EMPRESA")->fetchAll();
                                foreach ($empresas as $empresa) : ?>
                                    <option value="<?= htmlspecialchars($empresa['id_empresa']) ?>"><?= htmlspecialchars($empresa['nombre_comercial']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="p1" class="text-secondary">Punto 1</label>
                            <input class="form-control" id="p1" type="text" name="p1" placeholder="Seleccione en el mapa" required id="p1">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="p2" class="text-secondary">Punto 2</label>
                            <input class="form-control" id="p2" type=" text" name="p2" placeholder="Seleccione en el mapa" required id="p2">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="p3" class="text-secondary">Punto 3</label>
                            <input class="form-control" id="p3" type="text" name="p3" placeholder="Seleccione en el mapa" required id="p3">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="p4" class="text-secondary">Punto 4</label>
                            <input class="form-control" id="p4" type="text" name="p4" placeholder="Seleccione en el mapa" required id="p4">
                        </div>
                    </div>

                    <div class="text-right mt-2">
                        <button type="submit" class="btn btn-success"><i class="fas fa-check-circle pr-1"></i> Registrar Polígono</button>
                        <a href="poligonos" class="btn btn-danger"><i class="fa fa-times-circle pr-2"></i>Cancelar</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-3 pb-3">
            <div id="search-container" class="form-group position-relative">
                <label for="search" class="card-title"><i class="fas fa-map-marker-alt pr-2"></i>Buscar ubicación</label>
                <input type="text" id="search" class="form-control" placeholder="Escribe aquí para buscar">
                <div id="suggestions" class="dropdown-menu"></div>
            </div>
            <button id="reset-button" class="btn btn-danger mb-3"><i class="fas fa-redo pr-2"></i>Reiniciar Coordenadas</button><br>
            <div id="map" style="width: 100%; height: 400px;"></div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        mapboxgl.accessToken = "pk.eyJ1IjoicG9saTIzIiwiYSI6ImNsd3Y4bzU3YzBscnMybHBuc3M3MTloYmcifQ.kybErNGB0mMGl9T011KENw";

        document.addEventListener("DOMContentLoaded", function() {
            var lat = -6.7714;
            var lng = -79.8409;

            var map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/streets-v11",
                center: [lng, lat],
                zoom: 13,
            });

            var marker = new mapboxgl.Marker()
                .setLngLat([lng, lat])
                .addTo(map);

            var inputs = ['p1', 'p2', 'p3', 'p4'];
            var inputIndex = 0;

            map.on("click", function(e) {
                if (inputIndex < inputs.length) {
                    var coords = e.lngLat;
                    var lat = coords.lat;
                    var lng = coords.lng;
                    var coordString = lat + "," + lng;

                    document.getElementById(inputs[inputIndex]).value = coordString;
                    marker.setLngLat([lng, lat]).addTo(map);

                    getLocationDetails(lat, lng);
                    inputIndex++;
                }
            });

            var geolocate = new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true,
                },
                trackUserLocation: true,
            });

            map.addControl(geolocate);

            geolocate.on("geolocate", function(e) {
                var lat = e.coords.latitude;
                var lng = e.coords.longitude;

                var coordString = lat + "," + lng;
                if (inputIndex < inputs.length) {
                    document.getElementById(inputs[inputIndex]).value = coordString;
                    inputIndex++;
                }

                map.flyTo({
                    center: [lng, lat],
                    zoom: 15,
                });

                marker.setLngLat([lng, lat]).addTo(map);
                getLocationDetails(lat, lng);
            });

            var searchInput = document.getElementById("search");
            var suggestionsList = document.getElementById("suggestions");

            searchInput.addEventListener("input", function(e) {
                var query = e.target.value;

                suggestionsList.innerHTML = "";

                if (query.length < 3) {
                    suggestionsList.classList.remove("show");
                    return;
                }

                fetch(
                        `https://api.mapbox.com/geocoding/v5/mapbox.places/${query}.json?access_token=${mapboxgl.accessToken}`
                    )
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.features.length > 0) {
                            suggestionsList.classList.add("show");
                        } else {
                            suggestionsList.classList.remove("show");
                        }

                        data.features.forEach((feature) => {
                            var suggestionItem = document.createElement("a");
                            suggestionItem.classList.add("dropdown-item");
                            suggestionItem.textContent = feature.place_name;
                            suggestionItem.onclick = function() {
                                var lngLat = feature.center;
                                var lng = lngLat[0];
                                var lat = lngLat[1];
                                var coordString = lat + "," + lng;

                                map.flyTo({
                                    center: [lng, lat],
                                    zoom: 15,
                                });

                                if (inputIndex < inputs.length) {
                                    document.getElementById(inputs[inputIndex]).value = coordString;
                                    inputIndex++;
                                }

                                marker.setLngLat([lng, lat]).addTo(map);
                                getLocationDetails(lat, lng);

                                suggestionsList.innerHTML = "";
                                suggestionsList.classList.remove("show");
                            };
                            suggestionsList.appendChild(suggestionItem);
                        });
                    })
                    .catch((error) => {
                        console.error("Error al buscar sugerencias:", error);
                    });
            });

            document.getElementById("reset-button").addEventListener("click", function() {
                inputs.forEach(function(inputId) {
                    document.getElementById(inputId).value = "";
                });
                inputIndex = 0;
                marker.setLngLat([lng, lat]).addTo(map);
            });

            function getLocationDetails(lat, lng) {
                console.log(`Latitud: ${lat}, Longitud: ${lng}`);
            }
        });
    </script>
</body>

</html>