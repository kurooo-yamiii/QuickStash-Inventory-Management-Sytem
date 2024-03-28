<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $upid = $_POST['upid'];
    
    $check = "SELECT * FROM login WHERE ID = $upid";
    $checkres = mysqli_query($conn, $check);


        
if ($checkres) {
    $rows = mysqli_fetch_assoc($checkres);
    $email = $rows['Username'];
    $username = str_replace("@gmail.com", "", $email);
    echo '<input type="text" id="aid" name="aid" value="'. $upid .'"style="display: none;" hidden> ';
    echo '<input type="text" id="fullname2" name="fullname2"  placeholder="Full Name" value="'. $rows['Name'] . '" required>';

    echo '<div class="username">
            <input type="text" id="username2" name="username2"  placeholder="Username" value="'. $username . '"required>
            <p class="gmail">@gmail.com</p>
          </div>';
    
    echo '<input type="text" id="password2"  name="password2" placeholder="Password" value="'. $rows['Password'] . '" required>';


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>