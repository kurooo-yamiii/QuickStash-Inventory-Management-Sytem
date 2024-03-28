<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    date_default_timezone_set('Asia/Manila');
    $did = $_POST['rid'];
    $in = date("M d Y H:iA");
   
    $gid = "SELECT * FROM equipment WHERE ID = $did"; 
    $gidres = mysqli_query($conn, $gid);
    $gidfetch = mysqli_fetch_assoc($gidres);
    $logid = $gidfetch['GID'];
    $returnquantity = $gidfetch['Quantity'];
    $name = $gidfetch['Name'];

    $checkname = "SELECT * FROM equipment WHERE Name = '$name' AND (Status = 'Working' OR Status = 'Defective')"; 
    $checkresult = mysqli_query($conn, $checkname);
    if (mysqli_num_rows($checkresult) <= 0) {
        $check = "UPDATE elog SET TimeOut = '$in' WHERE TID = $did" ;
        $checkres = mysqli_query($conn, $check);

        $up = "UPDATE equipment SET Status = 'Working' WHERE ID = $did" ;
        $upres = mysqli_query($conn, $up);
    }else{
    $check = "UPDATE elog SET TimeOut = '$in' WHERE ID = $logid" ;
    $checkres = mysqli_query($conn, $check);

    $query2 = "SELECT * FROM elog WHERE ID = $logid"; 
    $rs2 = mysqli_query($conn, $query2);
    $fetch2 = mysqli_fetch_assoc($rs2);
    $mainID = $fetch2['TID'];

    $query3 = "SELECT * FROM equipment WHERE ID = $mainID"; 
    $rs3 = mysqli_query($conn, $query3);
    $fetch3 = mysqli_fetch_assoc($rs3);
    $oldquantity = $fetch3['Quantity'];

    $newquantity = $oldquantity + $returnquantity;

    $up = "UPDATE equipment SET Quantity = '$newquantity' WHERE ID = $mainID" ;
    $upres = mysqli_query($conn, $up);  

    $deleteborrow = "DELETE FROM equipment WHERE ID = $did";
    $delres = mysqli_query($conn, $deleteborrow);
}

if ($checkres) {
   
           
    echo '<div class="alert alert-success" role="alert">';
    echo "Equipment Returned Successfuly";
    echo '</div>';

    echo '<table><thead>
    <tr><th class="table-header" scope="col">WORKING EQUIPMENT</th></tr>
</thead></table>';

$sql = "SELECT * FROM equipment WHERE Status = 'Working'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)) {
    echo '<table class="margin-table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Brand</th>
            <th scope="col">Date Received</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>';
    
    $i = 0;
    while ($rows = mysqli_fetch_assoc($result)) {
        $i++;
        echo '<tr>
            <td>' . $rows['Name'] . '</td>
            <td>' . $rows['Brand'] . '</td>
            <td>' . $rows['Date'] . '</td>
            <td>' . $rows['Quantity'] . '</td>
            <td>' . $rows['Status'] . '</td>
            <td><a onclick="laptopDelete(' . $rows['ID'] . ')" type="button"
                class="red-button">Delete</a>
                <a onclick="constructUpdate(' . $rows['ID'] . ')" type="button"
                class="blue-button">Update</a>
                <a onclick="constructBorrow(' . $rows['ID'] . ')" type="button"
                class="green-button">Borrow</a>
            </td>
        </tr>';
    }
    echo '</tbody>
    </table>';
} else {
    echo '<div class="todo-item">
    <h2>No working equipment listed currently</h2>
    <br>
    <small>Note: You can list equipment by clicking the add button from the top</small> 
    </div>';
}

echo '<table><thead>
    <tr><th class="table-header" scope="col">DEFECTIVE EQUIPMENT</th></tr>
</thead></table>';

$sql2 = "SELECT * FROM equipment WHERE Status = 'Defective'";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2)) {
    echo '<table class="margin-table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Brand</th>
            <th scope="col">Date Received</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>';
    
    $i = 0;
    while ($rows = mysqli_fetch_assoc($result2)) {
        $i++;
        echo '<tr>
            <td>' . $rows['Name'] . '</td>
            <td>' . $rows['Brand'] . '</td>
            <td>' . $rows['Date'] . '</td>
            <td>' . $rows['Quantity'] . '</td>
            <td>' . $rows['Status'] . '</td>
            <td><a onclick="laptopDelete(' . $rows['ID'] . ')" type="button"
                class="red-button">Delete</a>
                <a onclick="constructUpdate(' . $rows['ID'] . ')" type="button"
                class="blue-button">Update</a>
            </td>
        </tr>';
    }
    echo '</tbody>
    </table>';
} else {
    echo '<div class="todo-item">
    <h2>No defective equipment listed currently</h2>
    <br>
    <small>Note: You can list equipment by clicking the add button from the top</small> 
    </div>';
}

echo '<table><thead>
    <tr><th class="table-header" scope="col">BORROWED EQUIPMENT</th></tr>
</thead></table>';

$sql3 = "SELECT * FROM equipment WHERE Status = 'Borrowed'";
$result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result3)) {
    echo '<table class="margin-table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Brand</th>
            <th scope="col">Date Received</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>';
    
    $i = 0;
    while ($rows = mysqli_fetch_assoc($result3)) {
        $i++;
        echo '<tr>
            <td>' . $rows['Name'] . '</td>
            <td>' . $rows['Brand'] . '</td>
            <td>' . $rows['Date'] . '</td>
            <td>' . $rows['Quantity'] . '</td>
            <td>' . $rows['Status'] . '</td>
            <td>
                <a onclick="returnBorrow(' . $rows['ID'] . ')" type="button"
                class="violet-button">Return</a>
            </td>
        </tr>';
    }
    echo '</tbody>
    </table>';
} else {
    echo '<div class="todo-item">
    <h2>No borrowed equipment listed currently</h2>
    <br>
    <small>Note: You can list equipment by clicking the add button from the top</small> 
    </div>';
}

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>