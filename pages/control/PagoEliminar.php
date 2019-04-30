<?php 
    namespace control;
    include('Payment.php');
    $_id=$_POST['_id'];

    $pay = new Payment();

    if( $pay::destroy($_id))
        echo "<div class='alert alert-warning'> <strong>Pago Eliminado Exitosamente</strong></div>";
    else
        echo "<div class='alert alert-danger'> El <strong>pago no se ha podido eliminar</strong></div>";
?>