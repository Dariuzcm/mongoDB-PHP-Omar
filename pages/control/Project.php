<?php
namespace control;
include 'connection.php';
class Project
{

    public function findPattern($pattern)
    {
        $con = new Conexion();
        $collectionPayment = $con->getProject();
        $regex = $con->regex($pattern);
        $result = $collectionPayment->find(array(
            '$or' => array(
                ["proyect_name" => $regex],
                ["client_name" => $regex],
                ["manager_name" => $regex],
            ),
        ));
        return $result;
    }

    private function register($json)
    {
        $con = new Conexion();
        $collectionProjects = $con->getProject();
        try {
            $collectionProjects->insertOne($json);
        } catch (\MongoDB\Driver\Exception\Exception $e) {
            return false;
        }
        return true;
    }

    public function setProject($data)
    {
        print_r($data);
        $json = [
            "proyect_name" => $data['proyect_name'],
            "begin_date" => $data['begin_date'],
            "end_date" => $data['end_date'],
            "manager_name" => $data['manager_name'],
            "client_name" => $data['client_name'],
        ];
        return $this->register($json);
    }
    public function findPayment($json)
    {
        $con = new Conexion();
        $collectionProjects = $con->getProject();
        $result = $collectionProjects::find($json);
        return $result;
    }
    public function findProyectByID($ID)
    {
        $con = new Conexion();
        $collectionProjects = $con->getProject();
        $result = $collectionProjects->find(["_id" => $ID]);

        return $result;
    }

    public function update($data)
    {
        
        $con = new Conexion();
        $collectionProjects = $con->getProject();
        try {
            print_r($data);
            $collectionProjects->replaceOne(
                ['_id' =>new \MongoDB\BSON\ObjectId($data['_id'])],
                [
                    'proyect_name'=>$data['proyect_name'],
                    'begin_date'=>$data['begin_date'],
                    'end_date'=>$data['end_date'],
                    'manager_name'=>$data['manager_name'],
                    'client_name'=>$data['client_name']
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
        $collectionProjects = $con->getProject();
        try {
                $collectionProjects->deleteOne( 
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
$collectionProjects = $con->getProject();
$result = $collectionProjects->find(["username.name"=>$username]);
foreach($result as $us){
$pass_v=password_verify($pass, $us['pass']);
return $pass_v;
}
}*/
    //------------------------------FINAL---------------------------//
}
