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

// Obtener los 3 dibujos más votados
$sql_dibujos = "SELECT grado, dibujo, COUNT(*) as votos 
                FROM votos 
                GROUP BY grado, dibujo 
                ORDER BY votos DESC 
                LIMIT 3";
$result_dibujos = $conn->query($sql_dibujos);

// Obtener los últimos 5 votantes
$sql_votantes = "SELECT nombre, grado, dibujo 
                 FROM votos 
                 ORDER BY id DESC 
                 LIMIT 5";
$result_votantes = $conn->query($sql_votantes);

$resultados = array(
  'dibujos' => array(),
  'votantes' => array()
);

if ($result_dibujos->num_rows > 0) {
  while ($row = $result_dibujos->fetch_assoc()) {
    $resultados['dibujos'][] = $row;
  }
}

if ($result_votantes->num_rows > 0) {
  while ($row = $result_votantes->fetch_assoc()) {
    $resultados['votantes'][] = $row;
  }
}

header('Content-Type: application/json');
echo json_encode($resultados);

$conn->close();
?>
