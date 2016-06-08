<?php
	include "../session.php";
	include "../koneksi.php";
	$user = $userOnSession;
	$tipe = $_POST['tipe'];
	$nip = $_POST['nip'];
	
	if($tipe=="favorite"){
		mysql_query("insert into favorit(nim,nip)  values('".$user['nim']."','".$nip."')", $connection) or die(mysql_error());
	}
	elseif ($tipe=="unfavorite") {
		mysql_query("DELETE from favorit WHERE nim='".$user['nim']."' AND nip='".$nip."'",$connection) or die(mysql_error());
	}
    mysql_close($connection);
?>