<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        if (preg_match('/\.php$/i', $archivo['name'])) {
            echo "Error: No está permitido la subida de archivo .php";
        } else {
            $destino = $archivo['name'];
            if (move_uploaded_file($archivo['tmp_name'], $destino)) {
                echo "Archivo subido exitosamente! ";
                echo "<a href='" . htmlspecialchars($destino) . "'>Haga clic aquí para acceder al archivo</a>";
            } else {
                echo "Error al subir el archivo.";
            }
        }
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <label for="archivo">Elija un archivo para subir:</label>
    <input type="file" name="archivo" id="archivo">
    <input type="submit" value="Subir Archivo">
</form>
