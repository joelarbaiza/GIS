<?php


require_once __DIR__ . '/../../Conexion/conexionBD.php';

$pdo = obtenerConexion();

// Manejar solicitudes AJAX
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'listar':
            listarGiros($pdo);
            break;
        case 'agregar':
            agregarGiro($pdo);
            break;
        case 'obtener':
            obtenerGiro($pdo);
            break;
        case 'editar':
            editarGiro($pdo);
            break;
        case 'eliminar':
            eliminarGiro($pdo);
            break;
    }
}

function listarGiros($pdo)
{
    try {
        $stmt = $pdo->query("SELECT * FROM giro_negocio ORDER BY id_giro");
        $giros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $contador = 1;

        foreach ($giros as $giro) {
            echo '<tr>';
            echo '<td>' . $contador++ . '</td>';
            echo '<td>' . htmlspecialchars($giro['nombre_giro']) . '</td>';
            echo '<td style="background-color:' . htmlspecialchars($giro['color']) . '; color: white;">' . htmlspecialchars($giro['color']) . '</td>';
            echo '<td>
                    <button class="btn btn-outline-success ml-1 btn-editar" data-id="' . $giro['id_giro'] . '"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-outline-danger btn-eliminar ml-1" data-id="' . $giro['id_giro'] . '"><i class="fas fa-trash"></i></button>
                  </td>';
            echo '</tr>';
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => "Error de conexión: " . $e->getMessage()]);
    }
}

function agregarGiro($pdo)
{
    try {
        $nombre = $_POST['nombre'];
        $color = $_POST['color'];

        $stmt = $pdo->prepare("INSERT INTO giro_negocio (nombre_giro, color) VALUES (:nombre, :color)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':color', $color);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Giro de negocio agregado correctamente.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => "Error: " . $e->getMessage()]);
    }
}

function obtenerGiro($pdo)
{
    try {
        $id = $_POST['id'];

        $stmt = $pdo->prepare("SELECT * FROM giro_negocio WHERE id_giro = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $giro = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($giro);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => "Error: " . $e->getMessage()]);
    }
}

function editarGiro($pdo)
{
    try {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $color = $_POST['color'];

        $stmt = $pdo->prepare("UPDATE giro_negocio SET nombre_giro = :nombre, color = :color WHERE id_giro = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':color', $color);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Giro de negocio actualizado correctamente.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => "Error: " . $e->getMessage()]);
    }
}

function eliminarGiro($pdo)
{
    try {
        $id = $_POST['id'];

        $stmt = $pdo->prepare("DELETE FROM giro_negocio WHERE id_giro = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Giro de negocio eliminado correctamente.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => "La llave (id_giro)=$id todavía es referida desde la tabla Empresa."]);
    }
}
