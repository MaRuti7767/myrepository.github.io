<?php

$server='localhost';
$user= 'root';
$password= '';
$db='coviddb';

$connection = mysqli_connect($server, $user, $password, $db);

if($connection)
{
	?>
	
	
	<?php
}else{
	?>
	<script>alert("No Connection Successful")</script>
	<?php
}


?>