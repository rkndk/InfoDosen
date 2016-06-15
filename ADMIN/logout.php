<?php
session_start();
if(session_destroy()) // Menghapus Sessions
{
header("Location: loginadmin.php"); // Langsung mengarah ke Home login.php
}
?>