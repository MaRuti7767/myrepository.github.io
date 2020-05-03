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
<body >

	<?php 

include 'dbconnection.php';

if(isset($_POST['submit']))
{
	$email = mysqli_real_escape_string($connection, $_POST['email']);

	$emailquery = "select * from registration where email = '$email'";

	$query = mysqli_query($connection, $emailquery);

	$emailcount = mysqli_num_rows($query);

	if($emailcount>0){
		$_SESSION['msg'] = "";
			header('location:forgotpass.php');

		
	} 
	else
	{
		//echo "http://localhost/covid/forgotpass.php?email=$email";
				/*$subject = "Change Password";
				$body = "Hi, Please click here to change your Password http://localhost/covid/forgotpass.php";
				$senders_mail = "From: thebestdeveloper20@gmail.com";


				if(mail($email, $subject, $body, $senders_mail))
				{
					//echo "Email successfully sent to $email.";

					$_SESSION['msg'] = "Check your mail to change Password $email";
					header('location:login.php');
					
				}
				else
				{
					echo "Email sending failed...";
				}*/
				echo "Invalid Email";


	}

}

?>
<div class="container">
		<div class="img">
			<img src="img/access_account_99n5.svg">
		</div>

		<div class="login-content ">
			<article class= "card-body mx-auto" style="max-width: 400px;">
			
			<div>

				<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
					<img src="img/avatar.svg">
					<h2 class="title">Forgot Password</h2>
					<div class="form-group input-group">
  						<div class="input-group-prepend">
  							<span class="input-group-text"><i class="fa fa-envelope"></i></span>
  						</div>
  	 		 			<input type="email" name="email" class="form-control" placeholder="Email Id" required>
  					</div>

  					<div class="form-group">

  						<button type="submit" class="btn btn-primary btn-block" name="submit">Reset</button>
  					</div>

  				</form>
  			</div>
  			</article>

		</div>
	</div>
  	

 

</body>
</html>