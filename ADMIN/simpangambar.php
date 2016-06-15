<?php

  include "../koneksi.php";
  
  $nama = $_POST["nama"];
  $nip = $_POST["nip"];
  $gender = $_POST["gender"];
  $deskripsi = $_POST["deskripsi"];
  $about = $_POST["about"];
  $award = $_POST["award"];
  $misc = $_POST["misc"];
  $fotodosen = $_FILES['fotodosen']['name'];

  mysql_select_db("projectpbw") or die("Gagal buka database");
  $sql="INSERT into dosen (nip, password, nama, gender, foto, deskripsi, about, award, misc, status) VALUES ('$nip', '$nip', '$nama', '$gender', '$fotodosen', '$deskripsi', '$about', '$award', '$misc', '')";
  $sqla=mysql_query($sql);

  move_uploaded_file($_FILES['fotodosen']['tmp_name'], "../assets/images/".$_FILES['fotodosen']['name']);

      if (!$sqla) { // add this check.
        die('Invalid query: ' . mysql_error());
      }
?>