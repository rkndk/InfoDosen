<?php
	include "session.php";
	include "koneksi.php";
	$user = $userOnSession;
	$tipe = $_POST['tipe'];
	$pelajaran = $_POST['pelajaran'];
	$id = $_POST['id'];
	
	if($tipe=="subscribe"){
		mysql_query("insert into subscribe(nim,pelajaran)  values('".$user['nim']."','".$pelajaran."')", $connection) or die(mysql_error());
	}
	elseif ($tipe=="unsubscribe") {
		mysql_query("DELETE from subscribe WHERE id='".$id."'",$connection) or die(mysql_error());
	}
    mysql_close($connection);
?>