<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $agenciaError = null;
        $nombreError = null;
        $coloniaError = null;
        $calleError = null;
        $telefonoError = null;
        $cantidadPreError = null;
        $fechaError = null;
        $fechaFinalContratoError = null;
        $estatusError = null;
         
        // keep track post values
        $agencia = $_POST['agencia'];
        $nombre = $_POST['nombre'];
        $colonia = $_POST['colonia'];
        $calle = $_POST['calle'];
        $telefono = $_POST['telefono'];
        $cantidadPre = $_POST['cantidadPre'];
        $fecha = $_POST['fechaf'];
        /*$fechaFinalContrato = $_POST['fechaFinalContrato'];*/
        /*$estatus = $_POST['estatus'];*/
         
        // validate input
        $valid = true;
        if (empty($agencia)) {
            $nombreError = 'Ingresa Agencia';
            $valid = false;
        }
         
        if (empty($nombre)) {
            $nombreError = 'Ingresa Nombre';
            $valid = false;
        }
         
        if (empty($colonia)) {
            $coloniaError = 'Ingresa Colonia';
            $valid = false;
        }

        if (empty($calle)) {
            $calleError = 'Ingresa Calle';
            $valid = false;
        }
        if (empty($telefono)) {
            $telefonoError = 'Ingresa Telefono';
            $valid = false;
        }
         if (empty($cantidadPre)) {
            $cantidadPreError = 'Ingresa Cantidad prestamo';
            $valid = false;
        }
        if (empty($fecha)) {
            $tarifaError = 'Ingresa tarifa semanal';
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
            $fecha = date($_POST['fechaf']);
            $semana4=0;
            if (isset($_POST['semana1'])){
                $semana1 = strtotime ( '+91 day' , strtotime ( $fecha ) ) ;
                $semana1 = date ( 'Y-m-j' , $semana1 );
                $semana4 = $semana1;
                $estatus = "credito vigente";
            }
            if (isset($_REQUEST['semana2'])){
                $semana2 = strtotime ( '+161 day' , strtotime ( $fecha ) ) ;
                $semana2 = date ( 'Y-m-j' , $semana2 );
                $semana4 = $semana2;
                $estatus = "credito vigente";
            }
            if (isset($_REQUEST['semana3'])){
                $semana3 = strtotime ( '+266 day' , strtotime ( $fecha ) ) ;
                $semana3 = date ( 'Y-m-j' , $semana3 );
                $semana4 = $semana3;
                $estatus = "credito vigente";
            }
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO registro (agencia, nombre, colonia, calle, telefono, cantidad_prestamos, fecha_pago_programada, fecha_final_contrato, estatus) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($agencia,$nombre,$colonia,$calle,$telefono,$cantidadPre,$fecha,$semana4,$estatus ));
            Database::disconnect();
            
            header("Location: index.php");
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
                        <h3>Crear Registro</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Agencia</label>
                        <div class="controls">
                            <input name="agencia" type="text"  placeholder="Agencia" value="<?php echo !empty($agencia)?$agencia:'';?>">
                            <?php if (!empty($agenciaError)): ?>
                                <span class="help-inline"><?php echo $agenciaError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="nombre" type="text" placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
                            <?php if (!empty($nombreError)): ?>
                                <span class="help-inline"><?php echo $nombreError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($coloniaError)?'error':'';?>">
                        <label class="control-label">Colonia</label>
                        <div class="controls">
                            <input name="colonia" type="text"  placeholder="Colonia" value="<?php echo !empty($colonia)?$colonia:'';?>">
                            <?php if (!empty($coloniaError)): ?>
                                <span class="help-inline"><?php echo $coloniaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($calleError)?'error':'';?>">
                        <label class="control-label">Calle</label>
                        <div class="controls">
                            <input name="calle" type="text"  placeholder="Calle" value="<?php echo !empty($calle)?$calle:'';?>">
                            <?php if (!empty($calleError)): ?>
                                <span class="help-inline"><?php echo $calleError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($telefonoError)?'error':'';?>">
                        <label class="control-label">Telefono</label>
                        <div class="controls">
                            <input name="telefono" type="text"  placeholder="Telefono" value="<?php echo !empty($telefono)?$telefono:'';?>">
                            <?php if (!empty($telefonoError)): ?>
                                <span class="help-inline"><?php echo $telefonoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($cantidadPreError)?'error':'';?>">
                        <label class="control-label">Cantidad Prestamos</label>
                        <div class="controls">
                            <input name="cantidadPre" type="text"  placeholder="Cantidad Prestamos" value="<?php echo !empty($cantidadPre)?$cantidadPre:'';?>">
                            <?php if (!empty($cantidadPreError)): ?>
                                <span class="help-inline"><?php echo $cantidadPreError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($fechaError)?'error':'';?>">
                        <label class="control-label">Fecha</label>
                        <div class="controls">
                            <input name="fechaf" type="text"  placeholder="yyyy-mm-dd" value="<?php echo !empty($fecha)?$fecha:'';?>">
                            <?php if (!empty($fechaError)): ?>
                                <span class="help-inline"><?php echo $fechaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($fechaFinalContratoError)?'error':'';?>">
                        <label class="control-label">Fecha Final Contrato</label>
                        <div class="controls">
                            <input name="semana1" type="checkbox"  value="semana1">14 Semanas <br>
                             <input name="semana2" type="checkbox"  value="semana2">24 Semanas <br>
                              <input name="semana3" type="checkbox"  value="semana3">39 Semanas <br>
                            <!-- <?php if (!empty($fechaFinalContratoError)): ?>
                                <span class="help-inline"><?php echo $fechaFinalContratoError;?></span>
                            <?php endif;?> -->
                        </div>
                      </div>
                      <!-- <div class="control-group <?php echo !empty($estatusError)?'error':'';?>">
                        <label class="control-label">Estatus</label>
                        <div class="controls">
                            <input name="estatus" type="text"  placeholder="Estatus" value="<?php echo !empty($estatus)?$estatus:'';?>">
                            <?php if (!empty($estatusError)): ?>
                                <span class="help-inline"><?php echo $estatusError;?></span>
                            <?php endif;?>
                        </div>
                      </div> -->
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Regresar</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html><?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $agenciaError = null;
        $nombreError = null;
        $coloniaError = null;
        $calleError = null;
        $telefonoError = null;
        $cantidadPreError = null;
        $tarifaError = null;
        $fechaFinalContratoError = null;
        $estatusError = null;
         
        // keep track post values
        $agencia = $_POST['agencia'];
        $nombre = $_POST['nombre'];
        $colonia = $_POST['colonia'];
        $calle = $_POST['calle'];
        $telefono = $_POST['telefono'];
        $cantidadPre = $_POST['cantidadPre'];
        $tarifa = $_POST['tarifa'];
        $fechaFinalContrato = $_POST['fechaFinalContrato'];
        $estatus = $_POST['estatus'];
         
        // validate input
        $valid = true;
        if (empty($agencia)) {
            $nombreError = 'Ingresa Agencia';
            $valid = false;
        }
         
        if (empty($nombre)) {
            $nombreError = 'Ingresa Nombre';
            $valid = false;
        }
         
        if (empty($colonia)) {
            $coloniaError = 'Ingresa Colonia';
            $valid = false;
        }

        if (empty($calle)) {
            $calleError = 'Ingresa Calle';
            $valid = false;
        }
        if (empty($telefono)) {
            $telefonoError = 'Ingresa Telefono';
            $valid = false;
        }
         if (empty($cantidadPre)) {
            $cantidadPreError = 'Ingresa Cantidad prestamo';
            $valid = false;
        }
        if (empty($tarifa)) {
            $tarifaError = 'Ingresa tarifa semanal';
            $valid = false;
        }
        if (empty($fechaFinalContrato)) {
            $fechaFinalContratoError = 'Ingresa Final Contrato';
            $valid = false;
        }
        if (empty($estatus)) {
            $estatusError = 'Ingresa el estatus';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO registro (agencia, nombre, colonia, calle, telefono, cantidad_prestamos, tarifa_semanal, fecha_final_contrato, estatus) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($agencia,$nombre,$colonia,$calle,$telefono,$cantidadPre,$tarifa,$fechaFinalContrato,$estatus ));
            Database::disconnect();
            
            header("Location: index.php");
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
                        <h3>Crear Registro</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Agencia</label>
                        <div class="controls">
                            <input name="agencia" type="text"  placeholder="Agencia" value="<?php echo !empty($agencia)?$agencia:'';?>">
                            <?php if (!empty($agenciaError)): ?>
                                <span class="help-inline"><?php echo $agenciaError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="nombre" type="text" placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
                            <?php if (!empty($nombreError)): ?>
                                <span class="help-inline"><?php echo $nombreError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($coloniaError)?'error':'';?>">
                        <label class="control-label">Colonia</label>
                        <div class="controls">
                            <input name="colonia" type="text"  placeholder="Colonia" value="<?php echo !empty($colonia)?$colonia:'';?>">
                            <?php if (!empty($coloniaError)): ?>
                                <span class="help-inline"><?php echo $coloniaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($calleError)?'error':'';?>">
                        <label class="control-label">Calle</label>
                        <div class="controls">
                            <input name="calle" type="text"  placeholder="Calle" value="<?php echo !empty($calle)?$calle:'';?>">
                            <?php if (!empty($calleError)): ?>
                                <span class="help-inline"><?php echo $calleError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($telefonoError)?'error':'';?>">
                        <label class="control-label">Telefono</label>
                        <div class="controls">
                            <input name="telefono" type="text"  placeholder="Telefono" value="<?php echo !empty($telefono)?$telefono:'';?>">
                            <?php if (!empty($telefonoError)): ?>
                                <span class="help-inline"><?php echo $telefonoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($cantidadPreError)?'error':'';?>">
                        <label class="control-label">Cantidad Prestamos</label>
                        <div class="controls">
                            <input name="cantidadPre" type="text"  placeholder="Cantidad Prestamos" value="<?php echo !empty($cantidadPre)?$cantidadPre:'';?>">
                            <?php if (!empty($cantidadPreError)): ?>
                                <span class="help-inline"><?php echo $cantidadPreError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($tarifaError)?'error':'';?>">
                        <label class="control-label">Tarifa Semanal</label>
                        <div class="controls">
                            <input name="tarifa" type="number"  placeholder="Tarifa Semanal" value="<?php echo !empty($tarifa)?$tarifa:'';?>">
                            <?php if (!empty($tarifaError)): ?>
                                <span class="help-inline"><?php echo $tarifaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($fechaFinalContratoError)?'error':'';?>">
                        <label class="control-label">Fecha Final Contrato</label>
                        <div class="controls">
                            <input name="fechaFinalContrato" type="date"  placeholder="Fecha Final Contrato" value="<?php echo !empty($fechaFinalContrato)?$fechaFinalContrato:'';?>">
                            <?php if (!empty($fechaFinalContratoError)): ?>
                                <span class="help-inline"><?php echo $fechaFinalContratoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($estatusError)?'error':'';?>">
                        <label class="control-label">Estatus</label>
                        <div class="controls">
                            <input name="estatus" type="text"  placeholder="Estatus" value="<?php echo !empty($estatus)?$estatus:'';?>">
                            <?php if (!empty($estatusError)): ?>
                                <span class="help-inline"><?php echo $estatusError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Regresar</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>