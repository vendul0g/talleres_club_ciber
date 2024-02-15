<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        $destino = $archivo['name'];

        // Mover el archivo temporal al directorio de destino primero
        if (move_uploaded_file($archivo['tmp_name'], $destino)) {
            // Verificar el Content-Type del archivo después de moverlo
            $handle = fopen($destino, "r");
            $primerosBytes = fgets($handle, 6);
            fclose($handle);

            if ($primerosBytes === "%PDF-") {
                echo "¡Archivo subido exitosamente! ";
                // Mostrar enlace al archivo
                // echo "<a href='" . htmlspecialchars($destino) . "'>Haga clic aquí para acceder al archivo</a>";
            } else {
                echo "Error: Solo se permiten archivos PDF.";
                // Eliminar el archivo si no es PDF
                unlink($destino);
            }
        } else {
            echo "Error al subir el archivo.";
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
