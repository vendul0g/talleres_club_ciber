<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Checking if the file has been uploaded
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        $destino = $archivo['tmp_name'];
        $nombreArchivo = $archivo['name'];

        // Check if the file extension is .pdf
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        if (strtolower($extension) !== 'pdf') {
            echo "Error: El archivo no tiene una extensión .pdf.";
            exit; // Stop the script
        }

        // Check the MIME content type for PDF
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
        $type = finfo_file($finfo, $destino);

        if ($type != 'application/pdf') {
            echo "Error: El tipo de contenido no es PDF ($type).";
            exit; // Stop the script
        }
        finfo_close($finfo);

        // Read the first 5 bytes of the file
        $handle = fopen($destino, "r");
        $primerosBytes = fgets($handle, 6);
        fclose($handle);

        // Verify if the first bytes are %PDF-
        if ($primerosBytes !== "%PDF-") {
            echo "Error: El archivo no es un PDF... $primerosBytes";
            exit; // Stop the script
        }

        $pdfContent = file_get_contents($destino);
        // Regular expression to find metadata
        $pattern = '/\/(Author|CreationDate|Comment) \((.*?)\)/';
        preg_match_all($pattern, $pdfContent, $matches, PREG_SET_ORDER);

        if (!empty($matches)) {
            echo "<h2>PDF Metadata:</h2>";
            foreach ($matches as $match) {
                echo "<strong>" . $match[1] . ":</strong> ";
                if ($match[1] === 'Comment') {
                    // Danger: Using eval() to execute code from PDF metadata
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

<!-- HTML form for file upload -->
<h1>Lector de PDFs</h1>
<form method="post" enctype="multipart/form-data">
    <label for="archivo">Elija un archivo para subir:</label>
    <input type="file" name="archivo" id="archivo">
    <input type="submit" value="Subir Archivo">
</form>