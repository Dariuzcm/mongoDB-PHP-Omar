<?php 
    namespace control;
    include('Project.php');
    $proy = new Project();

    if( $proy->update($_POST))
        echo "<div class='alert alert-success'> <strong>Empleado Registrado Exitosamente</strong></div>";
    else
        echo "<div class='alert alert-warning'> El <strong>Empleado no se ha registrado</strong></div>";
?>