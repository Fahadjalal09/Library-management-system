<?php    include("main.php");


 ?>
<!DOCTYPE html>
<html lang="en">
  <script type="text/JavaScript"></script>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <script type="text/javascript"></script>
          </button>
          <a class="navbar-brand">Library Managment</a>
        </div>
      </div>
    </nav>

    <header id="header1">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Admin Login <small>Manage Your Library</small></h1>
        </div>
      </div>
    </div>
  </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form id="login" class="well" method = "POST">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" name = "Email" class="form-control" placeholder="Enter Email">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name = "password" class="form-control" placeholder="Password">
                  </div>
                  <button type="submit" name="login_btn" class="btn btn-default btn-block">Login</button>
          <h5><?php echo $msg; ?></h5>
              </form>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright Library Managment &copy; 2019</p>
      <p>Project by Rohan Farooqui & Fahad Jalal</p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>