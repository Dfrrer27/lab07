<?php
include('../../conexion/conexion.php'); 

// Obtener el ID del libro a eliminar
$libro_id = $_GET['id'];

// Abrir la conexión a la base de datos
$conexion = conectar();

// Obtener los datos del libro antes de eliminarlo
$query_libro = $conexion->prepare("SELECT autor_id FROM libro WHERE libro_id = ?");
$query_libro->bind_param('i', $libro_id);
$query_libro->execute();
$resultado_libro = $query_libro->get_result();

if ($resultado_libro->num_rows > 0) {
  // Obtener el ID del autor asociado al libro
  $row = $resultado_libro->fetch_assoc();
  $autor_id = $row['autor_id'];

  // Eliminar el libro de la tabla libro
  $query_eliminar_libro = $conexion->prepare("DELETE FROM libro WHERE libro_id = ?");
  $query_eliminar_libro->bind_param('i', $libro_id);
  $query_eliminar_libro->execute();

  if ($query_eliminar_libro->affected_rows > 0) {
    // Codigo de verificar si el autor no tiene más libros asociados
    $query_verificar_autor = $conexion->prepare("SELECT libro_id FROM libro WHERE autor_id = ?");
    $query_verificar_autor->bind_param('i', $autor_id);
    $query_verificar_autor->execute();
    $resultado_verificar_autor = $query_verificar_autor->get_result();

    if ($resultado_verificar_autor->num_rows === 0) {
      // Si no hay más libros asociados al autor, eliminar el autor de la tabla autor
      $query_eliminar_autor = $conexion->prepare("DELETE FROM autor WHERE autor_id = ?");
      $query_eliminar_autor->bind_param('i', $autor_id);
      $query_eliminar_autor->execute();
    }

    $msg = 'Libro eliminado exitosamente';
  } else {
    $msg = 'No se pudo eliminar el libro';
  }
} else {
  $msg = 'No se encontró el libro';
}

// Cerrar la conexión a la base de datos
desconectar($conexion);

//QUE DOLOR DE CABEZA :'V

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eliminar Libro</title>
</head>
<body>
  <h1>Eliminar Libro</h1>
  <h3><?php echo $msg ?></h3>
  <a href="./libro.php">Regresar</a>
</body>
</html>