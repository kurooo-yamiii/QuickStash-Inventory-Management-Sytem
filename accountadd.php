<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $username = $_POST['user']."@gmail.com";
    $password = $_POST['pass'];
   
  
    // Checking Cooperating Teacher
    $check = "INSERT INTO login( Name, Username, Password,  Status) 
    VALUES('$name', '$username', '$password', 0)";
    $checkres = mysqli_query($conn, $check);

        
if ($checkres) {

    echo '<div class="alert alert-success" role="alert">';
    echo "Account is Created Successfully";
    echo '</div>';

    echo '<table><thead>
    <tr><th class="table-header" scope="col">ACCOUNTS</th></tr>
</thead></table>';

$sql = "SELECT * FROM login";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)) {
    echo '<table class="margin-table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
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
                <td>' . $rows['Username'] . '</td>
                <td>' . $rows['Password'] . '</td>';
        if ($rows['Status'] == 1) {
            echo '<td style="color: blue;">Laboratory Head</td>
            <td><a onclick="constructAccount(' . $rows['ID'] . ')" type="button"
            class="blue-button">Edit</a></td>';
        } else {
            echo '<td style="color: violet;">Laboratory Co-Head</td>';
            echo '<td><a onclick="accconsDel(' . $rows['ID'] . ')" type="button"
            class="red-button">Delete</a>
            <a onclick="constructAccount(' . $rows['ID'] . ')" type="button"
                class="blue-button">Edit</a>
                </td>';
        }
      
        echo'</tr>';
    }
    echo '</tbody>
        </table>';
} else {
    echo '<div class="todo-item">
            <h2>There is no existing account</h2>
            <br>
            <small>Note: You can create an account by clicking the add button above</small> 
        </div>';
}



} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>