<?php
// Specify the target directory and max file size
$targetDirectory = "uploads/";
$maxFileSize = 2 * 1024 * 1024; // 2MB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        $destino = $archivo['tmp_name'];
        $originalName = $archivo['name'];
        $fileSize = $archivo['size'];

        // Check if the file is larger than the allowed size
        if ($fileSize > $maxFileSize) {
            echo "Error: File size is larger than the allowed limit.";
            exit;
        }

        // Validate MIME type
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($destino);
        if ($mimeType !== 'application/pdf') {
            echo "Error: The file is not a PDF.";
            exit;
        }

        // Sanitize file name
        $safeName = preg_replace('/[^a-zA-Z0-9-_\.]/', '', basename($originalName));
        $safeName = uniqid() . '-' . $safeName; // Ensure a unique name to prevent overwriting

        // Ensure the file does not override important files or escape the target directory
        $targetPath = $targetDirectory . $safeName;
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true); // Create the directory if it doesn't exist
        }

        // Move the file to the target directory
        if (move_uploaded_file($destino, $targetPath)) {
            echo "PDF file uploaded successfully! ";
            // Display link to the file
            echo "<a href='" . htmlspecialchars($targetPath) . "'>Click here to access the file</a>";
        } else {
            echo "Error uploading file.";
        }
    }
}
?>

<!-- HTML form for file upload -->
<form method="post" enctype="multipart/form-data">
    <label for="archivo">Choose a file to upload:</label>
    <input type="file" name="archivo" id="archivo">
    <input type="submit" value="Upload File">
</form>

