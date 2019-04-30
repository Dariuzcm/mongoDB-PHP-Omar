<?php
    namespace control;
    include('Usuario.php');
    $oldname=$_POST['oldname'];
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    
    if($_POST['priv']==="true")
    $privilage=true;
    else
    $privilage=false;
    
    $user = new Usuario();
    
    $NewJson=['name'=>$username,'pass'=> $pass,'privilage'=>$privilage];

    if($user->update($oldname,$NewJson))
        echo '<div class="alert alert-success">Cambios Realizados</div>';
    else
        echo '<div class="alert alert-warning">Algo va mal no se pudo realizar el Cambio</div>';
?>