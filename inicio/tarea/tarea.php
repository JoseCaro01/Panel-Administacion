<?php 
  session_start();

  require_once '../../Medoo.php';
    
  use Medoo\Medoo;    
    
  $database = new Medoo([
      'database_type' => 'mysql',
      'database_name' => 'panel',
      'server' => 'localhost',
      'username' => 'root',
      'password' => ''
  ]);
    
  $resultadoUser = $database->select("usuario","*",["cod_usuario" => $_SESSION['id'] ]);
  $resultadoCurso = $database->select("curso","*",["cod_usuario" => $_SESSION['id'] ]);
  $resultadoAsignatura = $database->select("asignatura","*",["cod_usuario" => $_SESSION['id'],"cod_curso" => $resultadoCurso[0]['cod_curso']]);
  

  if(count($resultadoCurso)==0) {
      header('Location: ../missAlert.php?error=0');
      exit();
  }

  if(count($resultadoAsignatura)==0) {
    header('Location: ../missAlert.php?error=1');
    exit();
  }

  $resultadoTarea= $database->select("tareas","*",["cod_usuario" => $_SESSION['id'],"cod_curso" => $resultadoCurso[0]['cod_curso']]);

  if(count($resultadoTarea)==0){
      header('Location: tareaForm.php');
      exit();
  }

  function getTableData($rows,$database) {
    foreach ($rows as $key => $row) {
      $asigName = $database->select("asignatura","*",["cod_usuario" => $_SESSION['id'],"cod_curso" => $row['cod_curso'],"cod_asignatura" => $row['cod_asignatura']]);
      $id=$row['cod_tareas'];
      echo("<tr>");
      echo("<td>");
      echo($asigName[0]['nombre_asignatura']);
      echo("</td>");
      echo("<td>");
      echo($row['descripcion']);
      echo("</td>");
      echo("<td>");
      echo(explode(" ",$row['fecha_inicio'])[0]);
      echo("</td>");
      echo("<td>");
      echo(explode(" ",$row['fecha_fin'])[0]);
      echo("</td>");
      echo("<td>");
      echo($row['estado']);
      echo("</td>");
      echo("<td>");
      echo("<a href='tareaForm.php?idTarea=$id' class='black-text'> <i class='material-icons'>edit</i> </a>");
      echo("<a href='deleteTarea.php?idTarea=$id' class='black-text'> <i class='material-icons'>remove</i> </a>");
      echo("</td>");
      echo("</tr>");
    }
  }

  function responseValue(){
    if(isset($_GET['value'])){
      if($_GET['value']==0){
        ?>
        <script>swal("Buen trabajo", "Has eliminado la asignatura correctamente", "success");</script>
        <?php
      }
    }
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="..//materialize/css/materialize.min.css">
  <script src="..//materialize/js/materialize.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="../postLogin.css">
</head>

<body>

  <nav class="nav-wrapper deep-orange">
    <div class="container center-align">
      <a href="#" class="brand-logo">TODO LIST</a>
    </div>
    <ul id="slide-out" class="sidenav sidenav-fixed">
      <li>
        <div class="user-view yellow darken-2 ">
          <p><img class="circle black" src="../user_icon.png"></p>
          <p><span class="name black-text"><?php echo($resultadoUser[0]['nombre']); ?></span></p>
          <p><span class=" black-text email"><?php echo($resultadoUser[0]['email']); ?></span></p>
        </div>
      </li>
      <li><a href="../inicio/inicio.php">Inicio</a></li>
      <li><a href="../curso/curso.php">Curso</a></li>
      <li><a href="../asignatura/asignatura.php">Asignatura</a></li>
      <li><a href="tarea.php">Tareas</a></li>
    </ul>
    <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
  </nav>

  <main>
    <div class="container">
      <div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="yellow darken-2 center-align white-text card-content">
              <div class="card-title">TAREAS</div>
              <button onclick="location.href='tareaForm.php'" class="btn-floating halfway-fab waves-effect waves-light red">
                <i class="material-icons">add</i>
              </button>
            </div>
            <div class="card-content row">
              <div class="container">
              <br>
                <table class="highlight">
                  <thead>
                    <tr>
                      <th>Nombre asignatura</th>
                      <th>Descripcion</th>
                      <th>Fecha inicio</th>
                      <th>Fecha fin</th>
                      <th>Estado</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php getTableData($resultadoTarea,$database); ?>
                  </tbody>
                </table>
                <br><br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php  responseValue();?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems);
    });
  </script>

</body>
</html>