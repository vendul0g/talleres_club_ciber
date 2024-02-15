<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobando si el archivo ha sido cargado
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];

        // Usar expresión regular para verificar si el archivo termina exactamente en .php
        if (preg_match('/\.php$/i', $archivo['name'])) {
            echo "Error: No está permitido la subida de archivo .php";
        } else {
            // Ruta donde se guardará el archivo
            $destino = $archivo['name'];

            // Mover el archivo al directorio de destino
            if (move_uploaded_file($archivo['tmp_name'], $destino)) {
                echo "Archivo subido exitosamente! ";
                // Mostrar enlace al archivo
                echo "<a href='" . htmlspecialchars($destino) . "'>Haga clic aquí para acceder al archivo</a>";
            } else {
                echo "Error al subir el archivo.";
            }
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
