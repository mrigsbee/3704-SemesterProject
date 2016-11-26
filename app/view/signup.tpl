<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="<?= BASE_URL ?>/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/public/css/style.css" type="text/css" rel="stylesheet">
  <!-- <link rel="stylesheet" type="text/css" href="css/signin_crn.css"> -->
  <title>Sign Up</title>

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

      <div id="signupbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Sign Up</div>
          </div>
          <div class="panel-body" >
            <form method="POST" action="<?= BASE_URL ?>/register" class="form-horizontal" role="form">

              <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="email" placeholder="Email Address">
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-md-3 control-label">Name</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="name" placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label for="username" class="col-md-3 control-label">Username</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-md-3 control-label">Password</label>
                <div class="col-md-9">
                  <input type="password" class="form-control" name="passwd" placeholder="Password">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                  <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Sign Up</button>
                </div>
              </div>

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
