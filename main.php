<?php
	$connection = mysqli_connect("localhost", "root", "") or die($connection->error_log() );
	mysqli_select_db($connection, "project") Or die("<p>The database is not available.</p>");

	//######################################### No of total book #########################################
	
	$query = "SELECT * FROM books";

	$total_books_no = 0;

	$result = $connection->query($query);
	$book_array = array(0,"","","","","");
	
	  while ($row=mysqli_fetch_array($result))
	    {
			$total_books_no += 1;
			$book_array[0] = $row['title'];
			$book_array[1] = $row['author'];
			$book_array[2] = $row['edition'];
			$book_array[3] = $row['copies'];
			$book_array[4] = $row['category'];
			
	    }
	//######################################### No of total users #########################################
	$query = "SELECT * FROM user";
	$result = $connection->query($query);
	$total_users_no = 0;
	$students = 0;
	$teachers = 0;
	$user_array = array("","","","");
	  while ($row=mysqli_fetch_array($result))
	    {
			$total_users_no += 1;
			$user_array[0] = $row['id'];
			$user_array[1] = $row['name'];
			$user_array[2] = $row['email'];
			$user_array[3] = $row['type'];
			if ($row['type'] == "Student") {
				$students += 1;
			}
			else if ($row['type'] == "Teacher") {
				$teachers += 1;
			}

	    }
	    //
//######################################### No of Issued book #########################################
	$query = "SELECT * FROM issue_books";
	$result = $connection->query($query);
	$total_issued_books = 0;
	$book_return = 0;
	$book_not_return = 0;
	while ($row=mysqli_fetch_array($result))
	    {
			$total_issued_books += 1;
			if ($row['status'] == "Returned") {
				$book_return += 1;
			}
			else if($row['status'] == "Not Returned"){
				$book_not_return += 1;
			}
			
	    }

//######################################### No of total fine #########################################
	$query = "SELECT * FROM fine_table";
	$result = $connection->query($query);
	$total_fine_collected = 0;
	$total_fine = 0;
	$total_fine_not_collected = 0;
	  while ($row=mysqli_fetch_array($result))
	    {
	    	if($row['status'] == "Collected")
	    		{$total_fine_collected += $row['fine'];}
	    	else if ($row['status'] == "Not Collected")
	    		{$total_fine_not_collected += $row['fine'];}
			$total_fine += $row['fine'];
	    }


