<?php
    namespace control;
    include('Usuario.php');
    $user = new Usuario();
    $username=$_POST['username'];

    if($user->destroy($username))
        echo '<div class="alert alert-success">Eliminado Correctamente</div>';
    else   
        echo '<div class="alert alert-warning">No se pudo realizar la eliminacion</div>';
?>
