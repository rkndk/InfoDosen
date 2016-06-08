<?php
	include "session.php";
	include "koneksi.php";
	$user = $userOnSession;
	$tipe = $_POST['tipe'];
	$pelajaran = $_POST['pelajaran'];
	
	if($tipe=="subscribe"){
		mysql_query("insert into subscribe(nim,pelajaran,status)  values('".$user['nim']."','".$pelajaran."','PENDING')", $connection) or die(mysql_error());
	}
	elseif ($tipe=="unsubscribe") {
		$id = $_POST['id'];
		mysql_query("DELETE from subscribe WHERE id='".$id."'",$connection) or die(mysql_error());
	}

	elseif ($tipe=="accept") {
		$id = $_POST['id'];
		mysql_query("UPDATE subscribe SET status='APPROVED' WHERE id=".$id, $connection) or die(mysql_error());
	}
    mysql_close($connection);
?>