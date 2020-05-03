<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Login|MySite</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/fontawesome.js"></script>
</head>
<body>

	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/doc.svg">
		</div>
		<div class="login-content">
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="username" id="username">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password" id="password">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login" name="submit">
            </form>
        </div>
    </div>
    
    
</body>
</html>


<?php


include 'dbconnection.php';
 
 if(isset($_POST['submit']))
 {
   $username = $_POST['username'];
   $password = $_POST['password'];
   

   $search_user = "select * from registration where username='$username'";



   $query = mysqli_query($connection, $search_user);

   echo "$search_user";

   $email_count=mysqli_num_rows($query);

   echo "$email_count";
   if($email_count)
      {

        $email_pass = mysqli_fetch_assoc($query);
        $db_pass = $email_pass['password'];
        $_SESSION['username'] = $email_pass['username'];

        $pass_decode = password_verify($pass, $db_pass);

        if($pass_decode)
        {
          echo "Login Successful";
          ?>
          <script>
            location.replace("homepage.php");
          </script>
          <?php

        }
        else
        {
          echo "Password Incorrect";

        }
        }
      else
      {
        echo "Invalid Email";
      }

 }
 
 
 ?>