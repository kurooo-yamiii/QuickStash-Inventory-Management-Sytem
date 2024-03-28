<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $bid = $_POST['bid'];
    
    $check = "SELECT * FROM equipment WHERE ID = $bid";
    $checkres = mysqli_query($conn, $check);


        
if ($checkres) {
    $rows = mysqli_fetch_assoc($checkres);
    echo '
    <input type="text" id="bid" name="bid" value="'. $bid .'"style="display: none;" hidden>
   
    <input type="text" id="name3" name="name3" value="'. $rows ['Name'] .'" required>
    <input type="text" id="brand3" name="brand3" value="'. $rows ['Brand'] .'" required>
    <input type="date" id="date3" name="date3" style="display: none;" value="'. $rows ['Date'] .'" required>
    <input type="number" id="qt3" name="qt3" min="1" value="'. $rows['Quantity'] .'" required>
    <input type="text" id="status3" name="status3" value="'. $rows ['Status'] .'" required>
    <input type="text" id="borrower" name="borrower" placeholder="Person in Charge" required>
    ';

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>