<?php
	include "session.php";
	include "koneksi.php";
	$user = $userOnSession;

	if(isset($_POST['tipe'])){
		$tipe = $_POST['tipe'];

		if($tipe=="hapus"){
			$id = $_POST['id'];
			for($i=0; $i<count($id); $i++){
				mysql_query("DELETE from pesan WHERE idpesan='".$id[$i]."'",$connection) or die(mysql_error());
			}
		}
		else if($tipe=="FAVORITE"||$tipe=="UNFAVORITE"){
			$id = $_POST['id'];
			mysql_query("UPDATE pesan SET favorit='".$tipe."' WHERE idpesan='".$id."'",$connection) or die(mysql_error());
		}
	}
    mysql_close($connection);
?>