<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];

        // Verificar el Content-Type del archivo
        $handle = fopen($destino, "r");
        $primerosBytes = fgets($handle, 6);
        fclose($handle);
        $destino = $archivo['name'];
        if ($primerosBytes === "%PDF-") {

            // Mover el archivo al directorio de destino
            if (move_uploaded_file($archivo['tmp_name'], $destino)) {
                echo "¡Archivo subido exitosamente! ";
                // Mostrar enlace al archivo
                echo "<a href='" . htmlspecialchars($destino) . "'>Haga clic aquí para acceder al archivo</a>";
            } else {
                echo "Error al subir el archivo.";
            }
        } else {
            echo "Error: Solo se permiten archivos JPEG.";
        }
    }
}
?>

<!-- Formulario HTML para la subida de archivos -->
<form method="post" enctype="multipart/form-data">
    <label for="archivo">Elija un archivo para subir:</label>
    <input type="file" name="archivo" id="archivo">
    <input type="submit" value="Subir Archivo">
</form>
