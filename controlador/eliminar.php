<?php
include "modelo/conexion.php";

if (isset($_GET["id"])) {
    $num_boleto = $_GET["id"];

    // Sentencia preparada para evitar inyección SQL
    $stmt = $conexion->prepare("DELETE FROM eventos WHERE num_boleto = ?");
    $stmt->bind_param("i", $num_boleto);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Usuario eliminado correctamente.</div>';
    } else {
        echo '<div class="alert alert-danger">Error al eliminar usuario: ' . $conexion->error . '</div>';
    }
    $stmt->close();
}
?>