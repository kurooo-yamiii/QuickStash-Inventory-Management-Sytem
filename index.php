<!DOCTYPE html>
<html>
<head>
	<title>QuickStash - Rizal Technologicla University</title>
     <meta charset="UTF-8">
	<meta http-eequiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0"> 
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="loginmedia.css">
	<link rel="icon" href="resources/techy.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="admin.js"></script>
</head>
<body>
    <div class="horizontal">
    <div class="right-space">

    </div>
    <div class="login-form">
     <form action="login.php" method="post">
		
     	<h2><img src="resources/techy.png"></h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

		<div class="form-group">
     	<label>Username</label>
     	<input type="text" name="uname" placeholder="Username" required><br>
		</div>

		<div class="form-group">
     	<label>Password</label>
                <div class="password-container">
     	<input type="password" id="passwordInput" name="password" placeholder="Password" required>
                        <span class="material-icons-outlined" onclick="togglePasswordVisibility()" id="toggleoff">visibility_off</span>
                <span class="material-icons-outlined" onclick="togglePasswordVisibility()" id="toggle">visibility</span>
                        
                <br>
                </div>
		</div>	

     	<button type="submit" onclick="dashboardShow()" style="background-color: #000080; margin-top: 3%;">Login</button>
         
     </form>
     <script src="admin.js"></script>
         <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        </div>
        </div>

	


<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("passwordInput");
        var toggle = document.getElementById("toggle");
        var toggleoff = document.getElementById("toggleoff");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggle.style.display = "none";
            toggleoff.style.display = "block";
        } else {
            passwordInput.type = "password";
            toggle.style.display = "block";
            toggleoff.style.display = "none";
        }
    }
</script>
</body>
</html>