<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $upid = $_POST['upid'];
    
    $check = "SELECT * FROM tools WHERE ID = $upid";
    $checkres = mysqli_query($conn, $check);


        
if ($checkres) {
    $rows = mysqli_fetch_assoc($checkres);
    
    echo '
    <input type="text" id="tbid" name="tbid" value="'. $upid .'"style="display: none;" hidden>
    <input type="text" id="tname3" name="tname3" placeholder="Name" value="'. $rows['Name'] .'" required>
    <input type="text" id="tbrand3" name="tbrand3" placeholder="Brand" value="'. $rows['Brand'] .'" required>
    <input type="text" id="tdate3" name="tdate3" placeholder="Date" value="'. $rows['Date'] .'" required>
    <input type="number" id="qty3" name="qty3" placeholder="Quantity" min="1" max="'. $rows['Quantity'] .'" value="'. $rows['Quantity'] .'" required>
    <input type="text" id="tstatus3" name="tstatus3" value="'. $rows['Status'] .'">
    <input type="text" id="borrow" name="borrow" placeholder="Person in Charge" required>
    ';


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>