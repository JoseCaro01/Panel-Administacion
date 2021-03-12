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
  
  $datos=["","","",""];
  if(isset($_GET['idAsig'])) {
    $navigate="edit";
    $url="updateAsignatura.php?idAsig=".$_GET['idAsig'];
    $resultadoAsig = $database->select("asignatura","*",["cod_asignatura" => $_GET['idAsig']]);
    $datos[0]=$resultadoAsig[0]['nombre_asignatura'];
    $datos[1]=$resultadoAsig[0]['n_horas'];
    $datos[2]=$resultadoAsig[0]['profesor'];
  }else {
    $navigate="add";
    $url="addAsignatura.php";
  }


  function responseValue(){
    if(isset($_GET['value'])){
      if($_GET['value']==0){
        ?>
        <script>swal("Error", "Debes introducir nombre de asignatura valido en el campo de nombre", "error");</script>
        <?php
      }else if($_GET['value']==1){
        ?>
        <script>swal("Error", "Debes introducir un numero de horas valido en el campo de horas", "error");</script>
        <?php
      }else if($_GET['value']==2){
        ?>
        <script>swal("Error", "Debes introducir un nombre de profesor valido", "error");</script>
        <?php
      }else if($_GET['value']==3){
        ?>
        <script>swal("Buen trabajo", "Has actualizado una asignatura correctamente", "success");</script>
        <?php
      }else if($_GET['value']==4){
        ?>
        <script>swal("Buen trabajo", "Has creado una asignatura correctamente", "success");</script>
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
              <div class="card-title">FORMULARIO ASIGNATURA</div>
              <button type="submit" form="form" class="btn-floating halfway-fab waves-effect waves-light red">
                <i class="material-icons"><?php echo($navigate); ?></i></button>
            </div>
            <div class="card-content row">
              <form action="<?php echo($url); ?>" id="form" method="post" class="col s12 m12">

                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">school</i>
                    <input id="icon_prefix" type="text" name="nombre" value='<?php echo($datos[0]) ?>'>
                    <label for="icon_prefix">Nombre de la asignatura</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">insert_invitation</i>
                    <input id="icon_prefix" type="text" name="hora" value='<?php echo($datos[1]) ?>'>
                    <label for="icon_prefix">Horas</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">insert_invitation</i>
                    <input id="icon_prefix" type="text" name="profesor" value='<?php echo($datos[2]) ?>'>
                    <label for="icon_prefix">Profesor</label>
                  </div>
                </div>

                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">school</i>
                    <input id="icon_prefix" type="text" name="curso" readonly="readonly"
                      value='<?php echo($resultadoCurso[0]['nombre']); ?>'>
                    <label for="icon_prefix">Curso</label>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
    
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems);
    });
  </script>

  <?php responseValue() ?>

</body>

</html>