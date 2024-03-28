<?php 
session_start(); 
include "db_conn.php";

// Validation of Data
if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	// Checking Username and Password Container
	if (empty($uname)) {
		header("Location: index.php?error=Username is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{

		// SQL Fetch for the Account
		$sql = "SELECT * FROM login WHERE Username='$uname' AND Password='$pass'";
		$result = mysqli_query($conn, $sql);
		
	    // Checking for Student Account Match (Else Statement Return Incorrect Password and Username)
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['Username'] === $uname && $row['Password'] === $pass && $row['Status'] == 1) {
            	
				$_SESSION['Username'] = $row['Username'];
            	$_SESSION['Name'] = $row['Name'];
            	$_SESSION['Password'] = $row['Password'];
				$_SESSION['ID'] = $row['ID'];
            	header("Location: admin.php");
		        exit();}

            else if ($row['Username'] === $uname && $row['Password'] === $pass && $row['Status'] == 0) {
            	
                $_SESSION['Username'] = $row['Username'];
                $_SESSION['Name'] = $row['Name'];
                $_SESSION['Password'] = $row['Password'];
                $_SESSION['ID'] = $row['ID'];
                header("Location: user.php");
                exit();}
			else{
					header("Location: index.php?error=Incorrect Username or Password");
					exit();
				}
            }else{
				header("Location: index.php?error=Incorrect Username or Password");
							exit();
			}
	}
	
}else{
	header("Location: index.php");
	exit();
}