//######################################### Insert books in databse #########################################
$msg_book = "";
	if(isset($_POST['submit'])){
		$folder = "upload_data/";
		$title = $_POST["title"];
		$author = $_POST["author"];
		$edition = $_POST["edition"];
		$copies = $_POST["copies"];
		$catg = $_POST["catg"];
		$img = $_FILES["image"]['name'];
		$folder = "upload_data/".$img;
		$tem = $_FILES["image"]['tmp_name'];

	if ($title == true && $author == true && $edition == true && $copies == true && $catg == true && $img == true) {

		move_uploaded_file($tem, $folder);
	
		$query = "INSERT INTO books(title, author, edition, copies, category,images) VALUES ('$title','$author','$edition','$copies','$catg','$folder')";
	//	echo "<script type='text/javascript'>alert('".$query."');</script>";
	 	mysqli_query($connection, $query);
	 	header("location:books.php");
	 	exit;
		}
		else{
			$msg_book = "Please fill all entries.";
		}
	}
	//######################################### issue books #########################################

	if(isset($_POST['issue_submit'])){
		$title = $_POST["title"];
		$author = $_POST["author"];
		$edition = $_POST["edition"];
		$catg = $_POST["catg"];
		$user_name = $_POST["user_name"];
		$user_id = $_POST["user_id"];
		$issue_date = $_POST["issue_date"];
		$return_date = $_POST["return_date"];
	//######################################### update entry #########################################
		$query = "SELECT copies FROM books WHERE title = '$title'";
		$result = $connection->query($query);
		$copies = 0;
		while ($row=mysqli_fetch_row($result))
	    {
			$copies = ($row[0] - 1);
		}
		if (!($copies === 0)) {
			$query = " UPDATE books SET copies=$copies WHERE title ='$title'";
			mysqli_query($connection, $query);
//######################################### update entry #########################################
			$query1 = "INSERT INTO issue_books(title, author, edition, category, name, id, issue_date, return_date, status) VALUES ('$title', '$author', '$edition', '$catg', '$user_name', '$user_id', '$issue_date', '$return_date','Not Returned')";

		 	mysqli_query($connection, $query1);
		 	echo "<script type='text/javascript'>alert('Book issued!');</script>";
	 	}
	 	else{
	 		echo "<script type='text/javascript'>alert('No copy available!');</script>";
	 	}
	 	header("location:issue_book.php");
		exit;
	}
	//######################################### return book #########################################

	if(isset($_POST['return_submit'])){
		$title = $_POST["title"];
		$author = $_POST["author"];
		$edition = $_POST["edition"];
		$catg = $_POST["catg"];
		$user_name = $_POST["user_name"];
		$user_id = $_POST["user_id"];
		$issue_date = $_POST["issue_date"];
		$return_date = date("Y-m-d");
	//######################################### update entry #########################################
		if(!($title === ""|| is_null($title))){
			$query = "SELECT copies FROM books WHERE title = '$title'";
			$result = $connection->query($query);
			$copies = 0;
			while ($row=mysqli_fetch_row($result))
		    {
				$copies = ($row[0] + 1);
			}
			$query = " UPDATE books SET copies=$copies WHERE title ='$title'";
			mysqli_query($connection, $query);
//######################################### update entry #########################################

			$query1 = "UPDATE issue_books SET status='Returned' WHERE id = '$user_id'";
			mysqli_query($connection, $query1);
			echo "<script type='text/javascript'>alert('Book returned!');</script>";
			$res1 = explode("-",$return_date);
			$y0 = (int)$res1[0];$m0= (int)$res1[1];$d0=(int)$res1[2];
			$res2 ; 
			$query2 = "SELECT return_date, title FROM issue_books WHERE id = '$user_id'";
			$result = $connection->query($query2);
			$t ;

			while($row=mysqli_fetch_row($result))
		    {
				$res2 = $row[0];$t = $row[1];
				$res2 = explode("-",$row[0]);
				$y = (int)$res2[0];$m = (int)$res2[1];$d = (int)$res2[2];
				if ($t === $title) {
					if (($y === $y0) || ($y > $y0)){
						if (($m === $m0) || ($m > $m0)) {
							print_r($m);
							print_r($m0);
							if (($d === $d0) || ($d > $d0)) {

							}
							else{
								$query ="INSERT INTO fine_table(name, id, fine, status, edition, book_name) VALUES ('$user_name','$user_id',500,'Not Collected','$edition','$title')";
							
								mysqli_query($connection, $query);
							}
						}
						else{
							print_r($m);
							print_r($m0);
							$query ="INSERT INTO fine_table(name, id, fine, status, edition, book_name) VALUES ('$user_name','$user_id','500','Not Collected','$edition','$title')";
							print_r($query);
							mysqli_query($connection, $query);	
						}
					}
					else{
						$query ="INSERT INTO fine_table(name, id, fine, status, edition, book_name) VALUES ('$user_name','$user_id',1000,'Not Collected','$edition','$title')";
						mysqli_query($connection, $query);
					}
					break;
				}
			}
			
			
			 
		 	header("location:issue_book.php");
			exit;
		}
		//######################################### fine #########################################
}
if(isset($_POST['update_submit'])){
		$user_name = $_POST["user_name"];
		$user_id = $_POST["user_id"];
		$fine = $_POST["total_fine"];
		$status = $_POST["status"];
		$title1 = $_POST["b_title"];
//		print_r($status);
		
		$query = "SELECT * FROM fine_table";
		$result = $connection->query($query);

		$db_Bn;$db_Uid;$db_st;
		while ($row=mysqli_fetch_array($result)){
			$db_Uid = $row['id'];$db_st = $row['status'];$db_Bn = $row['book_name'];

			if (($db_Uid === $user_id) && ($db_Bn === $title1)) {
				if ($db_st === "Not Collected") {
					$query1 = "UPDATE fine_table SET status ='Collected' WHERE id = '$user_id'";
					mysqli_query($connection, $query1);
					break;
				} 
				
			}
			
		}
		header("location:fine.php");
		exit;
	}


//######################################### new user #########################################
	$user_msg = "";
	if(isset($_POST['add_usersub'])){
		$user_name = $_POST["user_name"];
		$user_id = $_POST["user_id"];
		$user_email = $_POST["user_email"];
		$user_gender = $_POST["user_gender"];
		$user_type = $_POST["user_type"];
		$date = date("Y-m-d");
		$img = $_FILES["image"]['name'];
		$folder = "upload_data/".$img;
		$tem = $_FILES["image"]['tmp_name'];

	if ($user_name == true && $user_id == true && $user_email == true && ($user_gender === "Male" || $user_gender === "Female") && ($user_type === "Teacher" || $user_type === "Student")) {
		echo "string";
		move_uploaded_file($tem, $folder);

		$present = 0;
		$query = "SELECT * FROM user WHERE email = '$user_email'";
		$result = $connection->query($query);
		
		$row=mysqli_fetch_array($result);
		
		if ($user_email === $row['email']) {
			echo "<script type='text/javascript'>alert('Email already registered!');</script>";
			$present = 1;
		}
		if ($present === 0) {
			$query1 = "INSERT INTO user(id, name, email, type, gender, acc_c_date, pswd, image) VALUES ('$user_id','$user_name','$user_email','$user_type','$user_gender','$date','fast123','$folder')";
			echo("=> ".$query1);
			mysqli_query($connection, $query1);
		}
		header("location:users.php");
		exit;
	
		}
		else{
			$user_msg = "Please fill all entries.";
		}
	}

	//######################################### admin #########################################

    session_start();
   
    $msg = " Enter email and Pswd";

//->Login Code
    if(isset($_POST['login_btn'])){
    $email     = $_POST['Email'];
    $pswd      = $_POST['password'];
    $Query     = "SELECT * FROM admin WHERE email='$email'";
    $result = $connection->query($Query);
    
     while ($row=mysqli_fetch_array($result))
      {
        
        if(($email === $row['email']) && ($pswd === $row['pswd'])){
            $_SESSION['email'] =$email;
            $_SESSION['name']  =$row[2];
            header('location:home.php');
            	exit;          
        }
        else{ $msg ="Invalid email or Password";}
        }
      }
?>