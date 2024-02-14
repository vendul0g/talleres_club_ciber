<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Comprobando si el archivo ha sido cargado
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        $contenidoArchivo = file_get_contents($archivo['tmp_name']);
        $longitudMaxima = strlen('solo_tienes_23_letras:)');
        // Verificar si la longitud del contenido del archivo no excede la longitud máxima permitida
        if (strlen($contenidoArchivo) > $longitudMaxima) {
            echo "Error: El archivo excede la longitud máxima permitida.";
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
