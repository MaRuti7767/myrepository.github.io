<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="img/virus.png" type="image/png">
	<title>Covid-19 | Log-In</title>
	<link rel="stylesheet" type="text/css" href="css/login-style.css">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>

	
	<?php include 'css/style.php' ?>
	<?php include 'links/links.php' ?>



</head>
<body>

	<!--<img class="wave" src="img/wave.png">-->
	<div class="container">
		<div class="img">
			<img src="img/mobile_login_ikmv.svg">
		</div>
	

	<?php
		include 'dbconnection.php';


		if(isset($_POST['submit']))
		{
			$email = $_POST['email'];
			$password = $_POST['password'];

			$email_search = "select * from registration where email='$email' and status='active'";
			$query = mysqli_query($connection, $email_search);

			$email_count=mysqli_num_rows($query);
			if($email_count)
			{
				$email_pass = mysqli_fetch_assoc($query);
				$db_pass = $email_pass['password'];
				


				$pass_decode = password_verify($password, $db_pass);

				if($pass_decode)
				{
					//login success
					$_SESSION['username'] = $email_pass['username'];
					?>
					<script>
						location.replace("dashboard.php");
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
			<div class="login-content ">
		<article class= "card-body mx-auto" style="max-width: 400px;">
			
			

			<div>
				<p class="bg-success text-white px-4">
					<?php 
					if(isset($_SESSION['msg']))
					{
						echo $_SESSION['msg'];
					}
					else
					{
						echo $_SESSION['msg'] = "You are logged out. Please login again";
					}

					 ?>
				</p>
			</div>

			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
 

  				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<!--<h5>Username</h5>-->
           		   		<input type="text" name="email" class="input" placeholder="Username">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<!--<h5>Password</h5>-->
           		    	<input type="password" name="password" class="input" placeholder="Password">
            	   </div>
            	</div>
            	<div class="form-group">

  					<button type="submit" class="btn btn-primary btn-block" name="submit"> Login Now</button>
  				</div>
            	

  				<p>
  					<a href="emailforgotpass.php">Forgot Password?</a>
  				</p>
  			</form>
  		</article>
  	</div>
</div>

	

</body>
</html>