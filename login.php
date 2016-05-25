<?php
include('ceklogin.php'); // Memasuk-kan skrip Login 

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>E-Communication</title>
	
	<!-- Skrip CSS -->
   <link rel="stylesheet" href="style.css"/>
  
  </head>	
  <body>
	<div class="container">
		<div class="main">
	      <form action="" method="post">
			<h2>E-COMUNICATION</h2><hr/>		
			
			<label>NIM/NIP :</label>
			<input id="nimataunip" name="nimornip" placeholder="NIM/NIP" type="text">
			
			<label>Password :</label>
			<input id="password" name="password" placeholder="**********" type="password">
			
			<input type="submit" name="submit" id="submit" value="Login">
		</form>
		<form action="singup.html" method="post">
			<input type="submit" name="singup" id="singup" value="Singup">
		  </form>
		</div>
   </div>

  </body>
</html>






