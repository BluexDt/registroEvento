<?php
if (!empty($_POST["btnactualizar"])) {
    if (
        !empty($_POST["cedula_editable"]) && !empty($_POST["nombres"]) && !empty($_POST["telefono"]) &&
        !empty($_POST["correo"]) && !empty($_POST["fecha"]) && !empty($_POST["precio"]) && !empty($_POST["num_boleto"])
    ) {
        // Obtención de datos del formulario
        $nueva_cedula = $_POST["cedula_editable"];
        $nombres = $_POST["nombres"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $fecha = $_POST["fecha"];
        $precio = $_POST["precio"];
        $num_boleto = $_POST["num_boleto"];

        // Calcular el precio a pagar
        $nuevo_precio = 0; 
        if ($precio == 'General') {
            $nuevo_precio = 1 * 1.15;
        } else if ($precio == 'Vip') {
            $nuevo_precio = 5 * 1.15;
        }

        // Verificar si la nueva cédula está disponible (excepto para el usuario actual)
        $sql_check = "SELECT COUNT(*) as count FROM eventos WHERE cedula = '$nueva_cedula' AND num_boleto != '$num_boleto'";
        $result_check = $conexion->query($sql_check);
        $row_check = $result_check->fetch_assoc();

        if ($row_check['count'] == 0) {
            // La nueva cédula está disponible, proceder con la actualización
            $sql_update = "UPDATE eventos SET
                cedula = '$nueva_cedula', 
                nombres = '$nombres',
                telefono = '$telefono',
                correo = '$correo',
                fecha = '$fecha',
                precio = '$nuevo_precio'
                WHERE num_boleto = '$num_boleto'";

            if ($conexion->query($sql_update) === TRUE) {
                echo "<script>alert('Actualización exitosa'); window.location.href='index.php';</script>";
                exit(); // Importante para asegurar que la redirección se efectúe correctamente
            } else {
                echo "<div class='alert alert-danger'>Error al actualizar datos: " . $conexion->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>La nueva cédula ya está en uso por otro usuario.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Campos vacíos</div>";
    }
}
?>
