<?php 
    namespace control;
    include('Employe.php');
    $_id=$_POST['_id'];

    $pay = new Employe();

    if( $pay::destroy($_id))
        echo "<div class='alert alert-warning'> <strong>Empleado Eliminado Exitosamente</strong></div>";
    else
        echo "<div class='alert alert-danger'> El <strong>Empleado no se ha podido eliminar</strong></div>";
?>