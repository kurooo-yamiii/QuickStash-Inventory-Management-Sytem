<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    $status = $_POST['status'];
    $title = strtoupper($_POST['status']);
  
    // Checking Cooperating Teacher
    $check = "SELECT * FROM equipment WHERE Status = '$status'";
    $checkres = mysqli_query($conn, $check);

        
if ($checkres) {
    echo '<table><thead>
    <tr><th class="table-header" scope="col">'. $title .' EQUIPMENT</th></tr>
</thead></table>';

    if (mysqli_num_rows($checkres)) {
        echo '<table class="margin-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Name</th>';
        echo '<th scope="col">Brand</th>';
        echo '<th scope="col">Date Received</th>';
        echo '<th scope="col">Quantity</th>';
        echo '<th scope="col">Status</th>';
        echo '<th scope="col">Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
    
        $i = 0;
        while ($rows = mysqli_fetch_assoc($checkres)) {
            $i++;
            echo '<tr>';
            echo '<td>' . $rows['Name'] . '</td>';
            echo '<td>' . $rows['Brand'] . '</td>';
            echo '<td>' . $rows['Date'] . '</td>';
            echo '<td>' . $rows['Quantity'] . '</td>';
            echo '<td>' . $rows['Status'] . '</td>';
            echo '<td>';
            if ($status == 'Working'){
            echo '<a onclick="laptopDelete(' . $rows['ID'] . ')" type="button" class="red-button">Delete</a>';
            echo '<a onclick="constructUpdate(' . $rows['ID'] . ')" type="button" class="blue-button">Update</a>';
            echo '<a onclick="constructBorrow(' . $rows['ID'] . ')" type="button" class="green-button">Borrow</a>';
            }else if ($status == 'Defective') {
                echo '<a onclick="laptopDelete(' . $rows['ID'] . ')" type="button" class="red-button">Delete</a>';
                echo '<a onclick="constructUpdate(' . $rows['ID'] . ')" type="button" class="blue-button">Update</a>';
                }else {
                 
                    echo '<a onclick="returnBorrow(' . $rows['ID'] . ')" type="button" class="violet-button">Return</a>';
                }
            echo '</td>';
            echo '</tr>';
        }
    
        echo '</tbody>';
        echo '</table>';
    } else {
        if ($status == 'Working'){
            echo '<div class="todo-item">
            <h2>No working equipment matched your searched item</h2>
            <br>
            <small>Note: You can list a equipment by clicking the add button from the top</small> 
        </div>';
        } else if ($status == 'Defective'){
            echo '<div class="todo-item">
            <h2>No defective equipment matched your searched item</h2>
            <br>
            <small>Note: You can list a equipment by clicking the add button from the top</small> 
        </div>';
        }else {
            echo '<div class="todo-item">
            <h2>No borrowed equipment matched your searched item</h2>
            <br>
            <small>Note: You can list a equipment by clicking the add button from the top</small> 
        </div>';
        }
    } 
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>