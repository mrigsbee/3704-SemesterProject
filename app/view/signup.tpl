<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/signin_crn.css">
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>
	<div class="main">


    <div class="jumbotron">

      <h1> CRNShare </h1>

      <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Sign Up</div>
          </div>
          <div class="panel-body" >
            <form id="signupform" class="form-horizontal" role="form">

              <div id="signupalert" style="display:none" class="alert alert-danger">
                <p>Error:</p>
                <span></span>
              </div>



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
                <!-- Button -->
                <div class="col-md-offset-3 col-md-9">
                  <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i>Sign Up</button>
                </div>
              </div>

              <div style="padding-top:20px"  class="form-group">

              </div>



            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>
</html>
