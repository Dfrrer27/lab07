<?php

  include ('../../conexion/conexion.php');

  $conexion = conectar();

  if (isset($_GET['id'])){

    $id = $_GET['id'];

    $query = $conexion->prepare("DELETE FROM autor WHERE autor_id = ?");

    $query->bind_param('i', $id);

    $msg = '';

    if ($query->execute()) {
      $msg = 'Autor Eliminado';
    }
    else{
      $msg = 'No se pudo eliminar al Autor';
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eliminar Autor</title>
</head>
<body>
  <h1>Eliminar Autor</h1>
  <h3><?php echo $msg ?></h3>
  <a href="./autor.php">Regresar</a>
</body>
</html>
