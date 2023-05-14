<?php
  include ('../../conexion/conexion.php');

  $conexion = conectar();

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $conexion->prepare("SELECT libro.*, autor.nombres, autor.ape_paterno, autor.ape_materno
                                 FROM libro JOIN autor ON libro.autor_id = autor.autor_id WHERE libro.libro_id = ?");

    $query->bind_param("i", $id);

    $query->execute();

    $resultado = $query->get_result()->fetch_assoc();

    $msg='';

    if ($resultado) {
      $msg = 'libro Editado';
    }
    else{
      $msg = 'No se pudo editar el libro';
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
  <title>Editar Libro</title>
</head>
<body>
  <h1>Editar Libro</h1>
  <form method="post" action="../php/editar.php">
    <table>
      <tbody>

        <tr>
          <td>Titulo</td>
          <td>
            <input type="text" name="titulo" value="<?php echo $resultado['titulo']; ?>" required>
          </td>
        </tr>

        <tr>
          <td>Año</td>
          <td>
            <input type="text" name="anio" value="<?php echo $resultado['anio']; ?>" required>
          </td>
        </tr>

        <tr>
          <td>Especialidad</td>
          <td>
            <input type="text" name="especialidad" value="<?php echo $resultado['especialidad']; ?>">
          </td> 
        </tr>
        

        <tr>
          <td>Editorial</td>
          <td>
            <input type="text" name="editorial" value="<?php echo $resultado['editorial']; ?>">
          </td>
        </tr>

        <tr>
          <td>URL</td>
          <td>
            <input type="text" name="url" value="<?php echo $resultado['url']; ?>">
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="oculto">
            <input type="hidden" name="libro_id" value="<?php echo $resultado['libro_id']; ?>">
            <button type="submit">Guardar</button>
          </td>
        </tr>

      </tbody>
    </table>
  </form> 
</body>
</html>