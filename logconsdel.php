<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $delid = $_POST['delid'];
    
    $check = "SELECT * FROM equipment";
    $checkres = mysqli_query($conn, $check);


        
if ($checkres) {
    

    $sql2 = "SELECT * FROM tlog WHERE TimeOut LIKE '%$delid%' OR TimeIn LIKE '%$delid%'";
    $result2 = mysqli_query($conn, $sql2);
    $numtool = mysqli_num_rows($result2);

    $sql3 = "SELECT * FROM elog WHERE TimeOut LIKE '%$delid%' OR TimeIn LIKE '%$delid%'";
    $result3 = mysqli_query($conn, $sql3);
    $numequi = mysqli_num_rows($result3);

    
    if($delid === ""){
        echo '<div id="logdelConstruct">
        <div class="form-group">
          <div class="remove-space"></div>
          <table>
            <thead>
              <tr><th class="table-header" scope="col">DELETE LOG HISTORY</th></tr>
            </thead>
          </table>
          <div class="space"></div>	
          <p>The container is currently empty please enter date in the textbox <p>
        </div>
        <div class="space"></div>
        <div class="choice-container">
        
          <button class="choice-button" id=""  onclick="hidetooladd5()">Back</button>
        </div>
      </div>';
    }
    else if($numequi == 0 && $numtool == 0){
        echo '<div id="logdelConstruct">
        <div class="form-group">
          <div class="remove-space"></div>
          <table>
            <thead>
              <tr><th class="table-header" scope="col">DELETE LOG HISTORY</th></tr>
            </thead>
          </table>
          <div class="space"></div>	
          <p>There are no existing record in the date of '.$delid .' <p>
        </div>
        <div class="space"></div>
        <div class="choice-container">
        
          <button class="choice-button" id=""  onclick="hidetooladd5()">Back</button>
        </div>
      </div>';
    }else{
        $total = $numequi + $numtool;
echo '<div id="logdelConstruct">
        <div class="form-group">
          <div class="remove-space"></div>
          <table>
            <thead>
              <tr><th class="table-header" scope="col">DELETE LOG HISTORY</th></tr>
            </thead>
          </table>
          <div class="space"></div>	
          <input type="text" id="delid" name="delid" value="'. $delid .'"style="display: none;" hidden>
          <p>Are you sure you want to delete a total of '. $total .' rows in the log history? <p>
        </div>
        <div class="space"></div>
        <div class="choice-container">
          <button class="choice-button" type="button" onclick="deleteLog()">Yes</button>
          <button class="choice-button" id=""  onclick="hidetooladd5()">No</button>
        </div>
      </div>';

    }

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>