<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <link href="<?= BASE_URL ?>/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/public/css/style.css" type="text/css" rel="stylesheet">
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
          <div class="panel-body">
            <form method="POST" action="<?= BASE_URL ?>/register" class="form-horizontal" role="form">

                <div style="margin-bottom: 25px" class="input-group">
                  <span class="input-group-addon"><i class='fa fa-user-circle' aria-hidden='true'></i></span>
                  <input type="text" class="form-control" name="name" placeholder="name">
                </div>

                <div style="margin-bottom: 25px" class="input-group">
                  <span class="input-group-addon"><i class='fa fa-user' aria-hidden='true'></i></span>
                  <input type="text" class="form-control" name="username" placeholder="username">
                </div>

                <div style="margin-bottom: 25px" class="input-group">
                  <span class="input-group-addon"><i class='fa fa-lock' aria-hidden='true'></i></span>
                  <input type="password" class="form-control" name="passwd" placeholder="password">
                </div>

                <div style="margin-bottom: 25px" class="input-group">
                  <span class="input-group-addon"><i class='fa fa-envelope' aria-hidden='true'></i></span>
                  <input type="text" class="form-control" name="email" placeholder="email">
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

 <script src="https://use.fontawesome.com/80358a383e.js"></script>
  <script type="text/javascript" src="<?= BASE_URL ?>/public/js/main.js"></script>
  <script src="<?= BASE_URL ?>/public/js/bootstrap.min.js"></script>
</body>
</html>
