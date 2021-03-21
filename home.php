<?php
	include ('main.php');
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
            <script type="text/javascript"></script>
          </button>
          <a class="navbar-brand">Library Managment</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="home.php">Dashboard</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a id="user_name">Welcome, <?php echo($_SESSION['name']) ?></a></li>
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
          <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your Library</small></h1>
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
              <h4>Books Issued</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo(round(($total_issued_books/$total_books_no)*100))."%"?>;">
                	<?php echo(round(($total_issued_books/$total_books_no)*100))."%"?></div>
              </div>
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
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo($total_users_no) ?> </h2><h4>Users</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-book" aria-hidden="true"></span> <?php echo($total_books_no) ?> </h2><h4>Total Books</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <?php echo($total_issued_books) ?> </h2><h4>Issued Books</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-euro" aria-hidden="true"></span> <?php echo($total_fine_collected) ?> </h2><h4>Fine Collected</h4>
                </div>
              </div>
            </div>        
          </div>
<!-- ######################################### latest user table ######################################### -->
          <div class="panel panel-default">
            <div class="panel-heading main-color-bg">
              <h3 class="panel-title">Last User Added</h3>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-hover">
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Type</th>
                </tr>
                <tr>
                  <td><?php echo($user_array[0] )?></td>
                  <td><?php echo($user_array[1] )?></td>
                  <td><?php echo($user_array[2] )?></td>
                  <td><?php echo($user_array[3] )?></td>
                </tr>
              </table>
            </div>
          </div>

<!-- ######################################### latest user table ######################################### -->        
          <div class="panel panel-default">
            <div class="panel-heading main-color-bg">
              <h3 class="panel-title">Last Book Added</h3>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-hover">
                <tr>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Edition</th>
                  <th>Avaliable Copies</th>
                  <th>Catg</th>
                </tr>
                <tr>
                  <td><?php echo($book_array[0] )?></td>
                  <td><?php echo($book_array[1] )?></td>
                  <td><?php echo($book_array[2] )?></td>
                  <td><?php echo($book_array[3] )?></td>
                  <td><?php echo($book_array[4] )?></td>
                  
                </tr>
                </tr>
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
<?php
	$connection->close();

?>