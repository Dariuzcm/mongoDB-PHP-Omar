<?php 
namespace control;
include('Usuario.php');

$user=$_POST['user'];
$pass=$_POST['pass'];
$us_control= new Usuario();

if($us_control->login($user,$pass)){
    session_start([
        'cookie_lifetime' => 86400,
    ]);
    $temp = $us_control->findUser(['username.name'=>$user]);
    foreach($temp as $temp){
    $_SESSION['username']= $temp->username->name;
    $_SESSION['privilage']=$temp->privilage;
    }
    echo '<div id="result" role="success" class="alert alert-success"> Usuario correcto, espera un momento...</div>';
}
else   
    echo '<div id="result" role="danger" class="alert alert-danger"> Usuario Incorrecto no coinciden</div>';


?>