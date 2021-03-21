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
          <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Fine</small></h1>
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
              <a href="fine.php" class="list-group-item"><span class="glyphicon glyphicon-euro" aria-hidden="true"></span> Fine <span class="badge"><?php echo($total_fine-$total_fine_collected) ?></span></a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo($total_users_no) ?></span></a>
              
            </div>
<!-- ######################################### Side menu -> progress bar ######################################### -->
            <div class="well">
              <h4>Fine Collected</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo(round(($total_fine_collected/$total_fine)*100))."%"?>;"><?php echo(round(($total_fine_collected/$total_fine)*100))."%"?></div>
              </div>
              <h4>Fine Not Collected</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo(round(($total_fine_not_collected/$total_fine)*100))."%"?>;"><?php echo(round(($total_fine_not_collected/$total_fine)*100))."%"?></div>
              </div>
            </div>
        </div>
<!-- ######################################### site overview ######################################### -->
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading main-color-bg"><h3 class="panel-title">Website Overview</h3></div>
            <div class="panel-body">
              <div class="col-md-6">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-yen" aria-hidden="true"></span> <?php echo ($total_fine_collected+$total_fine_not_collected); ?> </h2><h4>Total Fine</h4>
                </div>
              </div>
              <div class="col-md-6">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-euro" aria-hidden="true"></span> <?php echo ($total_fine_collected); ?></h2><h4>Fine Collected</h4>
                </div>
              </div>
            </div>        
          </div>

<!-- ######################################### update ######################################### -->
          <div class="panel panel-default">
            <div class="panel-heading main-color-bg"><h3 class="panel-title">Collect Fine</h3></div>
            <div class="panel-body">
              
                <form method="POST">
                <div class="row">
                  <div class="col-md-3">
                    <input type="text" name="user_id" class="form-control" placeholder="User ID...">
                  </div>
                  <div class="col-md-3">
                    <input type="text" name="user_name" class="form-control" placeholder="User Name...">
                  </div>
                  <div class="col-md-3">
                    <input type="text" name="total_fine" class="form-control" placeholder="Fine...">
                  </div>
                  <div class="col-md-3">
                    <select name="status" class="form-control placeholder">
                      <option selected>Status</option>
                      <option value="Collected">Collected</option>
                      <option value="Not Collected">Not Collected</option>
                    </select>
                  </div>
                </div>
                <div>
                    <br>
                    <input type="text" name="b_title" class="form-control" placeholder="Book Title...">
                  </div>
                <br>
                <button type="submit" name="update_submit" class="btn btn-default col-md-12">Update!</button>
              </form>
          </div>
        </div>
<!-- ######################################### fined user table ######################################### -->
          <div class="panel panel-default">
            <div class="panel-heading main-color-bg">
              <h3 class="panel-title">Fined Users</h3>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-hover">
                <tr>
                  <th>Name</th>
                  <th>Roll Number</th>
                  <th>Total Fine</th>
                  <th>Status</th>
                </tr>
<?php 
                $query = "SELECT * FROM fine_table";
                $result = $connection->query($query);
                while ($row=mysqli_fetch_array($result))
                {
                  echo ("<tr>");
                  echo ("<td>{$row['name']}</td>");
                  echo ("<td>{$row['id']}</td>");
                  echo ("<td>{$row['fine']}</td>");
                  echo ("<td>{$row['status']}</td>");
                  echo ("</tr>");
                }
 ?>   
              </table>
            </div>
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


    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
