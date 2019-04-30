<?php 
    namespace control;
    include('Proyect.php');
    $_id=$_POST['_id'];

    $proy = new Project();

    if( $proy::destroy($_id))
        echo "<div class='alert alert-warning'> <strong>Pago Eliminado Exitosamente</strong></div>";
    else
        echo "<div class='alert alert-danger'> El <strong>pago no se ha podido eliminar</strong></div>";
?>