<?php
  session_start();
  $pesan="";
  if(isset($_SESSION['user'])&&isset($_SESSION['level'])){
    if($_SESSION['level']=="mahasiswa"){
      header("location: mahasiswa/index.php");
    }
    else if($_SESSION['level']=="dosen"){
      header("location: dosen/index.php");
    }
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
      // SQL query untuk memeriksa apakah user terdapat di database pada tabel mahasiswa
      $query = mysql_query("select * from mahasiswa where nim='$nimornip' AND password='".$password."'", $connection);
      $rows = mysql_num_rows($query);
      if ($rows == 1) {
        $query = mysql_query("select * from mahasiswa where nim='$nimornip' AND password='".$password."' AND statusmhs='APPROVED'", $connection);
          $rows = mysql_num_rows($query);
          if ($rows == 1) {
            $_SESSION['user']=$nimornip; // Membuat Sesi/session
            $_SESSION['level']="mahasiswa";
            header("location: mahasiswa/index.php");
          }
          else{
            header("location: login.php?pending");
          }
      }
      else {
        // SQL query untuk memeriksa apakah user terdapat di database pada tabel dosen
        $query = mysql_query("select * from dosen where nip='$nimornip' AND password='".$password."'", $connection);
        $rows = mysql_num_rows($query);
        if ($rows == 1) {
          $_SESSION['user']=$nimornip; // Membuat Sesi/session
          $_SESSION['level']="dosen";
          header("location: dosen/index.php");
        }
        else{
          // Jika tidak ada maka login gagal
          header("location: login.php?error");
        }
      }
      mysql_close($connection); // Menutup koneksi
    }
  }
  else if(isset($_GET['error'])){
    $pesan = "Nomor Induk atau Password salah";
  }
  else if(isset($_GET['pending'])){
    $pesan = "Akun anda menunggu persetujuan admin";
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <style type="text/css">
        body {            
            background-image:   
              url(assets/images/bg0.png); 
            background-repeat: repeat-x;         
            animation: backgroundScroll 3999990s linear infinite;
            }

              @-webkit-keyframes backgroundScroll {
                from {background-position: 0 0;}
                to {background-position: 99999999px 0;}
                }

                @keyframes backgroundScroll {
                from {background-position: 0 0;}
                to {background-position: 99999999px 0;}
                }                
  </style>
</head>
<body>
<div class="login-box">
  <div class="login-logo">
    <h1 href="#"><i class="fa fa-info-circle text-blue"></i> <b>Info</b> Dosen</h1>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg" ><?php echo $pesan ?></p>

    <form action="login.php" method="post">
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="NIM atau NIP" id="username" name="nimornip" type="text" size="18" alt="nimornip" required >
        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" alt="password"  required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" alt="masuk" value="MASUK">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>
    Belum memiliki akun?<a href="daftar.php"> <b>DAFTAR</b></a><br>

    Lupa Password? Klik<a href="lupapass.php"> <b>Disini</b></a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
