<?php
  include ('../../conexion/conexion.php');
  
  $conexion = conectar();

  if (isset($_POST['oculto'])) {
    
    $autor_id = $_POST['autor_id'];
    $nombres = $_POST['nombres'];
    $ape_paterno = $_POST['ape_paterno'];
    $ape_materno = $_POST['ape_materno'];

    $query = $conexion->prepare("UPDATE autor SET nombres = ?, ape_paterno = ?,ape_materno = ? WHERE autor_id = ?");

    $query->bind_param("sssi", $nombres, $ape_paterno, $ape_materno, $autor_id);     

    $msg='';

    if ($query->execute()) {
      $msg = 'Autor Editado';
    }
    else{
      $msg = 'No se pudo editar al autor';
    }
  }

desconectar($conexion);

print_r($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Autor</title>
</head>
<body>
  <h1>Editar Autor</h1>
  <h3><?php echo $msg ?></h3>
  <a href="./autor.php">Regresar</a>
</body>
</html>