<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $agenciaError = null;
        $numError = null;
        $nombreError = null;
        $fechaOpeError = null;
        $fechaPagError = null;
        $montoPreError = null;
        
         
        // keep track post values
        $agencia = $_POST['agencia'];
        $num = $_POST['num'];
        $nombre = $_POST['nombre'];
        $fechaOpe = $_POST['fechaOpe'];
        $fechaPag = $_POST['fechaPag'];
        $monto = $_POST['monto'];
        
        /*$fechaFinalContrato = $_POST['fechaFinalContrato'];*/
        /*$estatus = $_POST['estatus'];*/
         
        // validate input
        $valid = true;
        if (empty($agencia)) {
            $agenciaError = 'Ingresa Agencia';
            $valid = false;
        }
         
        if (empty($num)) {
            $numError = 'Ingresa Num';
            $valid = false;
        }
         
        if (empty($nombre)) {
            $nombreError = 'Ingresa Colonia';
            $valid = false;
        }

        if (empty($fechaOpe)) {
            $fechaOpeError = 'Ingresa Calle';
            $valid = false;
        }
        if (empty($fechaPag)) {
            $fechaPagError = 'Ingresa Telefono';
            $valid = false;
        }
         if (empty($monto)) {
            $montoPreError = 'Ingresa Cantidad prestamo';
            $valid = false;
        }
       
       /* if (empty($fechaFinalContrato)) {
            $fechaFinalContratoError = 'Ingresa Final Contrato';
            $valid = false;
        }
        if (empty($estatus)) {
            $estatusError = 'Ingresa el estatus';
            $valid = false;
        }*/
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO morosos (agencia, num_cliente, nombre, fecha_operativa, fecha_pago, monto) values(?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($agencia,$num,$nombre,$fechaOpe,$fechaPag,$monto));
            Database::disconnect();
            
            header("Location: morosos.php");
        }
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
                        <h3>Crear Cliente Moroso</h3>
                    </div>
             
                    <form class="form-horizontal" action="crearmoro.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Agencia</label>
                        <div class="controls">
                            <input name="agencia" type="text"  placeholder="Agencia" value="<?php echo !empty($agencia)?$agencia:'';?>">
                            <?php if (!empty($agenciaError)): ?>
                                <span class="help-inline"><?php echo $agenciaError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($numError)?'error':'';?>">
                        <label class="control-label">Numero Cliente</label>
                        <div class="controls">
                            <input name="num" type="text" placeholder="Numero Cliente" value="<?php echo !empty($num)?$num:'';?>">
                            <?php if (!empty($numError)): ?>
                                <span class="help-inline"><?php echo $numError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="nombre" type="text"  placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
                            <?php if (!empty($nombreError)): ?>
                                <span class="help-inline"><?php echo $nombreError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($calleError)?'error':'';?>">
                        <label class="control-label">Fecha Operativa</label>
                        <div class="controls">
                            <input name="fechaOpe" type="text"  placeholder="YYYY-MM-DD" value="<?php echo !empty($fechaOpe)?$calle:'';?>">
                            <?php if (!empty($fechaOpeError)): ?>
                                <span class="help-inline"><?php echo $fechaOpeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($fechaPagError)?'error':'';?>">
                        <label class="control-label">Fecha Pago</label>
                        <div class="controls">
                            <input name="fechaPag" type="text"  placeholder="YYYY-MM-DD" value="<?php echo !empty($fechaPag)?$fechaPag:'';?>">
                            <?php if (!empty($fechaPagError)): ?>
                                <span class="help-inline"><?php echo $fechaPagError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($montoError)?'error':'';?>">
                        <label class="control-label">Montos</label>
                        <div class="controls">
                            <input name="monto" type="text"  placeholder="Montos" value="<?php echo !empty($monto)?$monto:'';?>">
                            <?php if (!empty($montoPreError)): ?>
                                <span class="help-inline"><?php echo $montoPreError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="morosos.php">Regresar</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>