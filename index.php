<?php
require_once __DIR__ . "/includes/db.php";

$conn = conectarBD();
$sql = "SELECT contacto_id, nombre, telefono, email, direccion, fecha_creacion FROM contactos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agenda de Contactos</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Agenda de Contactos</h1>
    <p class="acciones-centradas">
        <a class="boton nuevo" href="nuevo.php">Añadir nuevo contacto</a>
    </p>


    <!-- Contenedor para mensajes flotantes -->
    <div id="mensaje"></div>

    <table>
        <tr>
            <th>#</th> <!-- Número consecutivo -->
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Dirección</th>

            <th>Acciones</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php $contador = 1; ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr id="fila-<?php echo $row["contacto_id"]; ?>">
                    <td><?php echo $contador++; ?></td> <!-- Número consecutivo -->
                    <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                    <td><?php echo htmlspecialchars($row["telefono"]); ?></td>
                    <td><?php echo htmlspecialchars($row["email"]); ?></td>
                    <td><?php echo htmlspecialchars($row["direccion"]); ?></td>

                    <td>
                        <a class="boton editar" href="editar.php?id=<?php echo urlencode($row["contacto_id"]); ?>">Editar</a>
                        <button class="boton eliminar"
                            onclick="eliminarContacto(<?php echo $row['contacto_id']; ?>)">Eliminar</button>
                    </td>

                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No hay contactos registrados.</td>
            </tr>
        <?php endif; ?>
    </table>
    <script src="js/mensajes.js"></script>
    <script src="js/acciones.js"></script>
</body>

</html>
<?php $conn->close(); ?>