<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

 
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
     <img src="adminlte/img/logo.png">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

        @if (Session::has('message'))
                            <div class="alert alert-warning">{{ Session::get('message') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{$error}}
                                @endforeach
                            </div> 
                        @endif
      <p class="login-box-msg">Ingresa tus datos para iniciar sesión.</p>

       <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Ingresar email" value="{{ old('email') }}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

             

        <div class="input-group mb-3">
          <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Ingresar contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
           
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

      <p class="mb-1">
    
      </p>
      <p class="mb-0">
        <a href="register" class="text-center">Registrar un nuevo usuario</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>

</body>
</html>    
