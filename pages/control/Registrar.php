<?php 
    namespace control;
    include('Usuario.php');
    $username=$_POST['usuario'];
    $pass=$_POST['contra'];
    $user = new Usuario();

    if( $user->SetUser($username,$pass))
        echo "<div class='alert alert-success'> <strong>Usuario Registrado Exitosamente</strong></div>";
    else
        echo "<div class='alert alert-warning'> Es posible que el <strong>Usuario ya exista</strong></div>";
?>
