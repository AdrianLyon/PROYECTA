<?php
  // Se prendio esta mrd :v
  session_start();

  // Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
  if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 2){
    /*
      Para redireccionar en php se utiliza header,
      pero al ser datos enviados por cabereza debe ejecutarse
      antes de mostrar cualquier informacion en el DOM es por eso que inserto este
      codigo antes de la estructura del html, espero haber sido claro
    */
   header('location: controller/redirec.php');
   header("Content-Type: text/html;charset=utf-8");
  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>
<body>
  <h1>Hola usuario <?php echo ucfirst($_SESSION['nombre']); ?></h1> 
    <a href="../../controller/cerrarSesion.php">
      <button type="button" name="button" class="btn btn-default">Cerrar sesion</button>
      <a class="btn" href="index.php">Regresar</a>
    </a>
  <div class="container">
    <div class="row">
      <H3>Clientes Morosos</H3>
    </div>
    <div class="row">
       <form method="POST" action="bucarmoro.php" onSubmit="return validarForm(this)">
        <a href="crearmoro.php" class="btn btn-success">Agregar cliente morosos</a>
      <input type="text" placeholder="Buscar por nombre" name="palabra" required="">
      <button type="submit" value = "Buscar" name="buscar"><i class="btn" >Buscar</i></button>
    </form>
    </div>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Agencia</th>
            <th>Numero Cliente</th>
            <th>Nombre</th>
            <th>Fecha Operativa</th>
            <th>Fecha Pago</th>
            <th>Monto</th>
          </tr>
        </thead>
        <?php 
          include 'database.php';
          $pdo = Database::connect();
          $sql = 'SELECT agencia, num_cliente, nombre, fecha_operativa, fecha_pago, monto, id FROM morosos ORDER BY id DESC';
          foreach ($pdo->query($sql) as $row){
            echo '<tr>';
                        echo '<td>'. $row['agencia'] . '</td>';
                        echo '<td>'. $row['num_cliente'] . '</td>';
                        echo '<td>'. $row['nombre'] . '</td>';
                        echo '<td>'. $row['fecha_operativa'] . '</td>';
                        echo '<td>'. $row['fecha_pago'] . '</td>';
                        echo '<td>'. $row['monto'] . '</td>';
                
                        /*echo '<td width=200>';
                                /*echo '<a class="btn" href="read.php?id='.$row['id'].'">Ver</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Modificar</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Borrar</a>';
                                echo '</td>';
                        echo '</tr>';*/
          }
          Database::disconnect();
          
        ?>
        </tbody>
      </table>
    </div>
    
  </div>
</body>
</html>