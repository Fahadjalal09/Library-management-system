<?php  
$connect = mysqli_connect("localhost", "root", "","project");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "SELECT * FROM user WHERE name LIKE '%".$_POST["query"]."%'";
}
else
{
 $query = "
  SELECT * FROM user ORDER BY name
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>ID</th>
     <th>Name</th>
     <th>Email</th>
     <th>Gender</th>
     <th>Type</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["id"].'</td>
    <td>'.$row["name"].'</td>
    <td>'.$row["email"].'</td>
    <td>'.$row["gender"].'</td>
    <td>'.$row["type"].'</td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}


?>