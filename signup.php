<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="img/virus.png" type="image/png">
	<title>Covid-19 | Log-In</title>
	<title>Sign-Up</title>
	<?php include 'css/style.php';?>
	<?php include 'links/links.php';?>

</head>
<body>


<?php 

include 'dbconnection.php';

if(isset($_POST['submit']))
{
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	$cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);


	$pass = password_hash($password, PASSWORD_BCRYPT);
	$cpass = password_hash($cpassword, PASSWORD_BCRYPT);

	$vkey = bin2hex(random_bytes(15));

	$emailquery = "select * from registration where email = '$email'";

	$query = mysqli_query($connection, $emailquery);

	$emailcount = mysqli_num_rows($query);

	if($emailcount>0){

		echo "Email already Exists";
	} 
	else
	{
		if($password === $cpassword)
		{
			$insertquery = "insert into registration(username,email,mobile,password,cpassword,vkey,status)values('$username','$email','$mobile','$pass','$cpass','$vkey','inactive')";

			$inquery = mysqli_query($connection, $insertquery);

			

			if($inquery)
			{
				echo "Insert success";

				//$body = "Hi, $username. please click here to Activate your account http://localhost:8181/email/activate.php?vkey=$vkey";

				//echo "$body";

				

				$subject = "Email Activation";
				$body = "Hi, $username. please click here to Activate your account http://localhost:8181/Covid/activate.php?vkey=$vkey";
				$senders_mail = "From: thebestdeveloper20@gmail.com";


				if(mail($email, $subject, $body, $senders_mail))
				{
					//echo "Email successfully sent to $email.";*/

					$_SESSION['msg'] = "Check ur mail to avtivate ur account $email";
					header('location:login.php');
					
				}
				else
				{
					echo "Email sending failed...";
				}

			}
			else
			{
				?>
				<script>
					alert("No Inserted");
				</script>
				<?php
			}
		}
		else
		{
			echo "Passwords are not matching";
		}
	}
}


?>
	<div class="card bg-light">
		<article class= "card-body mx-auto" style="max-width: 400px;">
			<h4 class= "card-title mt-3 text-center">
			Create Account</h4>
			
			</p>-->

			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
 
		  		<div class="form-group input-group">
		  			<div class="input-group-prepend">
  						<span class="input-group-text"><i class="fa fa-user"></i></span>
  					</div>
  	  				<input type="text" name="username" class="form-control" placeholder="Full Name" required>
  				</div>

  				<div class="form-group input-group">
  					<div class="input-group-prepend">
  						<span class="input-group-text"><i class="fa fa-envelope"></i></span>
  					</div>
  	 		 		<input type="email" name="email" class="form-control" placeholder="Email Id" required>
  				</div>

  				<div class="form-group input-group">
  					<div class="input-group-prepend">
  						<span class="input-group-text"><i class="fa fa-phone"></i></span>
  					</div>
  	  				<input type="number" name="mobile" class="form-control" placeholder="Mobile" required>
  				</div>

  				<div class="form-group input-group">
  					<div class="input-group-prepend">
  						<span class="input-group-text"><i class="fa fa-lock"></i></span>
  					</div>
  	  				<input type="password" name="password" class="form-control" placeholder="Password" required>
  				</div>

  				<div class="form-group input-group">
  					<div class="input-group-prepend">
  						<span class="input-group-text"><i class="fa fa-lock"></i></span>
  					</div>
  	  				<input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required>
  				</div>

  				<div class="form-group">

  					<button type="submit" class="btn btn-primary btn-block" name="submit">Create Account</button>
  				</div>

  				<p class="text-center">Have an account?
  					<a href="login.php">Log-In</a>
  				</p>
  			</form>
  		</article>
  	</div>
	
  

</body>
</html>