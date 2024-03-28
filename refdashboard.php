<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $check = "SELECT * FROM equipment";
    $checkres = mysqli_query($conn, $check);

if ($checkres) {
  
    $tool = "SELECT * FROM tools WHERE Status = 'Working'";
	$toolscore = mysqli_query($conn, $tool);
	$toolwork = mysqli_num_rows($toolscore);

	$tool2 = "SELECT * FROM tools WHERE Status = 'Defective'";
	$toolscore2 = mysqli_query($conn, $tool2);
	$tooldef = mysqli_num_rows($toolscore2);

	$tool3 = "SELECT * FROM tools WHERE Status = 'Borrowed'";
	$toolscore3 = mysqli_query($conn, $tool3);
	$toolbor = mysqli_num_rows($toolscore3);    

echo '<div class="donutRow">';	
echo '<div class="donut">';
echo '<div class="donut-title">TOOL INVENTORY REPORT</div>';
echo '<canvas id="donutChart" width="370" height="300"></canvas>';

echo '<script>';
echo 'data = {';
echo 'labels: [\'Borrowed\', \'Working\', \'Defective\'],';
echo 'datasets: [{';
echo 'data: [' . $toolbor . ', ' . $toolwork . ', ' . $tooldef . '],'; 
echo 'backgroundColor: [\'rgba(65, 105, 225)\', \'rgba(65, 105, 225, 0.7)\', \'rgba(65, 105, 225, 0.3)\']';
echo '}]';
echo '};';

echo 'options = {';
echo 'cutoutPercentage: 70,'; 
echo 'responsive: false,'; 
echo 'legend: {';
echo 'position: \'right\'';
echo '}';
echo '};';

echo ' ctx = document.getElementById(\'donutChart\').getContext(\'2d\');';

echo 'donutChart = new Chart(ctx, {';
echo 'type: \'doughnut\',';
echo 'data: data,';
echo 'options: options';
echo '});';

echo '</script>';

echo '</div>'; // closing div for class="donut"

    $lap = "SELECT * FROM equipment WHERE Status = 'Working'";
	$lapscore = mysqli_query($conn, $lap);
	$lapwork = mysqli_num_rows($lapscore);

	$lap2 = "SELECT * FROM equipment WHERE Status = 'Defective'";
	$lapscore2 = mysqli_query($conn, $lap2);
	$lapdef = mysqli_num_rows($lapscore2);

	$lap3 = "SELECT * FROM equipment WHERE Status = 'Borrowed'";
	$lapscore3 = mysqli_query($conn, $lap3);
	$lapbor = mysqli_num_rows($lapscore3);


echo '<div class="donut">';
echo '<div class="donut-title">EQUIPMENT INVENTORY REPORT</div>';
echo '<canvas id="donutChart2" width="370" height="300"></canvas>';

echo '<script>';
echo 'data2 = {';
echo 'labels: [\'Borrowed\', \'Working\', \'Defective\'],';
echo 'datasets: [{';
echo 'data: [' . $lapbor . ', ' . $lapwork . ', ' . $lapdef . '],'; 
echo 'backgroundColor: [\'rgba(255, 215, 0)\', \'rgba(255, 215, 0, 0.7)\', \'rgba(255, 215, 0, 0.3)\']';
echo '}]';
echo '};';

echo 'options2 = {';
echo 'cutoutPercentage: 70,'; 
echo 'responsive: false,'; 
echo 'legend: {';
echo 'position: \'right\'';
echo '}';
echo '};';

echo 'ctx2 = document.getElementById(\'donutChart2\').getContext(\'2d\');';

echo 'donutChart2 = new Chart(ctx2, {';
echo 'type: \'doughnut\',';
echo 'data: data2,';
echo 'options: options2';
echo '});';

echo '</script>';

echo '</div>'; 

    $overwork = $lapwork + $toolwork;
	$overdef = $lapdef + $tooldef;
	$overbor = $lapbor + $toolbor;

echo '<div class="donut">';
echo '<div class="donut-title">OVERALL INVENTORY REPORT</div>';
echo '<canvas id="donutChart3" width="370" height="300"></canvas>';

echo '<script>';
echo 'data3 = {';
echo 'labels: [\'Borrowed\', \'Working\', \'Defective\'],';
echo 'datasets: [{';
echo 'data: [' . $overbor . ', ' . $overwork . ', ' . $overdef . '],'; 
echo 'backgroundColor: [\'rgba(106, 13, 173)\', \'rgba(106, 13, 173, 0.7)\', \'rgba(106, 13, 173, 0.3)\']';
echo '}]';
echo '};';

echo ' options3 = {';
echo 'cutoutPercentage: 70,'; 
echo 'responsive: false,'; 
echo 'legend: {';
echo 'position: \'right\'';
echo '}';
echo '};';

echo 'ctx3 = document.getElementById(\'donutChart3\').getContext(\'2d\');';

echo ' donutChart3 = new Chart(ctx3, {';
echo 'type: \'doughnut\',';
echo 'data: data3,';
echo 'options: options3';
echo '});';

echo '</script>';

echo '</div>';
echo '</div>';

echo '<div id="dashTab" style="display: flex; flex-direction: row;">';

// First table section
echo '<div id="firstTab" style="display: flex; flex-direction: column; width: 49%; margin-right: 2%;">
        <table style="width: 100%;">
          <thead>
            <tr><th class="table-header" scope="col">RECENTLY BORROWED TOOLS</th></tr>
          </thead>
        </table>';
      
$borrowedtool = "SELECT * FROM tlog ORDER BY ID DESC LIMIT 3";
$borrowedtoolresult = mysqli_query($conn, $borrowedtool);

if (mysqli_num_rows($borrowedtoolresult)) {
    echo '<table class="margin-table" style="width: 100%;">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Borrower</th>
                <th scope="col">Returned At</th>
              </tr>
            </thead>
            <tbody>';

    while ($rows = mysqli_fetch_assoc($borrowedtoolresult)) {
        echo '<tr>
                <td>' . $rows['Name'] . '</td>
                <td>' . $rows['Quantity'] . '</td>
                <td  style="color: #32CD32">' . $rows['Borrower'] . '</td>';

        if (empty($rows['TimeOut'])) {
            echo '<td style="color: red;">Not Returned Yet</td>';
        } else {
            echo '<td style="color: blue;">' . $rows['TimeOut'] . '</td>';
        }

        echo '</tr>';
    }

    echo '</tbody>
        </table>';
} else {
    echo '<div class="todo-item">
            <h2>There are no borrowed tools recently</h2>
            <br>
            <small>Note: Make sure to click return borrowed item</small> 
          </div>';
}

echo '</div>'; // Close the first table section

// Second table section
echo '<div id="secondTab"style="display: flex; flex-direction: column; width: 49%;">
        <table style="width: 100%;">
          <thead>
            <tr><th class="table-header" scope="col">RECENTLY BORROWED EQUIPMENT</th></tr>
          </thead>
        </table>';
      
$borrowedequi = "SELECT * FROM elog ORDER BY ID DESC LIMIT 3";
$borrowedequiresult = mysqli_query($conn, $borrowedequi);

if (mysqli_num_rows($borrowedequiresult)) {
    echo '<table class="margin-table" style="width: 100%;">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Borrower</th>
                <th scope="col">Returned At</th>
              </tr>
            </thead>
            <tbody>';

    while ($rows = mysqli_fetch_assoc($borrowedequiresult)) {
        echo '<tr>
                <td>' . $rows['Name'] . '</td>
                <td>' . $rows['Quantity'] . '</td>
                <td style="color: #32CD32">' . $rows['Borrower'] . '</td>';

        if (empty($rows['TimeOut'])) {
            echo '<td style="color: red;">Not Returned Yet</td>';
        } else {
            echo '<td style="color: blue;">' . $rows['TimeOut'] . '</td>';
        }

        echo '</tr>';
    }

    echo '</tbody>
        </table>';
} else {
    echo '<div class="todo-item">
            <h2>There are no borrowed equipment recently</h2>
            <br>
            <small>Note: Make sure to click return borrowed item</small> 
          </div>';
}

echo '</div>'; // Close the second table section
echo '</div>'; // Close the parent flex container



} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>