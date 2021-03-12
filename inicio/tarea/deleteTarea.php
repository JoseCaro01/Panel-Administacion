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

$database->delete("tareas", [ "cod_tareas" => $_GET['idTarea']]);

header('Location: tarea.php?value=0');

?>