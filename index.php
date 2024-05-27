<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ca275b3476.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: url('crud.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <script>
        function eliminar() {
            return confirm("Estas seguro de que deseas eliminar este usuario");
        }
        // Función para ocultar la notificación después de un cierto tiempo
        setTimeout(function () {
            var alertDiv = document.querySelector('.alert');
            if (alertDiv) {
                alertDiv.classList.add('hidden');
            }
        }, 3000); // Cambia el valor (en milisegundos) según lo que desees
    </script>
    <h1 class="text-center p-3"style="color: #87CEEB;">Registro para el Evento "Conferencia de Tecnología 2024"</h1>
    <?php
    include "modelo/conexion.php";
    include "controlador/eliminar.php";
    ?>
    <div class="container-fluid mt-5">
        <div class="row">

            <!-- Formulario de registro -->

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form class="p-3" method="POST" action="index.php">
                            <h3 class="text-center text-secondary">Conferencia de Tecnología 2024</h3>
                            <?php include "controlador/registrar.php"; ?>
                            <div class="mb-3">
                                <label for="cedula" class="form-label">Número de Cédula</label>
                                <input type="text" class="form-control" name="cedula" id="cedula" maxlength="10">
                            </div>
                            <div class="mb-3">
                                <label for="nombres" class="form-label">Nombre y Apellido</label>
                                <input type="text" class="form-control" name="nombres" id="nombres">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono">
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="correo" id="correo">
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Valor a pagar sin IVA</label>
                                <select class="form-select" name="precio" id="precio">
                                    <option value="">Selecciona un Tipo de boleto</option>
                                    <option value="General">General 1$</option>
                                    <option value="Vip">Vip 5$</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha de Registro</label>
                                <input type="date" class="form-control" name="fecha" id="fecha">
                            </div>

                            <button type="submit" class="btn btn-primary" name="btnregistrar"
                                value="Ok">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla que muestra el registro -->

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="bg-info">
                                <tr>
                                    <th scope="col">Cédula</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Id_Ticket</th>
                                    <th scope="col">Valor a Pagar</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM eventos";
                                $result = $conexion->query($sql);

                                if ($result === false) {
                                    echo "Error en la consulta: " . $conexion->error;
                                } else {
                                    while ($datos = $result->fetch_object()) { ?>
                                        <tr>
                                            <td><?= htmlspecialchars($datos->cedula) ?></td>
                                            <td><?= htmlspecialchars($datos->nombres) ?></td>
                                            <td><?= htmlspecialchars($datos->telefono) ?></td>
                                            <td><?= htmlspecialchars($datos->correo) ?></td>
                                            <td><?= htmlspecialchars($datos->fecha) ?></td>
                                            <td><?= htmlspecialchars($datos->num_boleto) ?></td>
                                            <td><?= htmlspecialchars($datos->precio) ?></td>
                                            <td>
                                                <a href="editar.php?num_boleto=<?= htmlspecialchars($datos->num_boleto) ?>"
                                                    class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a onclick="return eliminar()"
                                                    href="index.php?id=<?= htmlspecialchars($datos->num_boleto) ?>"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
                                                </a>
                                            
                                            </td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>