<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bazaar-Bid</title>

  <meta name="description" content="Source code generated using layoutit.com">
  <meta name="author" content="LayoutIt!">
  <link rel="icon" type="image/x-icon" href="assets/logo.svg">
  <style type="text/css">
    body {
      overflow-x: hidden;
    }
  </style>
  <link href="../view/css/bootstrap.min.css" rel="stylesheet">
  <link href="../view/css/style.css" rel="stylesheet">
  <script src="../view/js/jquery.min.js"></script>
  <script src="../view/js/bootstrap.min.js"></script>
  <script src="../view/js/scripts.js"></script>
</head>

<body>
  <div class="container"
    style="height: 100vh; width:100vw; overflow:hidden; background: url('../assets/banner.png') no-repeat center;background-size: cover;">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="panel-title">Sign In</div>
        </div>
        <div style="padding-top:30px" class="panel-body">
          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
          <form action="./auth.php" method="post" id="loginform" class="form-horizontal" role="form">
            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="login-username" type="text" class="form-control" name="username" value=""
                placeholder="username or email" required>
            </div>
            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required>
            </div>
            <div style="margin-top:10px" class="form-group">
              <div class="col-sm-12 controls">
                <button type="submit" class="btn btn-success">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>