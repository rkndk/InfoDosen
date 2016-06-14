<?php
	include "session.php";
	include "koneksi.php";
	$user = $userOnSession;
	$tipe = $_POST['tipe'];
	$pelajaran = $_POST['pelajaran'];
	
	if($tipe=="subscribe"){
		$sqla=mysql_query("select * from subscribe where nim='".$user['nim']."' AND pelajaran='".$pelajaran."'");
		if(mysql_num_rows($sqla)==0){
			mysql_query("insert into subscribe(nim,pelajaran,status)  values('".$user['nim']."','".$pelajaran."','PENDING')", $connection) or die(mysql_error());	
		}
	}
	elseif ($tipe=="unsubscribe") {
		$user = $_POST['user'];
		mysql_query("DELETE from subscribe WHERE nim='".$user."' AND pelajaran='".$pelajaran."'",$connection) or die(mysql_error());	
	}

	elseif ($tipe=="accept") {
		$user = $_POST['user'];
		mysql_query("UPDATE subscribe SET status='APPROVED' WHERE nim='".$user."' AND pelajaran='".$pelajaran."'", $connection) or die(mysql_error());
	}
    mysql_close($connection);
?>