<?php
  include ('../../conexion/conexion.php');

  $conexion = conectar();

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $conexion->prepare("SELECT * FROM autor WHERE autor_id = ?");

    $query->bind_param("i", $id);

    $query->execute();

    $resultado = $query->get_result()->fetch_assoc();

    $msg='';

    if ($resultado) {
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
  <form action="../php/editar.php" method="POST">
    <table>
      <tbody>

        <tr>
          <td>Nombres</td>
          <td>
            <input type="text" name="nombres" maxlength="60" value="<?php echo $resultado['nombres']; ?>" required>
          </td>
        </tr>

        <tr>
          <td>Apellido Paterno</td>
          <td>
            <input type="text" name="ape_paterno" maxlength="40" value="<?php echo $resultado['ape_paterno']; ?>" required>
          </td>
        </tr>

        <tr>
          <td>Apellido Materno</td>
          <td>
            <input type="text" name="ape_materno" maxlength="40" value="<?php echo $resultado['ape_materno']; ?>">
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="oculto">
            <input type="hidden" name="autor_id" value="<?php echo $resultado['autor_id']; ?>">
            <button type="submit">Guardar</button>
          </td>
        </tr>

      </tbody>
    </table>
  </form>
</body>
</html>