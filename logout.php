<?php
	session_start();
	if(session_destroy()) // Menghapus Sessions
	{
		header("Location: login.php"); // Langsung mengarah ke login.php
	}
?>