<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="img/virus.png" type="image/png">
	<title>Covid-19 | Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="css/login-style.css">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>

	
	<?php include 'css/style.php' ?>
	<?php include 'links/links.php' ?>



</head>
<body>

	<?php


include 'dbconnection.php';

/*if(isset($_GET['email']))
{
	$email = $_GET['email'];


	$updatequery = "select * from registration where email = '$email'";

	$query = mysqli_query($connection, $updatequery);

	if($query)
	{
		if(isset($_SESSION['msg']))
		{
			//$_SESSION['msg'] = "Account updated successfully";
			//header('location:login.php');
		}
		else
		{
			//$_SESSION['msg'] = "You are logged out";
			//header('location:login.php');

		}
	}
	else
	{
		$_SESSION['msg'] = "Account not updated ";
			header('location:signup.php');
	}


}*/

if(isset($_POST['submit']))
{
	
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	$cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);


	$pass = password_hash($password, PASSWORD_BCRYPT);
	$cpass = password_hash($cpassword, PASSWORD_BCRYPT);

	$emailquery = "select * from registration where email = '$email'";

	$query = mysqli_query($connection, $emailquery);

	$emailcount = mysqli_num_rows($query);

	if($emailcount>0)
	{

		if($password === $cpassword)
		{
			$updatequery = "update registration set password='$pass', cpassword='cpass' where email = '$email'";

			$inquery = mysqli_query($connection, $updatequery);

			

			if($inquery)
			{
				if(isset($_SESSION['msg']))
				{
					$_SESSION['msg'] = "Password changed successfully";
					header('location:login.php');
				}
				else
				{
					$_SESSION['msg'] = "You are logged out";
					header('location:login.php');

				}

			}
			else
			{
				$_SESSION['msg'] = "Password not updated ";
				header('location:forgotpass.php');
			}
		}
		else
		{
			$_SESSION['msg'] = "Passwords are not matching ";
			
			
		}
	}
	else
		{
			$_SESSION['msg'] = "Invalid email ";

			
		}


}

?>

	<!--<img class="wave" src="img/wave1.png">-->
	<div class="container">
		<div class="img">
			<img src="img/my_password_d6kg.svg">
		</div>

			<div class="login-content ">
		<article class= "card-body mx-auto" style="max-width: 400px;">
			

			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
 

  				<img src="img/avatar.svg">
				<h2 class="title">Forgot Password</h2>
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
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<!--<h5>Enter registred Email Id</h5>-->
           		   		<input type="text" name="email" class="input" placeholder="Enter Registered Email Id" >
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<!--<h5>New Password</h5>-->
           		    	<input type="password" name="password" class="input" placeholder="New Password">
            	   </div>
            	</div>
            	<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<!--<h5>Confirm New Password</h5>-->
           		    	<input type="password" name="cpassword" class="input" placeholder="Confirm New Password">
            	   </div>
            	</div>
            	<div class="form-group">

  					<button type="submit" class="btn btn-primary btn-block" name="submit">Change Password</button>
  				</div>
            	

  				<p>
  					<a href="login.php">Log-In</a>
  				</p>
  			</form>
  		</article>
  	</div>


	

</body>
</html>