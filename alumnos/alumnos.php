<?php
include('..//conexion/conexion.php');

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consultamos a la base de datos
$query = $conexion->prepare("SELECT * FROM alumno");

$query->execute();

$resultado = $query->get_result();

// Cerramos la conexion a la base de datos
desconectar($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumnos</title>
</head>
<body>
  <h1>Alumnos</h1>
  <a href="/autor/html/agregar.html">Nuevo Alumno</a>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>NOMBRES</th>
        <th>APELLIDO PATERNO</th>
        <th>APELLIDO MATERNO</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
        //Recorremos el set de registros obtenidos
        while ($alumno = $resultado->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $alumno['autor_id'] . '</td>';
          echo '<td>' . $alumno['nombres'] . '</td>';
          echo '<td>' . $alumno['ape_paterno'] . '</td>';
          echo '<td>' . $alumno['ape_materno'] . '</td>';
          echo '<td><a href="#">Editar</a> | <a href="#">Eliminar</a></td>';
          echo '</tr>';
        }
      ?>
    </tbody>
  </table>
</body>
</html>