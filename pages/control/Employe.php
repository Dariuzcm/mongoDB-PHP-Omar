<?php
namespace control;

include 'connection.php';
class Employe
{

    public function findPattern($pattern)
    {
        $con = new Conexion();
        $collectionEmploye = $con->getEmployes();
        $regex = $con->regex($pattern);
        $result = $collectionEmploye->find(array(
            '$or' => array(
                ["nombre" => $regex],
                ["apellido" => $regex],
                ['_id'=>$regex]
            ),
        ));
        return $result;
    }

    private function register($json)
    {
        $con = new Conexion();
        $collectionEmployes = $con->getEmployes();
        try {
            $collectionEmployes->insertOne($json);
        } catch (\MongoDB\Driver\Exception\Exception $e) {
            return false;
        }
        return true;
    }

    public function setEmploye($data)
    {
        return $this->register($data);
    }
    public function findEmploye($json)
    {
        $con = new Conexion();
        $collectionEmployes = $con->getEmployes();
        $result = $collectionEmployes::find($json);
        return $result;
    }
    public function findEmployeByID($ID)
    {
        $con = new Conexion();
        $collectionEmployes = $con->getEmployes();
        $result = $collectionEmployes->find(["_id" => $ID]);

        return $result;
    }

    public function update($data)
    {

        $con = new Conexion();
        $collectionEmployes = $con->getEmployes();
        try {

            $collectionEmployes->replaceOne(
                ['_id' =>new \MongoDB\BSON\ObjectId($data['_id']),
                [
                    "nombre" => $data['nombre'],
                    "apellido" => $data['apellido'],
                    "telefono" => $data]['telefono'],
                    "email" => $data['email'],
                    "fecha_nac" => $data['fecha_nac'],
                    "fecha_in" => $data['fecha_in'],
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
        $collectionEmployes = $con->getEmployes();
        try {
                $collectionEmployes->deleteOne( 
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
$collectionEmployes = $con->getEmployes();
$result = $collectionEmployes->find(["username.name"=>$username]);
foreach($result as $us){
$pass_v=password_verify($pass, $us['pass']);
return $pass_v;
}
}*/
    //------------------------------FINAL---------------------------//
}
