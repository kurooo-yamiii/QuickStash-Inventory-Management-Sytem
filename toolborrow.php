<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    date_default_timezone_set('Asia/Manila');
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $borrower = $_POST['borrower'];
    $tbid = $_POST['tbid'];
    $in = date("M Y d H:iA");
    $date = date("Y-m-d");
   
    $check = "INSERT INTO tlog(TID, Name, Brand, Borrower, Quantity, TimeIn, TimeOut, Status) 
    VALUES('$tbid', '$name', '$brand', '$borrower', '$qty', '$in' , '' ,'$status')";
    $checkres = mysqli_query($conn, $check);
    $lastInsertedID = $conn->insert_id;

    $queryquan = "SELECT * FROM tools WHERE ID = $tbid"; 
    $queryres = mysqli_query($conn, $queryquan);
    $tool = mysqli_fetch_assoc($queryres);
    $quantity = $tool['Quantity'];

    if($quantity <= $qty){
            $up = "UPDATE tools SET Status = 'Borrowed' WHERE ID = $tbid" ;
            $upres = mysqli_query($conn, $up); 
    }else{
        $newquan = $quantity - $qty;
        $up2 = "UPDATE tools SET Quantity = '$newquan' WHERE ID = $tbid" ;
        $upres2 = mysqli_query($conn, $up2); 

        $check = "INSERT INTO tools(GID, Name, Brand, Date, Quantity, Status) 
        VALUES('$lastInsertedID', '$name', '$brand', '$date', '$qty', 'Borrowed')";
        $checkres = mysqli_query($conn, $check);
            }  
        
if ($checkres) {

    echo '<div class="alert alert-success" role="alert">';
    echo "Tool Borrowed Successfuly";
    echo '</div>';

    echo '<table><thead>
    <tr><th class="table-header" scope="col">WORKING TOOLS</th></tr>
</thead></table>';

$sql = "SELECT * FROM tools WHERE Status = 'Working'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)) {
    echo '<table class="margin-table"><thead>
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
            <td><a onclick="deleteTool(' . $rows['ID'] . ')" type="button" class="red-button">Delete</a>
                <a onclick="toolconsUpdate(' . $rows['ID'] . ')" type="button" class="blue-button">Update</a>
                <a onclick="toolconsBorrow(' . $rows['ID'] . ')" type="button" class="green-button">Borrow</a>
            </td>
        </tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<div class="todo-item">
        <h2>No working tools matched your searched item</h2>
        <br>
        <small>Note: You can list a tools by clicking the add button from the top</small> 
    </div>';
}

echo '<table><thead>
    <tr><th class="table-header" scope="col">DEFECTIVE TOOLS</th></tr>
</thead></table>';

$sql2 = "SELECT * FROM tools WHERE Status = 'Defective'";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2)) {
    echo '<table class="margin-table"><thead>
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
            <td><a onclick="deleteTool(' . $rows['ID'] . ')" type="button" class="red-button">Delete</a>
                <a onclick="toolconsUpdate(' . $rows['ID'] . ')" type="button" class="blue-button">Update</a>
            </td>
        </tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<div class="todo-item">
         <h2>No defective tools matched your searched item</h2>
        <br>
        <small>Note: You can list a tools by clicking the add button from the top</small> 
    </div>';
}

echo '<table><thead>
    <tr><th class="table-header" scope="col">BORROWED TOOLS</th></tr>
</thead></table>';

$sql3 = "SELECT * FROM tools WHERE Status = 'Borrowed'";
$result3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($result3)) {
    echo '<table class="margin-table"><thead>
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
            <td><a onclick="deleteTool(' . $rows['ID'] . ')" type="button" class="red-button">Delete</a>
                <a onclick="toolconsUpdate(' . $rows['ID'] . ')" type="button" class="blue-button">Update</a>
                <a onclick="toolreturn(' . $rows['ID'] . ')" type="button" class="violet-button">Return</a>
            </td>
        </tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<div class="todo-item">
         <h2>No borrowed tools matched your searched item</h2>
        <br>
        <small>Note: You can list a tools by clicking the add button from the top</small> 
    </div>';
}

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>