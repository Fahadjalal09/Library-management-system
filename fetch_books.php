<?php  
$connect = mysqli_connect("localhost", "root", "","project");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "SELECT * FROM books WHERE title LIKE '%".$_POST["query"]."%'";
}
else
{
 $query = "
  SELECT * FROM books ORDER BY title
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Title</th>
     <th>Author</th>
     <th>Edition</th>
     <th>Avaliable Copies</th>
     <th>Catg</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["title"].'</td>
    <td>'.$row["author"].'</td>
    <td>'.$row["edition"].'</td>
    <td>'.$row["copies"].'</td>
    <td>'.$row["category"].'</td>
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