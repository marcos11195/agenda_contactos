function eliminarContacto(id) {
    if (!confirm("¿Seguro que quieres eliminar este contacto?")) return;

    fetch("eliminar.php?id=" + id, { method: "GET" })
        .finally(() => {
            // Pase lo que pase, recarga la página
            location.reload();
        });
}
