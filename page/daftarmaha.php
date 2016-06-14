<?php
  if (isset($_POST['submit'])) {
    if (empty($_POST['nama']) || empty($_POST['nim']) || empty($_POST['gender']) || empty($_POST['email']) || empty($_POST['kalender']) || empty($_POST['jurusan']) || empty($_POST['password'])|| empty($_POST['terms'])) {
      //$error = "Nomor Induk atau Password tidak valid";
    }
    else
    {
       $connection = mysql_connect("localhost", "root", "") or die("gagal koneksi");
      // Variabel username dan password
      $nama=$_POST['nama'];
      $nim=$_POST['nim'];
      $gender=$_POST['gender'];
      $email=$_POST['email'];
      $kalender=$_POST['kalender'];
      $jurusan=$_POST['jurusan'];
      $password=$_POST['password'];
   
      // Membangun koneksi ke database
     
      // Mencegah MySQL injection 

      // Seleksi Database
      mysql_select_db("projectpbw", $connection) or die("Gagal buka database");
      // SQL query untuk memeriksa apakah user terdapat di database?
      mysql_query("insert into mahasiswa(nama, nim, jeniskelamin, email, tanggallahir, jurusan, password) values('$nama', '$nim', '$gender', '$email', '$kalender', '$jurusan', '$password')", $connection);
     
        header("location: ../index.php"); // Mengarahkan ke halaman profil
      
    }
  }
?>




<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pendaftaran Mahasiswa</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

  <style type="text/css">
        body {            
            background-image:   
              url(../bg0.png); 
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
<div class="register-box">
  <div class="register-logo">
    <a href="#"><i class="fa fa-user-plus text-blue"></i><b> Daftar</b> Mahasiswa</a>
  </div>

  <div class="register-box-body">
    <form action="" method="post">
      <div class="form-group has-feedback">
        <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
        </div>
      </div>
      <div class="form-group has-feedback">
        <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                <input type="number" name="nim" class="form-control" placeholder="NIM">
        </div>
      </div>
      <div class="form-group has-feedback">
        <select class="form-control selectpicker show-menu-arrow" name="gender">
          <option value="" disabled selected>Jenis Kelamin</option>
          <option>Laki-Laki</option>
          <option>Perempuan</option>
        </select>
      </div>
      <div class="form-group has-feedback">
        <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
      </div>
      <div class="form-group has-feedback">
        <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                <input type="date" name="kalender" class="form-control" placeholder="Calendar">
        </div>
      </div>
      <div class="form-group has-feedback">
            <select class="form-control selectpicker show-menu-arrow" name="jurusan">                      
                        <option value="">Pilih Jurusan</option>                        
                        <optgroup label="Fakultas MIPA"><option value="ABD" data-subtext="MIPA">Informatika</option><option value="ACBE" data-subtext="Aceh">Biologi</option></optgroup>
                        <optgroup label="Fakultas Teknik"><option value="ABD" data-subtext="teknik">Elektro</option><option value="ACBE" data-subtext="Aceh">Arsitektur</option></optgroup>
                        <optgroup label="Fakultas Ekonomi"><option value="ABD" data-subtext="ekonomi">Pembangunan</option><option value="ACBE" data-subtext="Aceh">Manajemen</option></optgroup>
            </select>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>        
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="terms"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>  
    <a href="../login.php" class="text-center">Saya sudah memiliki akun</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.0 -->
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
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
