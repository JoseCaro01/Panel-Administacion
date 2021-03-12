<?php 

session_start();

unset($_SESSION['id']);

require_once '..//Medoo.php';

use Medoo\Medoo;    

  $database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'panel',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
  ]);


  if($_POST['nombre']==""||$_POST['pwd']==""){
      header('Location: index.php?value=0');
      exit();
  }

  $resultado = $database->select("usuario","*",["email" => $_POST['nombre'],
  "password" => $_POST['pwd']]);


  if(count($resultado)<=0){
   header('Location: index.php?value=1');
   exit();
  }


  if(!isset($_SESSION['id'])) {
    $_SESSION['id'] = $resultado[0]['cod_usuario'];
    header('Location: ../inicio/inicio/inicio.php');
  }

?>