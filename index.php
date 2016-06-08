<?php
include "session.php";
if($_SESSION['level']=="mahasiswa"){
	header('Location: mahasiswa/index.php');
}
else if($_SESSION['level']=="dosen"){
	header('Location: dosen/index.php');
}
else{
	header('Location: login.php');
}
?>