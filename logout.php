<?php
session_start();
if(session_destroy()) // Menghapus Sessions
{
header("Location: index.php"); // Langsung mengarah ke Home index.php
}
?>