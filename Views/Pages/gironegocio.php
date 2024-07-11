<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Giro de Negocio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <label class="card-title"><i class=""></i>Módulo Giro de Negocio</label>
                    </div>
                    <div class="card-body">
                        <form id="formGiro">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="color">Color (Hexadecimal)</label>
                                <input type="color" class="form-control" id="color" name="color" required pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                            </div>
                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-briefcase pr-2"></i>Registrar Giro</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <label class="card-title"><i class=""></i>Lista de Giros de Negocio</label>
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" id="searchInput" placeholder="Buscar por nombre...">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Color</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="listaGiros">
                                    <!-- Aquí se insertarán los registros desde la base de datos -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel"><i class="fa fa-briefcase pr-2"></i>Actualizar Giro de Negocio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarGiro">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editNombre">Nombre</label>
                            <input type="text" class="form-control" id="editNombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="editColor">Color</label>
                            <input type="color" class="form-control" id="editColor" name="color" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check-circle pr-2"></i>Actualizar Giro</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle pr-2"></i>Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            function cargarGiros() {
                $.ajax({
                    url: 'Views/Pages/crud_giro.php',
                    method: 'POST',
                    data: {
                        action: 'listar'
                    },
                    success: function(data) {
                        $('#listaGiros').html(data);
                    }
                });
            }

            cargarGiros();

            $('#formGiro').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'Views/Pages/crud_giro.php',
                    method: 'POST',
                    data: $(this).serialize() + '&action=agregar',
                    success: function(response) {
                        var resp = JSON.parse(response);
                        if (resp.success) {
                            Swal.fire('Éxito', resp.message, 'success');
                        } else {
                            Swal.fire('Error', resp.message, 'error');
                        }
                        cargarGiros();
                        $('#formGiro')[0].reset();
                    }
                });
            });

            $(document).on('click', '.btn-editar', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'Views/Pages/crud_giro.php',
                    method: 'POST',
                    data: {
                        id: id,
                        action: 'obtener'
                    },
                    success: function(data) {
                        var giro = JSON.parse(data);
                        $('#editId').val(giro.id_giro);
                        $('#editNombre').val(giro.nombre_giro);
                        $('#editColor').val(giro.color);
                        $('#modalEditar').modal('show');
                    }
                });
            });

            $('#formEditarGiro').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'Views/Pages/crud_giro.php',
                    method: 'POST',
                    data: $(this).serialize() + '&action=editar',
                    success: function(response) {
                        var resp = JSON.parse(response);
                        if (resp.success) {
                            Swal.fire('Éxito', resp.message, 'success');
                        } else {
                            Swal.fire('Error', resp.message, 'error');
                        }
                        cargarGiros();
                        $('#modalEditar').modal('hide');
                    }
                });
            });

            $(document).on('click', '.btn-eliminar', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'No podrás revertir esto',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'Views/Pages/crud_giro.php',
                            method: 'POST',
                            data: {
                                id: id,
                                action: 'eliminar'
                            },
                            success: function(response) {
                                var resp = JSON.parse(response);
                                if (resp.success) {
                                    Swal.fire('Eliminado', resp.message, 'success');
                                } else {
                                    Swal.fire('Error', resp.message, 'error');
                                }
                                cargarGiros();
                            }
                        });
                    }
                });
            });

            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#listaGiros tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

        });
    </script>
</body>

</html>
