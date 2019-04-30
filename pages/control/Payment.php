<?php
namespace control;

include 'connection.php';
class Payment
{
    protected $fecha;
    protected $emisor;
    protected $receptor;
    protected $cantidad;
    protected $motivo;

    public function findPattern($pattern)
    {
        $con = new Conexion();
        $collectionPayment = $con->getPagos();
        $regex = $con->regex($pattern);
        $result = $collectionPayment->find(array(
            '$or' => array(
                ["receptor" => $regex],
                ["emisor" => $regex],
                ["cantidad" => $regex],
            ),
        ));
        return $result;
    }

    private function register($json)
    {
        $con = new Conexion();
        $collectionPayments = $con->getPagos();
        try {
            $collectionPayments->insertOne($json);
        } catch (\MongoDB\Driver\Exception\Exception $e) {
            return false;
        }
        return true;
    }

    public function setPayment($fecha, $emisor, $receptor, $cantidad, $motivo)
    {
        $this->fecha = $fecha;
        $this->emisor = $emisor;
        $this->receptor = $receptor;
        $this->cantidad = $cantidad;
        $this->motivo = $motivo;
        $json = [
            "fecha" => $this->fecha,
            "emisor" => $this->emisor,
            "receptor" => $this->receptor,
            "cantidad" => $this->cantidad,
            "motivo" => $this->motivo,
        ];
        return $this->register($json);
    }
    public function findPayment($json)
    {
        $con = new Conexion();
        $collectionPayments = $con->getPagos();
        $result = $collectionPayments::find($json);
        return $result;
    }
    public function findPaymentByID($ID)
    {
        $con = new Conexion();
        $collectionPayments = $con->getPagos();
        $result = $collectionPayments->find(["_id" => $ID]);

        return $result;
    }

    public function update($fecha,$emisor,$receptor,$cantidad,$motivo,$_id)
    {

        $con = new Conexion();
        $collectionPayments = $con->getPagos();
        try {

            $collectionPayments->replaceOne(
                ['_id' =>new \MongoDB\BSON\ObjectId($_id)],
                [
                    "fecha" => $fecha,
                    "emisor" => $emisor,
                    "receptor" => $receptor,
                    "cantidad" => $cantidad,
                    "motivo" => $motivo,
                ]
            );

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function destroy($_id)
    {
        $con = new Conexion();
        $collectionPayments = $con->getPagos();
        try {
                $collectionPayments->deleteOne( 
                    ['_id' =>new \MongoDB\BSON\ObjectId($_id)]
            ); 
            
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }

        return true;
    }
/*
public function login($username, $pass){
$con = new Conexion();
$collectionPayments = $con->getPagos();
$result = $collectionPayments->find(["username.name"=>$username]);
foreach($result as $us){
$pass_v=password_verify($pass, $us['pass']);
return $pass_v;
}
}*/
    //------------------------------FINAL---------------------------//
}
