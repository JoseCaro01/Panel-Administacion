<?php 

session_start();

$centro=trim($_POST['nombre_curso']);
$fecha_inicio=trim($_POST["año_inicio"]);
$fecha_fin=trim($_POST["año_fin"]);
$descripcion=trim($_POST["descripcion"]);

if($centro==""||$fecha_inicio==""||$fecha_fin==""||$descripcion==""||is_numeric($centro)||is_numeric($descripcion)){
    header('Location: curso.php?value=1');
    exit();
}

if(!checkOwnDate($fecha_inicio) || !checkOwnDate($fecha_fin)){
    header('Location: curso.php?value=2');
    exit();
}

function checkOwnDate($date) {
    $time= explode("-",$date);

    if(count($time) !=3 || !is_numeric($time[0])|| !is_numeric($time[1])|| !is_numeric($time[2])){
       return false;
    }

    return checkdate($time[1],$time[2],$time[0]);
}


require_once '../../Medoo.php';

use Medoo\Medoo;    

  $database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'panel',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
  ]);



if($_GET['createOrUpdate']=="add"){

    $resultado = $database->insert("curso", [
        "cod_usuario" => $_SESSION['id'],
        "nombre" => $centro,
        "descripcion" => $descripcion,
        "fecha_inicio" => $fecha_inicio,
        "fecha_fin" => $fecha_fin
      ]);
      header('Location: curso.php?value=0');

}else {
  
    $resultado = $database->update("curso", [
        "nombre" => $centro,
        "descripcion" => $descripcion,
        "fecha_inicio" => $fecha_inicio,
        "fecha_fin" => $fecha_fin
      ],["cod_usuario" => $_SESSION['id'] ]);
      header('Location: curso.php?value=3');
}

  


?>