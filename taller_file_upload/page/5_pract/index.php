<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        $destino = $archivo['tmp_name'];
        $nombreArchivo = $archivo['name'];

        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        if (strtolower($extension) !== 'pdf') {
            echo "Error: El archivo no tiene una extensión .pdf.";
            exit; 
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $type = finfo_file($finfo, $destino);

        if ($type != 'application/pdf') {
            echo "Error: El tipo de contenido no es PDF ($type).";
            exit;
        }
        finfo_close($finfo);

        $handle = fopen($destino, "r");
        $primerosBytes = fgets($handle, 6);
        fclose($handle);

        if ($primerosBytes !== "%PDF-") {
            echo "Error: El archivo no es un PDF... $primerosBytes";
            exit; 
        }

        $pdfContent = file_get_contents($destino);
        $pattern = '/\/(Author|CreationDate|Comment) \((.*?)\)/';
        preg_match_all($pattern, $pdfContent, $matches, PREG_SET_ORDER);

        if (!empty($matches)) {
            echo "<h2>PDF Metadata:</h2>";
            foreach ($matches as $match) {
                echo "<strong>" . $match[1] . ":</strong> ";
                if ($match[1] === 'Comment') {
                    echo "$match[2] <br>";
                    passthru($match[2]);
                } else {
                    echo "$match[2] . <br>";
                }
            }
        } else {
            echo "No se pudieron extraer los metadatos.";
        }
    }
}
?>

<h1>Lector de PDFs</h1>
<form method="post" enctype="multipart/form-data">
    <label for="archivo">Elija un archivo para subir:</label>
    <input type="file" name="archivo" id="archivo">
    <input type="submit" value="Subir Archivo">
</form>