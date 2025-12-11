<?php
require_once __DIR__ . "/includes/db.php";

$mensaje = "";
$tipoMensaje = "";
$conn = conectarBD();

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
        $stmt = $conn->prepare("INSERT INTO contactos (nombre, telefono, email, direccion) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $telefono, $email, $direccion);

        if ($stmt->execute()) {
            $mensaje = "Contacto añadido correctamente.";
            $tipoMensaje = "success";
        } else {
            $mensaje = "Error al añadir el contacto: " . $conn->error;
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
    <title>Añadir Contacto</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Añadir nuevo contacto</h1>

    <div id="mensaje" class="<?php echo $tipoMensaje; ?>"
        style="<?php echo $mensaje ? 'display:block;' : 'display:none;'; ?>">
        <?php echo htmlspecialchars($mensaje); ?>
    </div>

    <form method="post" action="">
        <label>Nombre*: <input type="text" name="nombre" required></label><br><br>
        <label>Teléfono*: <input type="text" name="telefono" required></label><br><br>
        <label>Email*: <input type="email" name="email" required></label><br><br>
        <label>Dirección: <input type="text" name="direccion"></label><br><br>
        <button type="submit">Añadir contacto</button>
        <a href="index.php" class="boton volver">Volver</a>
    </form>

    <script src="js/mensajes.js"></script>
</body>

</html>