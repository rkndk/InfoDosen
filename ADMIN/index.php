<?php 
include "session.php";
include "koneksi.php";

if(empty($_SESSION['user'])) {
   header("Location: loginadmin.php");
}

if (isset($_POST['tambahdosen'])) {
   
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
}



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin - Info Dosen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand"><b>Admin</b> IFCO</a>          
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#dosen">Dosen </a></li>
            <li><a href="#mahasiswa">Mahasiswa </a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out text-white"></i> Keluar </a></li>
          </ul>
          <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form>
        </div>
        <!-- /.navbar-collapse -->                      
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content">  

        <div id="dosen" class="box box-solid box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Data Dosen</h3>
          </div><br>     
            <div class="box-body table-responsive no-padding"> 
   <?php    

    $sqldosen="select * from dosen";
    $sqlc=mysql_query($sqldosen);
    if (!$sqlc) { // add this check.
      die('Invalid query: ' . mysql_error());
    }
    $i= 0;

      while ($datadosen=mysql_fetch_array($sqlc)) {
      $i++;

         echo '<div class="col-md-3">
              <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../assets/images/'.$datadosen['foto'].'" alt="User profile picture">

              <h3 class="profile-username text-center">'.$datadosen['nama'].'</h3>

              <p class="text-muted text-center">NIP : '.$datadosen['nip'].'</p>

              <ul class="list-group list-group-unbordered">               
              </ul>
              <a href="editdosen.php?username='.$datadosen['nama'].'" class="btn btn-primary btn-block"><b>Edit Profil</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          </div>';
        }
    ?>
            <div class="col-md-3">
              <div class="box box-primary">
              <center><br>
              <a href="daftarDosen.php" class="btn btn-circle-lg btn-primary" style="width: 90px;height: 90px;text-align: center;padding: 13px 0;font-size: 30px;line-height: 2.20;border-radius: 70px;">
              <span class="glyphicon glyphicon-plus"></span></a></center>
              <br>
              <h3 class="profile-username text-center">Tambah Dosen</h3>
              </div>
            </div>         
        </div>
        <!-- /.box -->
      </section>
     <section class="content">       
        <div id="mahasiswa" class="box box-solid box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Data Mahasiswa</h3>
          </div>
          <div class="box-body table-responsive no-padding">

          <?php    
            $sqlmhs="select * from mahasiswa";
            $sqlm=mysql_query($sqlmhs);
            if (!$sqlm) { // add this check.
              die('Invalid query: ' . mysql_error());
            }
            $m= 0;
              echo '<table class="table table-striped">
                    <tr>
                                  <th>NIM</th>
                                  <th>Nama</th>
                                  <th>Jurusan</th>
                                  <th>Status</th>                  
                                </tr>';
              while ($datamhs=mysql_fetch_array($sqlm)) {
              $m++;
                echo '
                                <tr>
                                  <td>'.$datamhs['nim'].'</td>
                                  <td>'.$datamhs['nama'].'</td>
                                  <td>'.$datamhs['jurusan'].'</td>
                                  <td><span class="label label-success">Approved</span></td>
                                  
                                </tr>';
                  }
                
              echo '</table>';
          ?>
            </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 0.0.1
      </div>
      <strong>Copyright &copy; 2016-2017 <a href="#">InfoDosen</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.0 -->
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>