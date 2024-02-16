<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target = $_POST["target"];
    $ip = gethostbyname($target);
    if ($ip) {
        $output = shell_exec("ping -c 4 $ip"); // Cambia el valor de -c según tus necesidades
        echo "<pre>$output</pre>";
    } else {
        echo "No se pudo obtener la dirección IP para el host proporcionado.";
    }
}
?>
