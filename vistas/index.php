<?php

  require_once "../config/conn.php";

  if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){

      require_once "../modelos/Usuarios.php";
      $usuario = new Usuarios();
      $usuario->login();
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Login | Inicio de Sesion</title>
  <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../public/Bootstrap/css/animate.css">
  <link rel="stylesheet" href="../public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
  <div id="container">
  <div class="login-box">
  <div class="login-logo">
    <a href="index.php"><h1 class="animated bounceInUp" >Esmeralda S.A.</h1></a>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="box-body">
                <?php

                if(isset($_GET["m"])){

                    switch($_GET["m"]){

                      case "1":
                      ?>
                          <div class="alert alert-danger alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <h4><i class="fas fa-bomb"></i>El usuario y/o contraseña son incorrectos</h4>
                          </div>
                      <?php
                      break;

                      case "2":
                      ?>
                          <div class="alert alert-danger alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <h4><i class="fas fa-bomb"></i>Debe llenar los campos</h4>
                          </div>


                      <?php
                      break;
                    }

                }
            ?>


        </div>
      </div>
    </div>
  </div>

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <form action="" method="post" autocomplete="on">
        <div class="input-group mb-4">
          <input type="text" name="userName" id="userName" class="form-control" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="animated rubberBand"><i class="fas fa-user"></i></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-4">
          <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" autocomplete="on">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="animated rubberBand fas fa-lock"></span>
            </div>
          </div>
        </div>


        <input type="hidden" name="enviar" class="form-control" value="si"/>

        <div class="row">
          <!--<div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember"> Recordar Contraseña </label>
            </div>
          </div>-->

            <button type="submit" class="btn btn-dark btn-block">Enviar</button>

        </div>
        <!--<p class="mb-1">
        <a href="forgot-password.html">&iquest;Olvide mi Contraseña&quest;</a>
        </p>-->
      </form>
    </div>
  </div>
</div>
</div>
</body>
</html>
