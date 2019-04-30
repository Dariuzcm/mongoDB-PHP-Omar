<?php 
    namespace control;
    include('Employe.php');
    
    $pay = new Employe();


    if( $pay->update($_POST))
        echo "<div class='alert alert-success'> <strong>Empleado Actualizadp Exitosamente</strong></div>";
    else
        echo "<div class='alert alert-warning'> El <strong>no no se ha registrado</strong></div>";
?>