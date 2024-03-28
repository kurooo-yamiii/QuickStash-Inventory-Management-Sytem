<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $upid = $_POST['upid'];
    
    $check = "SELECT * FROM equipment WHERE ID = $upid";
    $checkres = mysqli_query($conn, $check);


        
if ($checkres) {
    $rows = mysqli_fetch_assoc($checkres);
    
    echo'
    <input type="text" id="upid" name="upid" value="'. $upid .'"style="display: none;" hidden>
    <input type="text" id="name2" name="name2" placeholder="Name" value="' . $rows['Name'] . '" required>
    <input type="text" id="brand2" name="brand2" placeholder="Brand" value="' . $rows['Brand'] . '" required>
    <input type="date" id="date2" name="date2" placeholder="Date" value="' . $rows['Date'] . '" required>
    <input type="number" id="quant" name="quant" placeholder="Quantity" min="1" value="' . $rows['Quantity'] . '" required>';
    
    if($rows['Status'] == "Working") {
        echo'
        <select id="status2" name="status2" required="">
        <option value="Working" selected>Working</option>
        <option value="Defective" >Defective</option>
        </select>';
    }else if ($rows['Status'] == "Borrowed"){
       echo' <input type="text" id="status2" name="status2" value="'. $rows['Status'] .'">';
        
    }else{
        echo'
        <select id="status2" name="status2" required="">
        <option value="Working">Working</option>
        <option value="Defective" selected>Defective</option>
        </select>';
    }

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>