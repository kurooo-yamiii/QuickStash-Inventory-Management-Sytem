<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $upid = $_POST['upid'];
    
    $check = "SELECT * FROM tools WHERE ID = $upid";
    $checkres = mysqli_query($conn, $check);


        
if ($checkres) {
    $rows = mysqli_fetch_assoc($checkres);
    
    echo '
    <input type="text" id="tid" name="tid" value="'. $upid .'"style="display: none;" hidden>
    <input type="text" id="tname2" name="tname2" placeholder="Name" value="'. $rows['Name'] .'" required>
    <input type="text" id="tbrand2" name="tbrand2" placeholder="Brand" value="'. $rows['Brand'] .'" required>
    <input type="date" id="tdate2" name="tdate2" placeholder="Date" value="'. $rows['Date'] .'" required>
    <input type="number" id="qty2" name="qty2" placeholder="Quantity" min="1" value="'. $rows['Quantity'] .'" required>';
    if($rows['Status'] == "Working") {
        echo'
        <select id="tstatus2" name="tstatus2" required="">
        <option value="Working" selected>Working</option>
        <option value="Defective" >Defective</option>
        </select>';
    }else if ($rows['Status'] == "Borrowed"){
       echo'<input type="text" id="tstatus2" name="tstatus2" value="'. $rows['Status'] .'">';
       echo '<script>
            document.getElementById("tstatus2").readOnly = true;
        </script>';
      
    }else{
        echo'
        <select id="tstatus2" name="tstatus2" required="">
        <option value="Working">Working</option>
        <option value="Defective" selected>Defective</option>
        </select>';
    }


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>