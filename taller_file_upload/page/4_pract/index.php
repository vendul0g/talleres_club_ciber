<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        $destino = $archivo['name'];
        if (move_uploaded_file($archivo['tmp_name'], $destino)) {
            $handle = fopen($destino, "r");
            $primerosBytes = fgets($handle, 6);
            fclose($handle);
            if ($primerosBytes === "%PDF-") {
                echo "¡Archivo subido exitosamente! ";
            } else {
                echo "Error: Solo se permiten archivos PDF.";
                unlink($destino);
            }
        } else {
            echo "Error al subir el archivo.";
        }
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <label for="archivo">Elija un archivo para subir:</label>
    <input type="file" name="archivo" id="archivo">
    <input type="submit" value="Subir Archivo">
</form>
