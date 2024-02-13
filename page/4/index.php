<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobando si el archivo ha sido cargado
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        $destino = $archivo['tmp_name'];

        // Leer los primeros 5 bytes del archivo
        $handle = fopen($destino, "r");
        $primerosBytes = fgets($handle, 6);
        fclose($handle);

        // Verificar si los primeros bytes son %PDF-
        if ($primerosBytes === "%PDF-") {
            // Mover el archivo al directorio de destino
            if (move_uploaded_file($archivo['tmp_name'], $archivo['name'])) {
                echo "Archivo PDF subido exitosamente! ";
                // Mostrar enlace al archivo
                echo "<a href='" . htmlspecialchars($archivo['name']) . "'>Haga clic aquí para acceder al archivo</a>";
            } else {
                echo "Error al subr el archivo.";
            }
        } else {
            echo "Error: El archivo no es un PDF: $primerosBytes";
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

