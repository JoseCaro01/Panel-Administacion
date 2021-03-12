<?php 

require_once '../../Medoo.php';

use Medoo\Medoo;    

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'panel',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);

$resultado=$database->delete("asignatura", [ "cod_asignatura" => $_GET['idAsig']]);



if($resultado->rowCount()==1){
    header('Location: asignatura.php?value=0');
}else {
    header('Location: asignatura.php?value=1');
}




?>