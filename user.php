<?php
include 'db_conn.php';
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['Name'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="resources/techy.png" type="image/x-icon">
	<!-- icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
	<!-- My CSS -->
	<link rel="stylesheet" href="user.css">
        <link rel="stylesheet" href="usermedia.css">
	<script src="user.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<title>QuickStash - Laboratory Co-Head</title>
</head>
<body>
	<!-- SIDEBAR -->
	<header class="header">
	<h2 class="u-name">QUICK<b> STASH</b> 
			</h2>
			<h2 class="u-name">RIZAL TECHNOLOGICAL UNIVERSITY
			</h2>
			<div id="sideicon">
			<img  src="resources/techy.png">
			<img  src="resources/cedlogo.png">
		
			</div>
		</header>
		<style>
		#printForm{
			display: none;
		}
		#manageAccount{
			display: none;
			}
        #laptopInventory{
            display: none;
        }
		#toolInventory{
			display: none;
		}
		#logHistory{
			display: none;
		}
		#dashBoard{
			display: none;
		}
			
    </style>
		<div class="body">
			<nav class="side-bar">
			<div class="user-p">
          
		  <img  src="resources/techy.png">
	   </div>
	   
				<ul>
					<li id="btndashboard">
						<b onclick="dashboardShow()">
						<a style="text-decoration: none; color: #eee;">
						<div class="direction">
						<span class="material-icons-outlined" id="iconblue">dashboard</span>
						<p>Dashboard</p>
						</div>
						</a>
						</b>
					</li>

					<li id="btnlaptop">
						<b onclick="laptopShow()">
						<a style="text-decoration: none; color: #eee;">
						<div class="direction">
						<span class="material-icons-outlined" id="iconblue3">home_repair_service</span>
						<p id="layoutbtn">Equipment</p>
						</div>
						</a>
						</b>
					</li>

					<li id="btntools">
						<b onclick="toolsShow()">
						<a style="text-decoration: none; color: #eee;">
						<div class="direction">
						<span class="material-icons-outlined" id="iconblue3">construction</span>
						<p id="layoutbtn">Tools</p>
						</div>
						</a>
						</b>
					</li>

					<li id="btnlog">
						<b onclick="logShow()">
						<a style="text-decoration: none; color: #eee;">
						<div class="direction">
						<span class="material-icons-outlined" id="iconblue3">receipt_long</span>
						<p id="layoutbtn">Log History</p>
						</div>
						</a>
						</b>
					</li>


					<li id="btnprint">
						<b onclick="printShow()">
						<a style="text-decoration: none; color: #eee;">
						<div class="direction">
						<span class="material-icons-outlined" id="iconblue3">print</span>
						<p id="layoutbtn">Print</p>
						</div>
						</a>
						</b>
					</li>


					<li id="btrout">
							<a href="logout.php" style="text-decoration: none; color: #eee;">
							<div class="direction">
							<span class="material-icons-outlined" id="iconblue3">logout</span>
						<p id="layoutbtn">Logout</p>
						</div>
						</a>
						</b>
					</li>
	
					
				</ul>
			</nav>

	<section id="content">
	<form method="post" action="" id="dashBoard">
	<div id="fetchDashboard2">
	
	
	
				  </div>
	</form>


	<form method="post" action="" id="laptopInventory">
			
		<div class="switch-div">
					<div class="utility">
					<label for="search" class="search-label">Search:</label>
					<input type="text" name="search" id="search" placeholder="Enter Date/Name/Brand " class="search-input">

					<button type="button" onclick="searchRecords(document.getElementById('search').value)" class="search-button">Search</button>
					<button type="button" onclick="showAddEquip()" class="search-button" style="background-color: #0074D9;">Create</button>
					</div>
					<div class="radio-container">
					<input type="radio" id="all" name="status" value="All" onchange="statusAll('All')">
					<label for="all">All</label>

					<input type="radio" id="working" name="status" value="Working" onchange="statusChoose('Working')">
					<label for="working">Working</label>

					<input type="radio" id="defective" name="status" value="Defective" onchange="statusChoose('Defective')">
					<label for="defective">Defective</label>

					<input type="radio" id="borrowed" name="status" value="Borrowed" onchange="statusChoose('Borrowed')">
					<label for="borrowed">Borrowed</label>
					</div>
		</div>
		<div class="space"></div>
		<div class="divider"></div>

		<div id="fetchResult">
		<table><thead>
			<tr><th class="table-header" scope="col">WORKING EQUIPMENT</th></tr>
		</thead></table>
		<?php    
		$sql = "SELECT * FROM equipment WHERE Status = 'Working'";
			$result = mysqli_query($conn, $sql);
			?>
			<?php 
			if (mysqli_num_rows($result)) { ?>
			<table class="margin-table">
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
				<tbody>
				<?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result)){
			  	   $i++;
			  	 ?>
				  <tr>
					<td><?php echo $rows['Name']; ?></td>
					<td><?php echo $rows['Brand']; ?></td>
					<td><?php echo $rows['Date']; ?></td>
					<td><?php echo $rows['Quantity']; ?></td>
					<td><?php echo $rows['Status']; ?></td>
					<td><a onclick="laptopDelete(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="red-button">Delete</a>
						   <a onclick="constructUpdate(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="blue-button">Update</a>
						   <a onclick="constructBorrow(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="green-button">Borrow</a>
                    </td>
				  </tr>
				  <?php } ?>
				</tbody>
			  </table>
			  <?php }else{ ?>
				<div class="todo-item">
				<h2>No working equipment listed currently</h2>
				<br>
				<small>Note: You can list equipment by clicking the add button from the top</small> 
				
				</div>
			  <?php } ?>

		<table><thead>
			<tr><th class="table-header" scope="col">DEFECTIVE EQUIPMENT</th></tr>
		</thead></table>
		<?php    
		$sql2 = "SELECT * FROM equipment WHERE Status = 'Defective'";
			$result2 = mysqli_query($conn, $sql2);
			?>
			<?php 
			if (mysqli_num_rows($result2)) { ?>
			<table class="margin-table">
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
				<tbody>
				<?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result2)){
			  	   $i++;
			  	 ?>
				  <tr>
					<td><?php echo $rows['Name']; ?></td>
					<td><?php echo $rows['Brand']; ?></td>
					<td><?php echo $rows['Date']; ?></td>
					<td><?php echo $rows['Quantity']; ?></td>
					<td><?php echo $rows['Status']; ?></td>
					<td><a onclick="approvalDelete(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="red-button">Delete</a>
						   <a onclick="constructUpdate(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="blue-button">Update</a>
                    </td>
				  </tr>
				  <?php } ?>
				</tbody>
			  </table>
			  <?php }else{ ?>
				<div class="todo-item">
				<h2>No defective equipment listed currently</h2>
				<br>
				<small>Note: You can list equipment by clicking the add button from the top</small> 
				
				</div>
			  <?php } ?>

			  
		<table><thead>
			<tr><th class="table-header" scope="col">BORROWED EQUIPMENT</th></tr>
		</thead></table>
		<?php    
		$sql3 = "SELECT * FROM equipment WHERE Status = 'Borrowed'";
			$result3 = mysqli_query($conn, $sql3);
			?>
			<?php 
			if (mysqli_num_rows($result3)) { ?>
			<table class="margin-table">
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
				<tbody>
				<?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result3)){
			  	   $i++;
			  	 ?>
				  <tr>
					<td><?php echo $rows['Name']; ?></td>
					<td><?php echo $rows['Brand']; ?></td>
					<td><?php echo $rows['Date']; ?></td>
					<td><?php echo $rows['Quantity']; ?></td>
					<td><?php echo $rows['Status']; ?></td>
					<td><a onclick="approvalDelete(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="red-button">Delete</a>
                           <a onclick="constructUpdate(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="blue-button">Update</a>
						   <a onclick="returnBorrow(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="violet-button">Return</a>
                    </td>
				  </tr>
				  <?php } ?>
				</tbody>
			  </table>
			  <?php }else{ ?>
				<div class="todo-item">
				<h2>No borrowed equipment listed currently</h2>
				<br>
				<small>Note: You can list equipment by clicking the add button from the top</small> 
				
				</div>
			  <?php } ?>
			  </div>
		</form>

		<!-- ADD POP UP FOMR -->
		<div id="overlay">
        
            <form id="inventoryForm">
					<div class="form-group">
					<div class="remove-space"></div>
					<table><thead>
					<tr><th class="table-header" scope="col">ADD EQUIPMENT</th></tr>
					</thead></table>
					<div class="space"></div>	
				
			
					<input type="text" id="name" name="name" placeholder="Name" required>
					
					<input type="text" id="brand"  name="brand" placeholder="Brand" required>
					
					<input type="date" id="date" name="date" placeholder="Date" required>

					<input type="number" id="quan" name="quan" placeholder="Quantity" min="1" required>
					
					<select id="status" name="status" required>
					<option value="Working">Working</option>
					<option value="Defective">Defective</option>
				
					</select>

					</div>
					<div class="space"></div>
					
				<div class="choice-container">
                <button class="choice-button" type="button" onclick="addItem()">Add Equipment</button>
				<button class="choice-button" id=""  onclick="hidePopupForm()">Close</button>
				</div>
            </form>
         
    
    	</div>
		
		  <!-- UPDATE POP UP FORM -->
		<div id="overlay2">
        
          
            <form id="inventoryForm2">
					<div class="form-group">
					<div class="remove-space"></div>
					<table><thead>
					<tr><th class="table-header" scope="col">UPDATE INFORMATION</th></tr>
					</thead></table>
					<div class="space"></div>	

					<diV id="updateConstruct">
					

					</div>
					</diV>
					<div class="space"></div>
					
				<div class="choice-container">
                <button class="choice-button" type="button" onclick="updateItem()">Update Item</button>
				<button class="choice-button" id="preventButton2" onclick="hide2PopupForm()">Close</button>
				</div>
            </form>
         
        
    	</div>

		 <!-- BORROW POP UP FORM -->
		 <div id="overlay3">
        
          
		<form id="inventoryForm3">
				<div class="form-group">
				<div class="remove-space"></div>
				<table><thead>
				<tr><th class="table-header" scope="col">BORROW ITEM</th></tr>
				</thead></table>
				<div class="space"></div>	

				<diV id="borrowConstruct">
				
			
				</div>
				</diV>
				<div class="space"></div>
				
			<div class="choice-container">
			<button class="choice-button" type="button" onclick="borrowItem()">Borrow</button>
			<button class="choice-button" id="preventButton" onclick="hide3PopupForm()">Close</button>
			</div>
		</form>
		
	 
	
	</div>

		<!-- DELETE POP UP FOMR -->
		<div id="overlay4">
        
            <form id="inventoryForm4">
					<div class="form-group">
					<div class="remove-space"></div>
					<table><thead>
					<tr><th class="table-header" scope="col">DELETE EQUIPMENT</th></tr>
					</thead></table>
					<div class="space"></div>	
					<diV id="deleteConstruct">
				
			
					</div>

					</div>
					<div class="space"></div>
					
				<div class="choice-container">
                <button class="choice-button" type="button" onclick="deleteItem()">Yes</button>
				<button class="choice-button" id=""  onclick="hide4PopupForm()">No</button>
				</div>
            </form>
         
    
    	</div>

	<form method="post" action="" id="toolInventory">
			
		<div class="switch-div">
					<div class="utility">
					<label for="search" class="search-label">Search:</label>
					<input type="text" name="search2" id="search2" placeholder="Enter Name/Brand/Date " class="search-input">

					<button type="button" onclick="searchTool(document.getElementById('search2').value)" class="search-button">Search</button>
					<button type="button" onclick="showtooladd()" class="search-button" style="background-color: #0074D9;">Create</button>
					</div>
					<div class="radio-container">
					<input type="radio" id="all" name="status" value="All" onchange="toolsAll('All')">
					<label for="all">All</label>

					<input type="radio" id="working" name="status" value="Working" onchange="toolsChoose('Working')">
					<label for="working">Working</label>

					<input type="radio" id="defective" name="status" value="Defective" onchange="toolsChoose('Defective')">
					<label for="defective">Defective</label>

					<input type="radio" id="borrowed" name="status" value="Borrowed" onchange="toolsChoose('Borrowed')">
					<label for="borrowed">Borrowed</label>
					</div>
		</div>
		<div class="space"></div>
		<div class="divider"></div>

		<div id="fetchTools">
		<table><thead>
			<tr><th class="table-header" scope="col">WORKING TOOLS</th></tr>
		</thead></table>
		<?php    
		$sql = "SELECT * FROM tools WHERE Status = 'Working'";
			$result = mysqli_query($conn, $sql);
			?>
			<?php 
			if (mysqli_num_rows($result)) { ?>
			<table class="margin-table">
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
				<tbody>
				<?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result)){
			  	   $i++;
			  	 ?>
				  <tr>
					<td><?php echo $rows['Name']; ?></td>
					<td><?php echo $rows['Brand']; ?></td>
					<td><?php echo $rows['Date']; ?></td>
					<td><?php echo $rows['Quantity']; ?></td>
					<td><?php echo $rows['Status']; ?></td>
					<td><a onclick="deleteTool(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="red-button">Delete</a>
						   <a onclick="toolconsUpdate(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="blue-button">Update</a>
						   <a onclick="toolconsBorrow(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="green-button">Borrow</a>
                    </td>
				  </tr>
				  <?php } ?>
				</tbody>
			  </table>
			  <?php }else{ ?>
				<div class="todo-item">
				<h2>No working tools listed currently</h2>
				<br>
				<small>Note: You can list tools by clicking the add button from the top</small> 
				
				</div>
			  <?php } ?>

		<table><thead>
			<tr><th class="table-header" scope="col">DEFECTIVE TOOLS</th></tr>
		</thead></table>
		<?php    
		$sql2 = "SELECT * FROM tools WHERE Status = 'Defective'";
			$result2 = mysqli_query($conn, $sql2);
			?>
			<?php 
			if (mysqli_num_rows($result2)) { ?>
			<table class="margin-table">
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
				<tbody>
				<?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result2)){
			  	   $i++;
			  	 ?>
				  <tr>
					<td><?php echo $rows['Name']; ?></td>
					<td><?php echo $rows['Brand']; ?></td>
					<td><?php echo $rows['Date']; ?></td>
					<td><?php echo $rows['Quantity']; ?></td>
					<td><?php echo $rows['Status']; ?></td>
					<td><a onclick="deleteTool(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="red-button">Delete</a>
						   <a onclick="toolconsUpdate(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="blue-button">Update</a>
                    </td>
				  </tr>
				  <?php } ?>
				</tbody>
			  </table>
			  <?php }else{ ?>
				<div class="todo-item">
				<h2>No defective tools listed currently</h2>
				<br>
				<small>Note: You can list tools by clicking the add button from the top</small> 
				
				</div>
			  <?php } ?>

			  
		<table><thead>
			<tr><th class="table-header" scope="col">BORROWED TOOLS</th></tr>
		</thead></table>
		<?php    
		$sql3 = "SELECT * FROM tools WHERE Status = 'Borrowed'";
			$result3 = mysqli_query($conn, $sql3);
			?>
			<?php 
			if (mysqli_num_rows($result3)) { ?>
			<table class="margin-table">
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
				<tbody>
				<?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result3)){
			  	   $i++;
			  	 ?>
				  <tr>
					<td><?php echo $rows['Name']; ?></td>
					<td><?php echo $rows['Brand']; ?></td>
					<td><?php echo $rows['Date']; ?></td>
					<td><?php echo $rows['Quantity']; ?></td>
					<td><?php echo $rows['Status']; ?></td>
					<td><a onclick="deleteTool(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="red-button">Delete</a>
                           <a onclick="toolconsUpdate(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="blue-button">Update</a>
						   <a onclick="toolreturn(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="violet-button">Return</a>
                    </td>
				  </tr>
				  <?php } ?>
				</tbody>
			  </table>
			  <?php }else{ ?>
				<div class="todo-item">
				<h2>No borrowed tools listed currently</h2>
				<br>
				<small>Note: You can list tools by clicking the add button from the top</small> 
				
				</div>
			  <?php } ?>
			  </div>
		</form>

		<!-- ADD POP UP FOMR -->
		<div id="tooloverlay">
        
            <form id="toolForm">
					<div class="form-group">
					<div class="remove-space"></div>
					<table><thead>
					<tr><th class="table-header" scope="col">ADD TOOLS</th></tr>
					</thead></table>
					<div class="space"></div>	
			
					<input type="text" id="tname" name="tname" placeholder="Name" required>
					
					<input type="text" id="tbrand"  name="tbrand" placeholder="Brand" required>
					
					<input type="date" id="tdate" name="tdate" placeholder="Date" required>

					<input type="number" id="qty" name="qty" placeholder="Quantity" min="1" required>
					
					<select id="tstatus" name="tstatus" required>
					<option value="Working">Working</option>
					<option value="Defective">Defective</option>
				
					</select>

					</div>
					<div class="space"></div>
					
				<div class="choice-container">
                <button class="choice-button" type="button" onclick="addTool()">Add Item</button>
				<button class="choice-button" id="preventButton"  onclick="hidetooladd()">Close</button>
				</div>
            </form>
         
        
    	</div>

		<!-- UPDATE POP UP FOMR -->
		<div id="tooloverlay2">
        
            <form id="toolForm2">
					<div class="form-group">
					<div class="remove-space"></div>
					<table><thead>
					<tr><th class="table-header" scope="col">UPDATE TOOLS</th></tr>
					</thead></table>
					<div class="space"></div>	

					<diV id="toolConstruct">
					

					</div>

					

					</div>
					<div class="space"></div>
					
				<div class="choice-container">
                <button class="choice-button" type="button" onclick="updateTool()">Update Tool</button>
				<button class="choice-button" id="preventButton" onclick="hidetooladd2()">Close</button>
				</div>
            </form>
         
        
    	</div>

		 <!-- BORROW POP UP FORM -->
		 <div id="tooloverlay3">
        
          
		<form id="toolForm3">
				<div class="form-group">
				<div class="remove-space"></div>
				<table><thead>
				<tr><th class="table-header" scope="col">BORROW TOOL</th></tr>
				</thead></table>
				<div class="space"></div>	

				<diV id="toolborrowConstruct">
				
			
				</div>
				</diV>
				<div class="space"></div>
				
			<div class="choice-container">
			<button class="choice-button" type="button" onclick="borrowTool()">Borrow</button>
			<button id="preventButton" class="choice-button" onclick="hidetooladd3()">Close</button>
			</div>
		</form>
			  </div>

			  <!-- DELETE POP UP FOMR -->
		<div id="tooloverlay4">
        
		<form id="toolForm4">
				<div class="form-group">
				<div class="remove-space"></div>
				<table><thead>
				<tr><th class="table-header" scope="col">DELETE TOOL</th></tr>
				</thead></table>
				<div class="space"></div>	
				<diV id="tooldelConstruct">
			
		
				</div>

				</div>
				<div class="space"></div>
				
			<div class="choice-container">
			<button class="choice-button" type="button" onclick="deleteToolItem()">Yes</button>
			<button class="choice-button" id=""  onclick="hidetooladd4()">No</button>
			</div>
		</form>
	 

	</div>

	<form method="post" action="" id="logHistory">
			
		<div class="switch-div">
					<div class="utility">
					<label for="search" class="search-label">Search:</label>
					<input type="text" name="lsearch" id="lsearch" placeholder="Enter Borrower/Name/Borrowed " class="search-input" style="width: 230px;">

					<button type="button" onclick="searchLog(document.getElementById('lsearch').value)" class="search-button">Search</button>

					

					<button type="button" onclick="printLogForm()" id="printShow" class="search-button" style="background-color: #4B0082;">Print</button>
					<script>
					window.jsPDF = window.jspdf.jsPDF;
					</script>
					</div>
					<div class="radio-container">
					<input type="radio" id="all" name="status" value="All" onchange="logAll('All')">
					<label for="all">All</label>

					<input type="radio" id="tools" name="status" value="tools" onchange="logChoose('Tools')">
					<label for="tools">Tools</label>

					<input type="radio" id="laptop" name="status" value="laptop" onchange="logChoose('Laptop')">
					<label for="laptop">Equipment</label>

					</div>
		</div>
		<div class="space"></div>
		<div class="divider"></div>

		<div id="fetchLogHistory">
		<table><thead>
			<tr><th class="table-header" scope="col">LAPTOP LOG HISTORY</th></tr>
		</thead></table>
		<?php    
		$sql = "SELECT * FROM log";
			$result = mysqli_query($conn, $sql);
			?>
			<?php 
			if (mysqli_num_rows($result)) { ?>
			<table class="margin-table">
				<thead>
				  <tr>
					<th scope="col">Name</th>
					<th scope="col">Serial</th>
					<th scope="col">Brand</th>
					<th scope="col">Borrower</th>
					<th scope="col">Borrowed At</th>
					<th scope="col">Returned At</th>
					<th scope="col">Status</th>
				  </tr>
				</thead>
				<tbody>
				<?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result)){
			  	   $i++;
			  	 ?>
				  <tr>
					<td><?php echo $rows['Name']; ?></td>
					<td><?php echo $rows['Serial']; ?></td>
					<td><?php echo $rows['Brand']; ?></td>
					<td><?php echo $rows['Borrower']; ?></td>
					<td style="color: green;"><?php echo $rows['TimeIn']; ?></td>
										<?php if (empty($rows['TimeOut'])) { ?>
											<td style="color: red;">Not Returned Yet</td>
										<?php } else { ?>
											<td style="color: blue;"><?php echo $rows['TimeOut']; ?></td>
										<?php } ?>
					<td><?php echo $rows['Status']; ?></td>
				
				  </tr>
				  <?php } ?>
				</tbody>
			  </table>
			  <?php }else{ ?>
				<div class="todo-item">
				<h2>No log available for laptop currently</h2>
				<br>
				<small>Note: You can borrow laptop from laptop inventory form</small> 
				
				</div>
			  <?php } ?>

		<table><thead>
			<tr><th class="table-header" scope="col">TOOLS LOG HISTORY</th></tr>
		</thead></table>
		<?php    
		$sql2 = "SELECT * FROM tlog";
			$result2 = mysqli_query($conn, $sql2);
			?>
			<?php 
			if (mysqli_num_rows($result2)) { ?>
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
				<tbody>
				<?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result2)){
			  	   $i++;
			  	 ?>
				  <tr>
				 	<td><?php echo $rows['Name']; ?></td>
					<td><?php echo $rows['Brand']; ?></td>
					<td><?php echo $rows['Quantity']; ?></td>
					<td><?php echo $rows['Borrower']; ?></td>
					<td style="color: green;"><?php echo $rows['TimeIn']; ?></td>
										<?php if (empty($rows['TimeOut'])) { ?>
											<td style="color: red;">Not Returned Yet</td>
										<?php } else { ?>
											<td style="color: blue;"><?php echo $rows['TimeOut']; ?></td>
										<?php } ?>
					<td><?php echo $rows['Status']; ?></td>
				  </tr>
				  <?php } ?>
				</tbody>
			  </table>
			  <?php }else{ ?>
				<div class="todo-item">
				<h2>No log available for tools currently</h2>
				<br>
				<small>Note: You can borrow tools from tools inventory form</small> 
				
				</div>
			  <?php } ?>
			  </div>
		</form>
				 <!-- DELETE POP UP FOMR -->
		<div id="tooloverlay5">
        
		<form id="toolForm5">
		<diV id="logdelConstruct">
				<div class="form-group">
				<div class="remove-space"></div>
				<table><thead>
				<tr><th class="table-header" scope="col">DELETE LOG HISTORY</th></tr>
				</thead></table>
				<div class="space"></div>	
				
			
		
			

				</div>
				<div class="space"></div>
				
			<div class="choice-container">
			<button class="choice-button" type="button" onclick="deleteToolItem()">Yes</button>
			<button class="choice-button" id=""  onclick="hidetooladd4()">No</button>
			</div>
			</div>
		</form>
			  </div>

		<form method="post" action="" id="printForm">
			
		<div class="switch-div">
					<div class="utility">
					<label for="search" class="search-label">Search:</label>
					<input type="text" name="searchprint" id="searchprint" placeholder="Enter Name/Brand/Date " class="search-input">

					<button type="button" onclick="searchPrint(document.getElementById('searchprint').value)" class="search-button">Search</button>
					<button type="button" onclick="printInventory()" class="search-button" style="background-color: #4B0082;">Print</button>
					</div>
					<div class="radio-container">
						<input type="radio" id="showall" name="choice" value="All" onchange="printAll('All')">
						<label for="showall">All</label>

						<input type="radio" id="laptop" name="choice" value="laptop" onchange="printType('laptop')">
						<label for="laptop">Equipment</label>

						<input type="radio" id="tools" name="choice" value="tools" onchange="printType('tools')">
						<label for="tools">Tools</label>

						<input type="radio" id="printwork" name="choice" value="printwork" onchange="printChoose('Working')">
						<label for="printwork">Working</label>

						<input type="radio" id="pritndefect" name="choice" value="pritndefect" onchange="printChoose('Defective')">
						<label for="pritndefect">Defective</label>

						<input type="radio" id="pritnbor" name="choice" value="pritnbor" onchange="printChoose('Borrowed')">
						<label for="pritndefect">Borrowed</label>
					</div>

		</div>
		<div class="space"></div>
		<div class="divider"></div>

		<div id="fetchPrint">
		<table><thead>
			<tr><th class="table-header" scope="col">LAPTOP</th></tr>
		</thead></table>
		<?php    
		$sqll = "SELECT * FROM laptop";
			$resultl = mysqli_query($conn, $sqll);
			?>
			<?php 
			if (mysqli_num_rows($resultl)) { ?>
			<table class="margin-table">
				<thead>
				  <tr>
					<th scope="col">Name</th>
					<th scope="col">Brand</th>
					<th scope="col">Date Recieved</th>
					<th scope="col">Serial Number</th>
					<th scope="col">Status</th>
					
				  </tr>
				</thead>
				<tbody>
				<?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($resultl)){
			  	   $i++;
			  	 ?>
				  <tr>
					<td><?php echo $rows['Name']; ?></td>
					<td><?php echo $rows['Brand']; ?></td>
					<td><?php echo $rows['Date']; ?></td>
					<td><?php echo $rows['Serial']; ?></td>
					<td><?php echo $rows['Status']; ?></td>
				  </tr>
				  <?php } ?>
				</tbody>
			  </table>
			  <?php }else{ ?>
				<div class="todo-item">
				<h2>No laptop listed currently</h2>
				<br>
				<small>Note: You can list laptop by going in the laptop form</small> 
				
				</div>
			  <?php } ?>

			  <table><thead>
			<tr><th class="table-header" scope="col">TOOLS</th></tr>
		</thead></table>
		<?php    
		$sqlt = "SELECT * FROM tools";
			$resultt = mysqli_query($conn, $sqlt);
			?>
			<?php 
			if (mysqli_num_rows($resultt)) { ?>
			<table class="margin-table">
				<thead>
				  <tr>
					<th scope="col">Name</th>
					<th scope="col">Brand</th>
					<th scope="col">Date Received</th>
					<th scope="col">Quantity</th>
					<th scope="col">Status</th>
				
				  </tr>
				</thead>
				<tbody>
				<?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($resultt)){
			  	   $i++;
			  	 ?>
				  <tr>
					<td><?php echo $rows['Name']; ?></td>
					<td><?php echo $rows['Brand']; ?></td>
					<td><?php echo $rows['Date']; ?></td>
					<td><?php echo $rows['Quantity']; ?></td>
					<td><?php echo $rows['Status']; ?></td>
				
				  </tr>
				  <?php } ?>
				</tbody>
			  </table>
			  <?php }else{ ?>
				<div class="todo-item">
				<h2>No tools listed currently</h2>
				<br>
				<small>Note: You can list tools by going in the tools form</small> 
				
				</div>
			  <?php } ?>
			  </div>
	</form>
	</section>

	
	<script src="user.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
?>