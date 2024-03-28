<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $quant = $_POST['quant'];
    $status = $_POST['status'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $date = $_POST['date'];
    $upid = $_POST['upid'];

    $execute = "SELECT * FROM elog"; 
    $executeres = mysqli_query($conn, $execute);

    
    $queryquan = "SELECT * FROM equipment WHERE ID = $upid"; 
    $queryres = mysqli_query($conn, $queryquan);
    $equip = mysqli_fetch_assoc($queryres);
    $quantity = $equip['Quantity'];
    $stats = $equip['Status'];
    $GID = $equip['GID'];

    if($stats == 'Defective'){
        $fetchID = "SELECT * FROM equipment WHERE ID = $GID"; 
        $fetchIDres = mysqli_query($conn, $fetchID);
        $IDfetch = mysqli_fetch_assoc($fetchIDres);
        $MainID = $IDfetch['Status'];
        $QuanMain = $IDfetch['Quantity'];
        $main = $IDfetch['ID'];
        if($GID == $main){
            $superTotal = $QuanMain + $quantity;
            $check3 = "UPDATE equipment SET Quantity = '$superTotal' WHERE ID = $main";
            $checkres3 = mysqli_query($conn, $check3);
            $deleteborrow = "DELETE FROM equipment WHERE ID = $upid";
            $delres = mysqli_query($conn, $deleteborrow);
        }else{
            $check = "UPDATE equipment SET Quantity = '$quant', Status = '$status', Name = '$name', Brand = '$brand', Date = '$date' WHERE ID = $upid";
            $checkres = mysqli_query($conn, $check);
        }
    }else{

    if($quantity <= $quant){
        $check = "UPDATE equipment SET Quantity = '$quant', Status = '$status', Name = '$name', Brand = '$brand', Date = '$date' WHERE ID = $upid";
        $checkres = mysqli_query($conn, $check);
    }else{
        if($status === $stats){
            $check = "UPDATE equipment SET Quantity = '$quant', Status = '$status', Name = '$name', Brand = '$brand', Date = '$date' WHERE ID = $upid";
            $checkres = mysqli_query($conn, $check);
        }else{
        $total = $quantity - $quant;
        $check = "INSERT INTO equipment(GID, Name, Brand, Date, Quantity, Status) 
        VALUES('$upid', '$name', '$brand', '$date', '$quant', '$status')";
        $checkres = mysqli_query($conn, $check);

        $check2 = "UPDATE equipment SET Quantity = '$total' WHERE ID = $upid";
        $checkres2 = mysqli_query($conn, $check2);
        }
    }
}
   
        
if ($executeres) {
   
        echo '<div class="alert alert-success" role="alert">';
        echo "Equipment Updated Successfuly";
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