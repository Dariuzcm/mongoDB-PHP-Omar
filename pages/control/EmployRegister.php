<?php 
    namespace control;
    include('Employ.php');

    $emp = new Employe();

    if( $pay->setEmploye($_POST))
        echo "<div class='alert alert-success'> <strong>Empleado Registrado Exitosamente</strong></div>";
    else
        echo "<div class='alert alert-warning'> El <strong>empleado no se ha registrado</strong></div>";
?>