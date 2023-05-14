<?php

include('../../conexion/conexion.php');

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consultamos a la base de datos
$query = $conexion->prepare("SELECT *, autor.nombres FROM libro JOIN autor on libro.autor_id = autor.autor_id");

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
  <title>Libros</title>
</head>
<body>
  <h1>Libros</h1>
  <a href="../html/agregar.html">Nuevo Libro</a>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>TITULO</th>
        <th>AUTOR</th>
        <th>AÑO</th>
        <th>ESPECIALIDAD</th>
        <th>EDITORIAL</th>
        <th>URL</th>
        <th>EDITAR</th>
        <th>ELIMINAR</th>
      </tr>
    </thead>
    <tbody>
      <?php
        //Recorremos el set de registros obtenidos
        while ($libro = $resultado->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $libro['libro_id'] . '</td>';
          echo '<td>' . $libro['titulo'] . '</td>';
          echo '<td>' . $libro['nombres'] . ' ' . $libro['ape_paterno'] . ' ' . $libro['ape_materno'] .'</td>';
          echo '<td>' . $libro['anio'] . '</td>';
          echo '<td>' . $libro['especialidad'] . '</td>';
          echo '<td>' . $libro['editorial'] . '</td>';
          echo '<td>' . $libro['url'] . '</td>';
          echo '<td> <a href="./editar_libro.php?id=' . $libro['libro_id'] . '">Editar</a> </td>';
          echo '<td> <a href="./eliminar_libro.php?id=' . $libro['libro_id'] . '">Eliminar</a> </td>';
          echo '</tr>';
        }
      ?>

        <a href="./editar_libro.php"></a>

    </tbody>
  </table>
  <a href="/lab07">Regresar a las tablas</a>
</body>
</html>