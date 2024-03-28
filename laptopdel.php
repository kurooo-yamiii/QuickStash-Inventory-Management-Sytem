<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $delid = $_POST['delid'];
    
  
    // Checking Cooperating Teacher
    $check = "DELETE FROM equipment WHERE ID = $delid";
    $checkres = mysqli_query($conn, $check);

        
if ($checkres) {
   
       
    echo '<div class="alert alert-success" role="alert">';
    echo "Equipment Deleted Successfuly";
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