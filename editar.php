<?php
require_once __DIR__ . "/includes/db.php";

$mensaje = "";
$tipoMensaje = "";
$conn = conectarBD();

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $stmt = $conn->prepare("SELECT nombre, telefono, email, direccion FROM contactos WHERE contacto_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $contacto = $resultado->fetch_assoc();
    $stmt->close();

    if (!$contacto) {
        die("Contacto no encontrado.");
    }
} else {
    die("ID no especificado.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $direccion = trim($_POST["direccion"] ?? "");

    if ($nombre === "" || $telefono === "" || $email === "") {
        $mensaje = "Nombre, Teléfono y Email son obligatorios.";
        $tipoMensaje = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El formato del email no es válido.";
        $tipoMensaje = "error";
    } else {
        $stmt = $conn->prepare("UPDATE contactos SET nombre=?, telefono=?, email=?, direccion=? WHERE contacto_id=?");
        $stmt->bind_param("ssssi", $nombre, $telefono, $email, $direccion, $id);

        if ($stmt->execute()) {
            $mensaje = "Contacto actualizado correctamente.";
            $tipoMensaje = "success";
            $contacto["nombre"] = $nombre;
            $contacto["telefono"] = $telefono;
            $contacto["email"] = $email;
            $contacto["direccion"] = $direccion;
        } else {
            $mensaje = "Error al actualizar el contacto: " . $conn->error;
            $tipoMensaje = "error";
        }
        $stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Contacto</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Editar contacto</h1>

    <div id="mensaje" class="<?php echo $tipoMensaje; ?>"
        style="<?php echo $mensaje ? 'display:block;' : 'display:none;'; ?>">
        <?php echo htmlspecialchars($mensaje); ?>
    </div>
    <form method="post" action="">
        <label>Nombre*: <input type="text" name="nombre" value="<?php echo htmlspecialchars($contacto["nombre"]); ?>"
                required></label><br><br>
        <label>Teléfono*: <input type="text" name="telefono"
                value="<?php echo htmlspecialchars($contacto["telefono"]); ?>" required></label><br><br>
        <label>Email*: <input type="email" name="email" value="<?php echo htmlspecialchars($contacto["email"]); ?>"
                required></label><br><br>
        <label>Dirección: <input type="text" name="direccion"
                value="<?php echo htmlspecialchars($contacto["direccion"]); ?>"></label><br><br>

        <button type="submit" class="boton editar">Guardar cambios</button>
        <a href="index.php" class="boton volver">Volver</a>
    </form>

    <script src="js/mensajes.js"></script>
</body>

</html>