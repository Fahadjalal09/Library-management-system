<?php include 'main.php';
 $U_name = $_SESSION['name'];
  $U_email = $_SESSION['email'];

  if ($U_email == true) {
    
  }
  else{
      header("location:index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>

  <body>
    <!-- ######################################### navbar ######################################### -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Library Managment</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="home.php">Dashboard</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a id="user_name">Welcome, <?php echo ($_SESSION['name']); ?></a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<!-- ######################################### header ######################################### -->

  <header id="header1">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Users</small></h1>
        </div>
      </div>
    </div>
  </header>
  <!-- ######################################### Title on page ######################################### -->
  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="active">Dashboard</li>
      </ol>
    </div>
  </section>
    <!-- ######################################### Side menu ######################################### -->
  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="home.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
              <a href="books.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Total Books <span class="badge"><?php echo($total_books_no) ?></span></a>
              <a href="issue_book.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Issued Books <span class="badge"><?php echo($total_issued_books) ?></span></a>
              <a href="fine.php" class="list-group-item"><span class="glyphicon glyphicon-euro" aria-hidden="true"></span> Fine <span class="badge"><?php echo(($total_fine-$total_fine_collected)) ?></span></a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo($total_users_no) ?></span></a>
      
            </div>
<!-- ######################################### Side menu -> progress bar ######################################### -->
            <div class="well">
              <h4>Students</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo(round(($students/$total_users_no)*100))."%"?>"><?php echo(round(($students/$total_users_no)*100))."%"?></div>
              </div>
              
              <h4>Teachers</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo(round(($teachers/$total_users_no)*100))."%"?>;"><?php echo(round(($teachers/$total_users_no)*100))."%"?></div>
              </div>
            </div>
        </div>

        
<!-- ######################################### Search Book ######################################### -->
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading main-color-bg">
              <h3 class="panel-title">Search User</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                  <div class="input-group">
                    <input type="text" name="search_text" id="search_text" class="form-control" placeholder="User Name...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Search</button>
                    </span>
                  </div>
                </div>

                <div id="result"></div>

                </div>
              </div>
            </div>
          </div>
<!-- ######################################### Add Book ######################################### -->
        <div class="col-md-13">
          <div class="panel panel-default">
            <div class="panel-heading main-color-bg">
              <h3 class="panel-title">Add User</h3>
            </div>
            <div class="panel-body">

              <form method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-2">
                    <input type="text" name="user_id" class="form-control" placeholder="Id...">
                  </div>
                  <div class="col-md-2">
                    <input type="text" name="user_name" class="form-control" placeholder="Name...">
                  </div>
                  <div class="col-md-2">
                    <input type="Email" name="user_email" class="form-control" placeholder="Email...">
                  </div>
                  <div class="col-md-3">
                    <select name="user_gender" class="form-control placeholder">
                      <option selected>Gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    </div>

                  <div class="col-md-3">
                    <select name="user_type" class="form-control placeholder">
                      <option selected>Type</option>
                      <option value="Teacher">Teacher</option>
                      <option value="Student">Student</option>
                    </select>
                  </div>
                </div>
                <div >
                    <br>
                    <input type="file" name="image" class="form-control" placeholder="Add pic">
                  </div>
                <br>
                <button type="submit" name="add_usersub" class="btn btn-default col-md-12">Add User!</button>
                <br><br>
                <h5 class="text-danger"><?php echo ($user_msg); ?></h5>
              </form>
            </div>
          </div>
        </div>
<!-- ######################################### latest user table ######################################### -->        
          <div class="panel panel-default">
            <div class="panel-heading main-color-bg">
              <h3 class="panel-title">Total Users</h3>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-hover">
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Catg</th>
                </tr>
<?php 
                $query = "SELECT * FROM user";
                $result = $connection->query($query);
                while ($row=mysqli_fetch_row($result))
                {
                  echo ("<tr>");
                  echo ("<td>{$row[0]}</td>");
                  echo ("<td>{$row[1]}</td>");
                  echo ("<td>{$row[2]}</td>");
                  echo ("<td>{$row[3]}</td>");
                  echo ("</tr>");
                }
 ?>   
              </table>
            </div>
          </div>
        
      </div>
    </div>
  </section>
<!-- ######################################### page footer ######################################### -->
  <footer id="footer">
    <p>Copyright Library Managment &copy; 2019</p>
    <p>Project by Fahad Jalal & Rohan Farooqui</p>
  </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/search_user.js"></script>
  </body>
</html>
