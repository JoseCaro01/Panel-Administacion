<?php
session_start();

$nombre=trim($_POST['nombre']);
$hora=trim($_POST["hora"]);
$profesor=trim($_POST["profesor"]);
$curso=trim($_POST["curso"]);

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

if($nombre=="" || is_numeric($nombre)) {
    header('Location: asignaturaForm.php?value=0');
    exit();
}

if($hora=="" || !is_numeric($hora)) {
    header('Location: asignaturaForm.php?value=1');
    exit();
}

if($profesor=="" || is_numeric($profesor)) {
    header('Location: asignaturaForm.php?value=2');
    exit();
}

$resultado = $database->insert("asignatura", [
    "cod_usuario" => $_SESSION['id'],
    "cod_curso" => $resultadoCurso[0]['cod_curso'],
    "nombre_asignatura" => $nombre,
    "n_horas" => $hora,
    "profesor" => $profesor
]);
header('Location: asignaturaForm.php?value=4');

?>