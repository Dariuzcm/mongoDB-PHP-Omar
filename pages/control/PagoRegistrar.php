<?php 
    namespace control;
    include('Payment.php');
    $fecha=$_POST['fecha'];
    $emisor=$_POST['emisor'];
    $receptor=$_POST['receptor'];
    $cantidad=$_POST['cantidad'];
    $motivo=$_POST['motivo'];

    $pay = new Payment();

    if( $pay->setPayment($fecha,$emisor,$receptor,$cantidad,$motivo))
        echo "<div class='alert alert-success'> <strong>Pago Registrado Exitosamente</strong></div>";
    else
        echo "<div class='alert alert-warning'> El <strong>pago no se ha registrado</strong></div>";
?>