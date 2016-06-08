<?php
	include "../session.php";
	include "../koneksi.php";
	$user = $userOnSession;
	$statusdosen = $_POST['statusdosen'];
	mysql_query("UPDATE dosen SET status='".$statusdosen."' WHERE nip=".$user['nip'], $connection) or die(mysql_error());
	header("location: index.php");
?>