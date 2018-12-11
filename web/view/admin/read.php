<?php
     require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT id, agencia, nombre, colonia, calle, telefono, tarifa_semanal, fecha_final_contrato, estatus FROM registro where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        
    }
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link   href="../../css/bootstrap.min.css" rel="stylesheet">
    <script src="../../js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Leer Registros</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Agencia</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['agencia'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['nombre'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Colonia</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['colonia'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Calle</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['calle'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">telefono</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['telefono'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Tarifa Semanal</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['tarifa_semanal'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Fecha Final Contrato</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['fecha_final_contrato'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Estatus</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['estatus'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="index.php">Regresar</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>