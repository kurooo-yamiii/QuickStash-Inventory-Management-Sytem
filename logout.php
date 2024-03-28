<?php
session_start(); 

// Check if the user is logged in
if(isset($_SESSION['Name'])) {

    $_SESSION = array();

    
    session_destroy();
}

header("Location: index.php");
exit();
?>