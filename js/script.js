function eliminarContacto(id) {
    if (!confirm("¿Seguro que quieres eliminar este contacto?")) return;

    fetch("eliminar.php?id=" + id, { method: "GET" })
        .then(res => {
            if (!res.ok) throw new Error("Respuesta HTTP no válida");
            return res.json();
        })
        .then(data => {
            console.log("Respuesta eliminar.php:", data); // depuración
            if (data.success) {
                mostrarMensaje("Contacto eliminado correctamente", "success");
                // Recargar la página después de 1 segundo
                setTimeout(() => location.reload(), 1000);
            } else {
                mostrarMensaje("Error: " + data.message, "error");
                // Fuerza recarga aunque haya error
                setTimeout(() => location.reload(), 1500);
            }
        })
        .catch(err => {
            console.error("Error en fetch:", err);
            // Fuerza recarga incluso si falla el fetch
            location.reload();
        });
}
