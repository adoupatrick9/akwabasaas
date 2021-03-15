<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Connexion</title>

 <!-- Favicons -->
 <link href="{{ asset('img/logo.png') }}" rel="icon">
 <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

 <!-- Bootstrap core CSS -->
 <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
 <!--external css-->
 <link href="{{ asset('lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
 <link rel="stylesheet" type="text/css" href="{{ asset('css/zabuto_calendar.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('lib/gritter/css/jquery.gritter.css') }}" />
 <!-- Custom styles for this template -->
 <link href="{{ asset('css/style.css') }}" rel="stylesheet">
 <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
 <script src="{{ asset('lib/chart-master/Chart.js') }}"></script>
</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page" style="margin-top: 100px">
    <div class="container">
      <form class="form-login" action="{{ url('/login') }}" method="POST">
        @csrf
        <h2 class="form-login-heading">AKWABASAAS</h2>
        <div class="login-wrap">
          <input type="text" class="form-control" placeholder="Login" autofocus name="login">
          <br>
          <input type="password" class="form-control" placeholder="Mot de passe" name="pwd">
          <br>
          <button class="btn btn-theme btn-block" type="submit" id="submit"><i class="fa fa-lock"></i> CONNEXION</button>
          <hr>
          <label class="checkbox text-center">
            <a data-toggle="modal" href="{{ url('/login#myModal') }}"> Mot de passe oublié?</a>
          </label>
            @if(session()->has('message'))
                <em class="alert alert-danger text-center">{{ session()->get('message') }}</em>
            @endif
        </div>
        <div class="container text-danger pull-right">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog" style="vertical-align: middle">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password ?</h4>
              </div>
              <div class="modal-body">
                <p>Enter your e-mail address below to reset your password.</p>
                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button class="btn btn-theme" type="button">Submit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- modal -->
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>

  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="{{ asset('lib/jquery.backstretch.min.js') }}"></script>
  <script>
    $.backstretch('{{ asset("img/login-bg.jpg") }}', {
      speed: 1000
    });
  </script>

   <!-- js placed at the end of the document so the pages load faster -->
</body>

</html>


