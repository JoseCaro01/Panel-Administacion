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
  

  if(count($resultadoCurso)==0) {
      header('Location: ../missAlert.php?error=0');
      exit();
  }


  $resultadoAsignatura = $database->select("asignatura","*",["cod_usuario" => $_SESSION['id'],"cod_curso" => $resultadoCurso[0]['cod_curso']]);

  if(count($resultadoAsignatura)==0) {
    header('Location: asignaturaForm.php');
  }

  function getTableData($rows,$cursoName) {
    foreach ($rows as $key => $row) {
      $id=$row['cod_asignatura'];
      echo("<tr>");
      echo("<td>");
      echo($row['nombre_asignatura']);
      echo("</td>");
      echo("<td>");
      echo($row['n_horas']);
      echo("</td>");
      echo("<td>");
      echo($row['profesor']);
      echo("</td>");
      echo("<td>");
      echo($cursoName);
      echo("</td>");
      echo("<td>");
      echo("<a href='asignaturaForm.php?idAsig=$id' class='black-text'> <i class='material-icons'>edit</i> </a>");
      echo("<a href='deleteAsignatura.php?idAsig=$id' class='black-text'> <i class='material-icons'>remove</i> </a>");
      echo("<a href='../tarea/tareaForm.php?idAsig=$id' class='black-text'> <i class='material-icons'>add</i> </a>");
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
      }else if ($_GET['value']==1) {
        ?>
        <script>swal("Error", "No puedes eliminar una asginatura si no has eliminado todas sus tareas", "error");</script>
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
      <li><a href="asignatura.php">Asignatura</a></li>
      <li><a href="../tarea/tarea.php">Tareas</a></li>
    </ul>
    <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
  </nav>

  <main>
    <div class="container">
      <div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="yellow darken-2 center-align white-text card-content">
              <div class="card-title">ASIGNATURAS</div>
              <button onclick="location.href='asignaturaForm.php'" class="btn-floating halfway-fab waves-effect waves-light red">
                <i class="material-icons">add</i>
              </button>
            </div>
            <div class="card-content row">
              <div class="container">
              <br>
                <table class="highlight">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Horas</th>
                      <th>Profesor</th>
                      <th>Curso</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php getTableData($resultadoAsignatura,$resultadoCurso[0]['nombre']); ?>
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