<?php 
$connect = @mysql_connect("localhost", "root", "") or die("Gagal Connect");

  $nama = $_POST["nama"];
  $nip = $_POST["nip"];
  $gender = $_POST["gender"];
  $deskripsi = $_POST["deskripsi"];
  $about = $_POST["about"];
  $award = $_POST['award'];
  $misc = $_POST['misc'];
  $fotodosen = $_FILES['fotodosen']['name'];

	mysql_select_db("projectpbw", $connect) or die("Gagal buka database");
	mysql_query("INSERT INTO dosen (nama, password, nip, gender, deskripsi, about, award, misc, fotodosen) VALUES ('$nama', '$nama', '$nip', '$gender', '$deskripsi', '$about', '$award', '$misc', '$fotodosen'), $connect)");

	move_uploaded_file($_FILES['fotodosen']['tmp_name'], "../assets/images/".$_FILES['fotodosen']['name']);
?>