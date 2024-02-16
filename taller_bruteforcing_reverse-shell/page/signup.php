<?php
// Conexión a la base de datos
$host = '0.0.0.0';
$usuario = 'test';
$contrasena = 'contracontratest';
$base_de_datos = 'shop';


$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Recibe los datos del formulario HTML
$nombre = $_POST['nombre'];
$contrasena = md5($_POST['contrasena']);

$blacklist = '/\b(or|and|\'|=)\b/i';

if (preg_match($blacklist, $nombre)) {
    header('Location: error.html');
} else {
    // La entrada del usuario es segura y no contiene palabras de la "blacklist"
    // Puedes continuar con el procesamiento de la entrada.


// Consulta a la base de datos
$sql = "SELECT * FROM usuarios WHERE nombre = '$nombre' AND contrasena = '$contrasena'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    // Datos de inicio de sesión válidos
    header('Location: p4g3Hiid3n0nlyUs3rs.html');
}else {
    // Datos de inicio de sesión incorrectos
    header('Location: index.html');
}

} 
$conn->close();
?>

