<?php

function generateUniqueNumBoleto($conexion) {
    $exists = 0; 
    do {
        // Generar un número aleatorio entre 1 y 100 millones
        $num_boleto = random_int(1, 100000000);

        // Verificar en la base de datos si el número ya existe
        $stmt = $conexion->prepare("SELECT COUNT(*) FROM eventos WHERE num_boleto = ?");
        $stmt->bind_param("i", $num_boleto);
        $stmt->execute();
        $stmt->bind_result($exists);
        $stmt->fetch();
        $stmt->close();
    } while ($exists > 0);

    return $num_boleto;
}

if (!empty($_POST["btnregistrar"])) {
    // Verificar que todos los campos estén completos
    if (
        !empty($_POST["cedula"]) && !empty($_POST["nombres"]) && !empty($_POST["telefono"]) &&
        !empty($_POST["correo"]) && !empty($_POST["fecha"]) && !empty($_POST["precio"])
    ) {
        $cedula = $_POST["cedula"];
        $nombres = $_POST["nombres"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $fecha = $_POST["fecha"];
        $precio = $_POST["precio"];

        // Generar el número de boleto único
        $num_boleto = generateUniqueNumBoleto($conexion);
        // Calcular el precio a pagar
        if ($precio == 'General') {
            $precio = 1 * 1.15;
        } else if ($precio == 'Vip') {
            $precio = 5 * 1.15;
        }

        // Verificar si la cédula ya existe
        $checkSql = "SELECT * FROM eventos WHERE cedula = '$cedula'";
        $checkResult = $conexion->query($checkSql);

        if ($checkResult->num_rows > 0) {
            echo '<div class="alert alert-danger">Error: La cédula ya está registrada</div>';
        } else {
            // Preparar la consulta SQL
            $stmt = $conexion->prepare("INSERT INTO eventos (cedula, nombres, telefono, correo, fecha, num_boleto, precio) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssis", $cedula, $nombres, $telefono, $correo, $fecha, $num_boleto, $precio);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo '<div class="alert alert-success">Nuevo registro creado exitosamente. Su número de ticket es: ' . $num_boleto . '</div>';
            } else {
                echo '<div class="alert alert-danger">Error al crear nuevo registro: ' . $conexion->error . '</div>';
            }
            $stmt->close();

            // Ocultar la notificación después de 3 segundos
            echo '<script>
             setTimeout(function() {
                 var alertDiv = document.querySelector(\'.alert\');
                 alertDiv.classList.add(\'hidden\');
             }, 3000);
           </script>';
        }
    } else {
        echo '<div class="alert alert-warning">Por favor complete todos los requerimientos</div>';
    }
}
?>
