<?php 
session_start(); 

require_once '../Medoo.php';

use Medoo\Medoo;    

  $database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'panel',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
  ]);

  $resultado = $database->select("usuario","*",["cod_usuario" => $_SESSION['id'] ]);

  if($_GET['error']==0) {
    $stringError="No puedes crear una asignatura o una tarea si no tienes un curso asignado todavia. Pulsa el boton si deseas ir a crear un curso.";
    $navigate="curso/curso.php";
  }else if ($_GET['error']==1){
    $stringError="No puedes crear una tarea si no tienes una asignatura creada todavia. Pulsa el boton si deseas ir a crear una asignatura.";
    $navigate="asignatura/asignatura.php";
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="materialize/css/materialize.min.css">
    <script src="materialize/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="postLogin.css">
</head>
<body>
    
    <nav class="nav-wrapper deep-orange">
      <div class="container center-align">
        <a href="#" class="brand-logo">TODO LIST</a>
      </div>
        <ul id="slide-out" class="sidenav sidenav-fixed">
            <li>
                <div class="user-view yellow darken-2 ">
                    <p><img class="circle black" src="user_icon.png"></p>
                    <p><span class="name black-text"><?php echo($resultado[0]['nombre']); ?></span></p>
                    <p><span class=" black-text email"><?php echo($resultado[0]['email']); ?></span></p>
                </div>
            </li>
            <li><a href="inicio/inicio.php">Inicio</a></li>
            <li><a href="curso/curso.php">Curso</a></li>
            <li><a href="asignatura/asignatura.php">Asignatura</a></li>
            <li><a href="tarea/tarea.php">Tareas</a></li>
          </ul>
          <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
    </nav>

    <main>
        <div class="container">
            <div class="row">
            <div class="col s12 m12">
              <div class="card">
                <div class="card-image">
                  <img src="curso.png">
                  <span class="card-title">Bienvenido <?php echo($resultado[0]['nombre']); ?></span>
                </div>
                <div class="card-content center-align">
                  <p><?php echo($stringError)?></p>
                  <br>
                  <a class="waves-effect waves-light btn deep-orange" href='<?php echo($navigate) ?>'>VOLVER</a>
                </div>
              </div>
            </div>
          </div>
        </div>

      

    <script >
         document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
  });
    </script>
    
</body>
</html>