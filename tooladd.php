<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $status = $_POST['status'];
    $date = $_POST['date'];
    $brand = $_POST['brand'];
    $qty = $_POST['qty'];
  
    // Checking Cooperating Teacher
    $check = "INSERT INTO tools(GID, Name, Brand, Date, Quantity, Status) 
    VALUES('', '$name', '$brand', '$date', '$qty', '$status')";
    $checkres = mysqli_query($conn, $check);

        
if ($checkres) {

    echo '<div class="alert alert-success" role="alert">';
    echo "Tool Listed Successfuly";
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
            <td>
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