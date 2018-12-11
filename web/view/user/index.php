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
  <h1>Hola estandar <?php echo ucfirst($_SESSION['nombre']); ?></h1> 
    <a href="../../controller/cerrarSesion.php">
      <button type="button" name="button" class="btn btn-default">Cerrar sesion</button>
    </a>
  <div class="container">
    <div class="row">
      <H3>Proyecta Servicio Financieros</H3>
    </div>
    <div class="row">
      <p>
          <a href="create.php" class="btn btn-success">Agregar</a>
          <a href="morosos.php" class="btn">Clientes Morosos</a>
      </p>
       <form method="POST" action="busquedad.php" onSubmit="return validarForm(this)">
      <input type="text" placeholder="Buscar por nombre" name="palabra" required="">
      <button type="submit" value = "Buscar" name="buscar"><i class="btn" >Buscar</i></button>
    </form>
    </div>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Agencia</th>
            <th>Nombre</th>
            <th>Colonia</th>
            <th>Calle</th>
            <th>Telefono</th>
            <th>Cantidad Prestamo</th>
            <th>Fecha Pago Programada</th>
            <th>Fecha F. Contrato</th>
            <th>Estatus</th>
          </tr>
        </thead>
        <?php 
          include 'database.php';
          $pdo = Database::connect();
          $sql = 'SELECT agencia, nombre, colonia, calle, telefono, cantidad_prestamos, fecha_pago_programada, fecha_final_contrato, estatus, id FROM registro WHERE cantidad_prestamos BETWEEN 1000 AND 20000 ORDER BY id DESC';
          foreach ($pdo->query($sql) as $row){
            echo '<tr>';
                        echo '<td>'. $row['agencia'] . '</td>';
                        echo '<td>'. $row['nombre'] . '</td>';
                        echo '<td>'. $row['colonia'] . '</td>';
                        echo '<td>'. $row['calle'] . '</td>';
                        echo '<td>'. $row['telefono'] . '</td>';
                        echo '<td>'. $row['cantidad_prestamos'] . '</td>';
                        echo '<td>'. $row['fecha_pago_programada'] . '</td>';
                        echo '<td>'. $row['fecha_final_contrato'] . '</td>';
                        echo '<td>'. $row['estatus'] . '</td>';
                        
          }
          Database::disconnect();
          
        ?>
        </tbody>
      </table>
    </div>
    
  </div>
</body>
</html>