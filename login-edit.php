<?php
	session_start();
  	$pesan="";
	if(isset($_SESSION['user'])){
		header("location: index.php");
	}
	else if (isset($_POST['submit'])) {
		if (empty($_POST['nimornip']) || empty($_POST['password'])) {
			//$error = "Nomor Induk atau Password tidak valid";
		}
		else
		{
			// Variabel username dan password
			$nimornip=$_POST['nimornip'];
			$password=$_POST['password'];
			// Membangun koneksi ke database
			$connection = mysql_connect("localhost", "root", "");
			// Mencegah MySQL injection 
			$nimornip = stripslashes($nimornip);
			$password = stripslashes($password);
			$nimornip = mysql_real_escape_string($nimornip);
			$password = mysql_real_escape_string($password);
			// Seleksi Database
			$db = mysql_select_db("projectpbw", $connection);
			// SQL query untuk memeriksa apakah user terdapat di database?
			$query = mysql_query("select * from mahasiswa where nim='$nimornip' AND password='".$password."'", $connection);
			$rows = mysql_num_rows($query);
			if ($rows == 1) {
				$_SESSION['user']=$nimornip; // Membuat Sesi/session
				header("location: index.php"); // Mengarahkan ke halaman profil
			}
			else {
				header("location: login.php?error");
			}
			mysql_close($connection); // Menutup koneksi
		}
	}
	else if(isset($_GET['error'])){
		$pesan = "Nomor Induk atau Password salah";
	}
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>HAHAHA </title>    
    <link rel="stylesheet" href="assets/css/form-style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  </head>

  <body>
    <div class="container">
      <div id="enter">
        <div id="login-form">
            <div id="judul">
              LOG IN
            </div>
            <div id="content">
              <form action="login.php" method="post" role="form">
                <span class="form-label">NIM atau NIP</span>
                <div id="form-login-username" class="input-group">
                  <input id="username" class="input-field" name="nimornip" type="text" size="18" alt="nimornip" required />
                </div>
                <span class="form-label">Password</span>
                <div id="form-login-password" class="input-group">
                  <input id="password" class="input-field" name="password" type="password" size="18" alt="password"  required>
                </div>
                <center><span class="form-label" style="color: #F44336;"><?php echo $pesan ?></span></center>
                <div id="submit-buton" class="input-group submit">
                    <input class="btn btn-ok input-field" type="submit" name="submit" alt="masuk" value="MASUK">
                </div>
              </form>
              <center><span id="footer-login" class="form-label signup">Belum memiliki akun? <a class="form-label signup" href="daftar.php"> <b> DAFTAR</b></a></span></center>
            </div>
            <div id="footer"></div>
        </div> 
      </div>
    </div>
  </body>
</html>