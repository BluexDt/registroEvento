<?php
// Incluir el archivo de conexión
include "modelo/conexion.php";

// Obtener el número de boleto del usuario a editar
if (isset($_GET["num_boleto"])) {
    $id = $_GET["num_boleto"];
    $sql = $conexion->query("SELECT * FROM eventos WHERE num_boleto = '$id'");

    if ($sql->num_rows == 0) {
        echo "<div class='alert alert-danger'>No se encontró el ticket especificado.</div>";
        exit();
    } else {
        $datos = $sql->fetch_object();
    }
} else {
    echo "<div class='alert alert-danger'>No se especificó un número de ticket.</div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <form class="col-4 p-3 m-auto" method="POST">
        <h3 class="text-center text-secondary">Editar Usuario</h3>
        <?php include "controlador/editar.php"; ?>
        
        <div class="mb-3">
            <label for="num_boleto" class="form-label">Número de Ticket: </label>
            <span><?= $datos->num_boleto ?></span>
        </div>
        <div class="mb-3">
            <input type="hidden" name="num_boleto" value="<?= $datos->num_boleto ?>">
            <label for="cedula_editable" class="form-label">Número de Cédula</label>
            <input type="text" class="form-control" name="cedula_editable" value="<?= $datos->cedula ?>" maxlength="10">
        </div>
        <div class="mb-3">
            <label for="nombres" class="form-label">Nombre y Apellido</label>
            <input type="text" class="form-control" name="nombres" id="nombres" value="<?= $datos->nombres ?>">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" value="<?= $datos->telefono ?>"
                maxlength="10">
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" name="correo" id="correo" value="<?= $datos->correo ?>">
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de Registro</label>
            <input type="date" class="form-control" name="fecha" id="fecha" value="<?= $datos->fecha ?>">
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Tipo de Boleto</label>
            <select class="form-select" name="precio" id="precio">
                <option value="General" <?= $datos->precio == 'General' ? 'selected' : '' ?>>General 1$</option>
                <option value="Vip" <?= $datos->precio == 'Vip' ? 'selected' : '' ?>>Vip 5$</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary" name="btnactualizar" value="Actualizar">Actualizar</button>
    </form>
</body>

</html>
