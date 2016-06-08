<?php
	include "../session.php";
	include "../koneksi.php";
	$user = $userOnSession;
	$tipe = $_POST['tipe'];
	
	if($tipe=="tambah"){
		$catatan = $_POST['catatan'];
		mysql_query("insert into catatan(pembuat,catatan)  values('".$user['nim']."','".$catatan."')", $connection) or die(mysql_error());
		 $last_id = mysql_insert_id($connection);
		 print($last_id);
	}
	else if($tipe=="edit"){
		$catatan = $_POST['catatan'];
		$idcatatan = $_POST['idcatatan'];
		mysql_query("UPDATE catatan SET catatan='".$catatan."' WHERE idcatatan=".$idcatatan, $connection) or die(mysql_error());
	}
	else if($tipe=="hapus"){
		$idcatatan = $_POST['idcatatan'];
		mysql_query("DELETE from catatan WHERE idcatatan='".$idcatatan."'",$connection) or die(mysql_error());
	}
    mysql_close($connection);
?>