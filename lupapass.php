<?php
  include 'koneksi.php';
  session_start();
  $data=array();
  if(isset($_SESSION['user'])||isset($_SESSION['level'])){
    if($_SESSION['level']=="mahasiswa"){
      header("location: mahasiswa/index.php");
    }
    else if($_SESSION['level']=="dosen"){
      header("location: dosen/index.php");
    }
  }
  else if (isset($_POST['submit'])) {
    $email=$_POST['email'];
    $query = mysql_query("select * from mahasiswa where email='".$email."'");
    if(mysql_num_rows($query)==0){
      $query = mysql_query("select * from dosen where email='".$email."'");
    }

    if(mysql_num_rows($query)==0){
      header("location: lupapass.php?gagal");
    }
    else{
      $data=mysql_fetch_array($query);


      require 'PHPMailer/PHPMailerAutoload.php';
      $mail = new PHPMailer;
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'infodosenapp@gmail.com';                 // SMTP username
      $mail->Password = 'infodosen123';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                                    // TCP port to connect to

      $mail->setFrom('infodosenapp@gmail.com', 'Aplikasi Info Dosen');
      $mail->addAddress($data['email']);            

      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'Forgot Password Aplikasi Info Dosen';
      $mail->Body    = "Hai ".$data['nama'].". Password anda adalah <b>".$data['password']."</b><br><br><br><br>Terima Kasih<br>Admin Info Dosen";

      if(!$mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          echo 'Message has been sent';
      }
      header("location: lupapass.php?sukses");
    }
  }


?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Lupa Password</title>
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
        alert("Password Berhasil Dikirim Ke Email");
      }
      function gagal(){
        alert("Email tidak tersedia");
      }
    </script>

</head>

<?php
  if(isset($_GET['sukses'])){
    echo '<body onload="sukses()">';
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
    <p class="register-box-msg">
    Masukkan alamat email saat registrasi pertama
    </p>
    <form action="lupapass.php" method="post">      
      <div class="form-group has-feedback">
        <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email">
        </div>
      </div>          
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button name="submit" type="submit" class="btn btn-primary btn-block btn-flat">Kirim</button>
        </div>
        <!-- /.col -->
      </div>
    </form>      
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
