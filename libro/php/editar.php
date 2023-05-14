<?php
  include ('../../conexion/conexion.php');
  
  $conexion = conectar();

  if (isset($_POST['oculto'])) {
    
    $libro_id = $_POST['libro_id'];
    $titulo = $_POST['titulo'];
    $anio = $_POST['anio'];
    $especialidad = $_POST['especialidad'];
    $editorial = $_POST['editorial'];
    $url = $_POST['url'];

    $query = $conexion->prepare("UPDATE libro SET titulo = ?, anio = ?, especialidad = ?, editorial = ?, url = ? WHERE libro_id = ?");

    $query->bind_param("sssssi", $titulo, $anio, $especialidad, $editorial, $url, $libro_id);     

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
  <a href="./libro.php">Regresar</a>
</body>
</html>