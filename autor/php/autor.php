<?php

include('../../conexion/conexion.php');

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consultamos a la base de datos
$query = $conexion->prepare("SELECT * FROM autor");

$query->execute();

$resultado = $query->get_result();

// print_r($resultado);

// Cerramos la conexion a la base de datos
desconectar($conexion);
 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autor</title>
</head>
<body>
  <h1>Autores</h1>
  <a href="../html/agregar.html">Nuevo Autor</a>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>NOMBRES</th>
        <th>APELLIDO PATERNO</th>
        <th>APELLIDO MATERNO</th>
        <th>EDITAR</th>
        <th>ELIMINAR</th>
      </tr>
    </thead>
    <tbody>
      <?php
        //Recorremos el set de registros obtenidos
        while ($autor = $resultado->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $autor['autor_id'] . '</td>';
          echo '<td>' . $autor['nombres'] . '</td>';
          echo '<td>' . $autor['ape_paterno'] . '</td>';
          echo '<td>' . $autor['ape_materno'] . '</td>';
          echo '<td> <a href="../php/editar_autor.php?id=' . $autor['autor_id'] . '">Editar</a> </td>';
          echo '<td> <a href="../php/eliminar_autor.php?id=' . $autor['autor_id'] . '">Eliminar</a> </td>';
          echo '</tr>';
        }
      ?>
    </tbody>
  </table>
  <a href="/lab07">Regresar a las tablas</a>
</body>
</html>