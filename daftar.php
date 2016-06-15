<?php
include "koneksi.php";
if(isset($_SESSION['user'])&&$_SESSION['level']!="admin"){
  header('Location: login.php');
}
else if(isset($_SESSION['user'])&&$_SESSION['level']=="admin"){
  header('Location: ADMIN/index.php');
}

if(isset($_POST['submit'])){
  $nama=$_POST['nama'];
  $nim=$_POST['nim'];
  $jeniskelamin=$_POST['jeniskelamin'];
  $email=$_POST['email'];
  $tanggallahir=$_POST['tanggallahir'];
  $jurusan=$_POST['jurusan'];
  $password=$_POST['password'];

    $sqla=mysql_query("select * from mahasiswa where nim=$nim");
    if(mysql_num_rows($sqla)==0){
      mysql_query("insert into mahasiswa(nama,nim,jeniskelamin,email,tanggallahir,jurusan,password,statusmhs)  
        values('$nama','$nim','$jeniskelamin','$email','$tanggallahir','$jurusan','$password','PENDING')") or die(mysql_error());
      header("location: daftar.php?sukses");
    }
    else{
      header("location: daftar.php?gagal");
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
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
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

    <script type="text/javascript">
    function sukses(){
      alert("Berhasil Mendaftar");
    }
    function gagal(){
      alert("Gagal Mendaftar");
    }
  </script>
</head>
<?php
  if(isset($_GET['sukses'])){
    echo '<body  onload="sukses()">';
  }
  else if(isset($_GET['gagal'])){
    echo '<body onload="gagal()">';
  }
  else{
    echo '<body>';
  }
?>
<div class="register-box">
  <div class="register-logo">
    <a href="#"><i class="fa fa-user-plus text-blue"></i><b> Daftar</b> Mahasiswa</a>
  </div>

  <div class="register-box-body">
    <form action="" method="post">
      <div class="form-group has-feedback">
        <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap">
        </div>
      </div>
      <div class="form-group has-feedback">
        <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                <input name="nim" type="number" class="form-control" placeholder="NIM">
        </div>
      </div>
      <div class="form-group has-feedback">
        <select name="jeniskelamin" class="form-control selectpicker show-menu-arrow">
          <option value="" disabled selected>Jenis Kelamin</option>
          <option value="Laki-Laki">Laki-Laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
      <div class="form-group has-feedback">
        <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email">
        </div>
      </div>
      <div class="form-group has-feedback">
        <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                <input name="tanggallahir" type="date" class="form-control" placeholder="Calendar">
        </div>
      </div>
      <div class="form-group has-feedback">
            <select name="jurusan" class="form-control selectpicker show-menu-arrow">                      
                        <option value="">Pilih Jurusan</option>                        
                        <optgroup label="Fakultas MIPA">
                        <option value="Informatika" data-subtext="MIPA">Informatika</option>
                        <option value="Biologi" data-subtext="Aceh">Biologi</option>
                        </optgroup>
                        <optgroup label="Fakultas Teknik">
                        <option value="Elektro" data-subtext="teknik">Elektro</option>
                        <option value="Arsitektur" data-subtext="Aceh">Arsitektur</option>
                        </optgroup>
                        <optgroup label="Fakultas Ekonomi">
                        <option value="Pembangunan" data-subtext="ekonomi">Pembangunan</option>
                        <option value="Manajemen" data-subtext="Aceh">Manajemen</option>
                        </optgroup>
            </select>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Masukkan Password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>        
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button name="submit" type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>  
    <a href="login.php" class="text-center">Saya sudah memiliki akun</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

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
