<?php

session_start();

include 'dbconnection.php';

if(isset($_GET['vkey']))
{
	$vkey = $_GET['vkey'];

	$updatequery = "update registration set status='active' where vkey='$vkey'";

	$query = mysqli_query($connection, $updatequery);

	if($query)
	{
		if(isset($_SESSION['msg']))
		{
			$_SESSION['msg'] = "Account updated successfully";
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
		$_SESSION['msg'] = "Account not updated ";
			header('location:signup.php');
	}


}

?>