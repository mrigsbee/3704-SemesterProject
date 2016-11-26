<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sign In</title>
  <link href="<?= BASE_URL ?>/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/public/css/style.css" type="text/css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.0.js"></script>

</head>

<body>
	<div class="main">


    <div class="jumbotron">

      <h1 class='elegantshadow'> CRNShare </h1>

      <span id="error">
          <?php
              if(isset($_SESSION['error']))
              {
                  if($_SESSION['error'] != '')
                  {
                      echo '<div class="alert alert-info" role="alert">'.$_SESSION["error"].'</div>';
                      $_SESSION['error'] = '';
                  }
              }
          ?>
      </span>
      <span id="info">
          <?php
              if(isset($_SESSION['info']))
              {
                  if($_SESSION['info'] != '')
                  {
                      echo '<div class="alert alert-info" role="alert">'.$_SESSION["info"].'</div>';
                      $_SESSION['info'] = '';
                  }
              }
          ?>
      </span>

      <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
          <div class="panel-heading">
            <div class="panel-title">Sign In</div>
            <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
          </div>

          <div style="padding-top:30px" class="panel-body" >

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

            <form method="POST" action="<?= BASE_URL ?>/postlogin" class="form-horizontal" role="form">
              <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">
              </div>

              <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
              </div>

              <!-- Remember me -->
              <div class="input-group">
                <div class="checkbox">
                  <label>
                    <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                  </label>
                </div>
              </div>

              <!-- Login -->
              <div style="margin-top:10px" class="form-group">
                  <button class="btn btn-success" type="submit">
                    Login
                  </button>
              </div>
            </form>

            <!-- Sign Up -->
            Don't have an account?
            <form method="POST" action="<?= BASE_URL ?>/signup" class="form-horizontal">
                <button class="btn btn-info btn-sm">
                  Sign Up Here
                </button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="<?= BASE_URL ?>/public/js/main.js"></script>
  <script src="<?= BASE_URL ?>/public/js/bootstrap.min.js"></script>
</body>
</html>
