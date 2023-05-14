<?php
include('../../conexion/conexion.php'); 

// Obtenemos los valores del formulario
$titulo = $_POST['titulo'];
$nombres = $_POST['nombres'];
$ape_paterno = $_POST['ape_paterno'];
$ape_materno = $_POST['ape_materno'];
$anio = $_POST['anio'];
$especialidad = $_POST['especialidad'];
$editorial = $_POST['editorial'];
$url = $_POST['url'];

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Insertar libro con el ID del autor
$query_libro = $conexion->prepare("INSERT INTO libro (titulo, autor_id, anio, especialidad, editorial, url) VALUES (?, ?, ?, ?, ?, ?)");
$query_libro->bind_param('sissss', $titulo, $autor_id, $anio, $especialidad, $editorial, $url);

$msg = '';


// Verificar si el autor ya existe en la tabla autor
$consulta_autor = $conexion->prepare("SELECT autor_id FROM autor WHERE nombres = ? AND ape_paterno = ? AND ape_materno = ?");
$consulta_autor->bind_param('sss', $nombres, $ape_paterno, $ape_materno);
$consulta_autor->execute();
$resultado_autor = $consulta_autor->get_result();

if ($resultado_autor->num_rows > 0) {
  // El autor ya existe, obtenemos su ID
  $row = $resultado_autor->fetch_assoc();
  $autor_id = $row['autor_id'];
} else {
  // El autor no existe, lo insertamos en la tabla autor
  if ($query_autor->execute()) {
    $autor_id = $conexion->insert_id;
  } else {
    $msg = 'No se pudo registrar al autor';
  }
}

// Insertar el libro en la tabla libro
if ($msg === '') {
  $query_libro->execute();
  if ($query_libro->affected_rows > 0) {
    $msg = 'Libro registrado';
  } else {
    $msg = 'No se pudo registrar el libro';
  }
}

// Cerramos la conexion a la base de datos
desconectar($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Autor</title>
</head>
<body>
  <h1>Agregar Autor</h1>
  <h3><?php echo $msg ?></h3>
  <a href="./libro.php">Regresar</a>
</body>
</html>