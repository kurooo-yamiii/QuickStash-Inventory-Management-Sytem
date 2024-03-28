<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    
    $search = $_POST['search'];
  
    $check = "SELECT * FROM tools";
    $checkres = mysqli_query($conn, $check);;

        
if ($checkres) {
  echo '<table><thead>
  <tr><th class="table-header" scope="col">EQUIPMENT LOG HISTORY</th></tr>
</thead></table>';
$sql3 = "SELECT * FROM elog WHERE Name LIKE '%$search%' OR TimeIn LIKE '%$search%' OR Borrower LIKE '%$search%'";
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3)) {
echo '
  <table class="margin-table">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Brand</th>
        <th scope="col">Quantity</th>
        <th scope="col">Borrower</th>
        <th scope="col">Borrowed At</th>
        <th scope="col">Returned At</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>';
$i = 0;
while ($rows = mysqli_fetch_assoc($result3)) {
$i++;
echo '<tr>
      <td>' . $rows['Name'] . '</td>
      <td>' . $rows['Brand'] . '</td>
      <td>' . $rows['Quantity'] . '</td>
      <td>' . $rows['Borrower'] . '</td>
      <td style="color: green;">' . $rows['TimeIn'] . '</td>';
if (empty($rows['TimeOut'])) {
  echo '<td style="color: red;">Not Returned Yet</td>';
} else {
  echo '<td style="color: blue;">' . $rows['TimeOut'] . '</td>';
}
echo '<td>' . $rows['Status'] . '</td>
    </tr>';
}
echo '</tbody>
</table>';
} else {
echo '<div class="todo-item">
      <h2>No log for equipment match your searched term</h2>
      <br>
      <small>Note: You can borrow equipment from equipment inventory form</small> 
    </div>';
}



echo '<table><thead>
    <tr><th class="table-header" scope="col">TOOLS LOG HISTORY</th></tr>
  </thead></table>';
$sql2 = "SELECT * FROM tlog WHERE Name LIKE '%$search%' OR TimeIn LIKE '%$search%' OR Borrower LIKE '%$search%'";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2)) {
echo '
    <table class="margin-table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Brand</th>
          <th scope="col">Quantity</th>
          <th scope="col">Borrower</th>
          <th scope="col">Borrowed At</th>
          <th scope="col">Returned At</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>';
$i = 0;
while ($rows = mysqli_fetch_assoc($result2)) {
$i++;
echo '<tr>
        <td>' . $rows['Name'] . '</td>
        <td>' . $rows['Brand'] . '</td>
        <td>' . $rows['Quantity'] . '</td>
        <td>' . $rows['Borrower'] . '</td>
        <td style="color: green;">' . $rows['TimeIn'] . '</td>';
if (empty($rows['TimeOut'])) {
    echo '<td style="color: red;">Not Returned Yet</td>';
} else {
    echo '<td style="color: blue;">' . $rows['TimeOut'] . '</td>';
}
echo '<td>' . $rows['Status'] . '</td>
      </tr>';
}
echo '</tbody>
</table>';
} else {
echo '<div class="todo-item">
        <h2>No log for tools match your searched term</h2>
        <br>
        <small>Note: You can borrow tools from tools inventory form</small> 
      </div>';
}

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>