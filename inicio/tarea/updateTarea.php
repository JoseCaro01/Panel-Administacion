<?php
session_start();

$descripcion=trim($_POST['descripcion']);
$estado=trim($_POST["estado"]);

require_once '../../Medoo.php';

use Medoo\Medoo;    

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'panel',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);

$resultadoCurso = $database->select("curso","*",["cod_usuario" => $_SESSION['id'] ]);

if($descripcion=="" || is_numeric($descripcion)) {
    header('Location: tareaForm.php?value=0');
    exit();
}

if(!checkOwnDate(trim($_POST['inicio'])) || !checkOwnDate(trim($_POST['fin']))) {
    header('Location: tareaForm.php?value=1');
    exit();
}


$resultado = $database->update("tareas", [
    "descripcion" => $descripcion,
    "fecha_inicio" => $_POST['inicio'],
    "fecha_fin" => $_POST['fin'],
    "estado" => $estado
],["cod_tareas" => $_GET['idTarea']]);


function checkOwnDate($date) {
    $time= explode("-",$date);

    if(count($time) !=3 || !is_numeric($time[0])|| !is_numeric($time[1])|| !is_numeric($time[2])){
       return false;
    }

    return checkdate($time[1],$time[2],$time[0]);
}

header('Location: tareaForm.php?value=3&idTarea='.$_GET['idTarea']);

?>