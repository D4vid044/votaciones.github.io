<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "votaciones";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$grado = $_POST['grado'];
$dibujo = $_POST['dibujo'];

$sql = "INSERT INTO votos (nombre, grado, dibujo) VALUES ('$nombre', '$grado', '$dibujo')";

if ($conn->query($sql) === TRUE) {
  header("Location: gracias.html");
  exit();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
