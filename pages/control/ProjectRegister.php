<?php
    namespace control;
    
    include('Project.php');
    $project = new Project();
    
    if( $project->setProject($_POST))
        echo "<div class='alert alert-success'> <strong>Proyecto Registrado Exitosamente</strong></div>";
    else
        echo "<div class='alert alert-warning'> El <strong>proyecto no se ha registrado</strong></div>";