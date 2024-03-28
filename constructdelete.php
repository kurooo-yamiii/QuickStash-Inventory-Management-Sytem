<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $delid = $_POST['delid'];
    
    $check = "SELECT * FROM equipment WHERE ID = $delid";
    $checkres = mysqli_query($conn, $check);


        
if ($checkres) {
    $rows = mysqli_fetch_assoc($checkres);
  
    echo'
    <input type="text" id="delid" name="delid" value="'. $delid .'"style="display: none;" hidden>
    <p>Are you sure you want to delete '. $rows['Name'].' in the equipment list? <p>';

   

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>