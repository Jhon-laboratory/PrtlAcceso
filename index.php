<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PORTAL ACCESO A TERCEROS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css_session/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="css_session/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css_session/adminlte.min.css">

  <style> 
body {
    
background-image: url("img/imglogin.jpg");
  /*
  background-image: url("assets/images/logologin3.jpg");
  background-image: url("assets/images/loginfondo.jpg");*/
  background-color: #cccccc;
        background-size:100% 100%;
  background-repeat: no-repeat;
}
</style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>LOGIRAN S.A.</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Inicio de Sesión</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario.." id="login"  name="login">
          <div class="input-group-append">
            
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña..." id="password" name="password">
          <div class="input-group-append">
           
          </div>
        </div>
        <div class="row">
      
          <!-- /.col -->
          <div class="col-8">
          <button type="button"  onclick="window.location='capacitacion'"  class="btn btn-success">Ir a Formulario</button>
          </div>

          <div class="col-4">
            <button type="submit" name="enviar" class="btn btn-primary btn-block">Aceptar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->


</body>
</html>
