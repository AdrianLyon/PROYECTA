<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $agenciaError = null;
        $nombreError = null;
        $coloniaError = null;
        $calleError = null;
        $telefonoError = null;
        $tarifaError = null;
        $fechaFinalContratoError = null;
        $estatusError = null;
         
        // keep track post values
        $agencia = $_POST['agencia'];
        $nombre = $_POST['nombre'];
        $colonia = $_POST['colonia'];
        $calle = $_POST['calle'];
        $telefono = $_POST['telefono'];
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
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE registro  set agencia = ?, nombre = ?, colonia = ?, calle = ?, telefono = ?, tarifa_semanal = ?, fecha_final_contrato = ?, estatus = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($agencia, $nombre,$colonia,$calle,$telefono,$tarifa,$fechaFinalContrato,$estatus,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT agencia, nombre, colonia, calle, telefono, tarifa_semanal, fecha_final_contrato, estatus FROM registro WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $agencia = $data['agencia'];
        $nombre = $data['nombre'];
        $colonia = $data['colonia'];
        $calle = $data['calle'];
        $telefono = $data['telefono'];
        $tarifa = $data['tarifa_semanal'];
        $fechaFinalContrato = $data['fecha_final_contrato'];
        $estatus = $data['estatus'];
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
                        <h3>Modificar Registros</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($agenciaError)?'error':'';?>">
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
                      <div class="control-group <?php echo !empty($tarifaError)?'error':'';?>">
                        <label class="control-label">Tarifa</label>
                        <div class="controls">
                            <input name="tarifa" type="number"  placeholder="Tarifa" value="<?php echo !empty($tarifa)?$tarifa:'';?>">
                            <?php if (!empty($tarifaError)): ?>
                                <span class="help-inline"><?php echo $tarifaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($fechaFinalContratoError)?'error':'';?>">
                        <label class="control-label">Fecha Final Contrato</label>
                        <div class="controls">
                            <input name="fechaFinalContrato" type="text"  placeholder="Fecha Final Contrato" value="<?php echo !empty($fechaFinalContrato)?$fechaFinalContrato:'';?>">
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
                          <button type="submit" class="btn btn-success">Modificar</button>
                          <a class="btn" href="index.php">Regresar</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>