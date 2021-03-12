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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="nav-wrapper deep-orange">
    <div class="container">
      <a href="#" class="brand-logo">TODO LIST</a>
    </div>
  </nav>
    <div class=" login row center-align valign-wrapper">
      <div class="card">
        <div class="deep-orange card-content card-title white-text">
          <div class="container">LOGIN FORM</div>
        </div>
      <form class="col s12 " id="form" action="validate.php" method="POST">
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input id="icon_prefix" type="text"  name="nombre">
            <label for="icon_prefix">Email</label>
          </div>

          <div class="input-field col s12">
            <i class="material-icons prefix">lock</i>
            <input type="password" name="pwd">
            <label for="pwd">Password</label>
          </div>
          <div class="input-field col s12">
            <button type="submit" form="form"  class="waves-effect waves-light btn deep-orange">LOGIN</button>
          </div>
        </div>
      </form>
    </div>
  </div>  
</body>
</html>

<?php 
  function responseValue(){
    if(isset($_GET['value'])){
      if($_GET['value']==0){
        ?>
        <script>swal("Error", "No puede dejar en blanco los campos de email y contraseña", "error");</script>
        <?php
      }else if($_GET['value']==1){
        ?>
        <script>swal("Error", "La contraseña o el email se encuentran incorrectos", "error");</script>
        <?php
      }
    }
  }

  responseValue();
?>

