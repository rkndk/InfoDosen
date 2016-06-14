<?php
include "../session.php";
include "../koneksi.php";
if($_SESSION['level']!="mahasiswa"){
  header('Location: ../login.php');
}
$user=$userOnSession;
if(!isset($_GET['id'])||empty($_GET['id'])){            
  header("location: mailbox.php");
}
$idpesan=$_GET['id'];
$pengirimpesan=array();
$penerimapesan=array();
$pesan=array();


$sqla=mysql_query("select * from pesan where idpesan=".$idpesan." AND (pengirim='".$user['nim']."' OR penerima='".$user['nim']."')");
if(mysql_num_rows($sqla)<=0){
  header("location: mailbox.php");
}
$sqla=mysql_query("select * from pesan where idpesan=".$idpesan." AND penerima='".$user['nim']."'");
if(mysql_num_rows($sqla)>0){
  $pesan=mysql_fetch_assoc($sqla);
  $penerimapesan=$user;
  $sqlpengirim = mysql_query("select * from mahasiswa where nim='".$pesan['pengirim']."'");
  if(mysql_num_rows($sqlpengirim)<=0){
    $sqlpengirim = mysql_query("select * from dosen where nip='".$pesan['pengirim']."'");
  }
  $pengirimpesan = mysql_fetch_assoc($sqlpengirim);
}
else{
  $sqla=mysql_query("select * from pesan where idpesan=".$idpesan." AND pengirim='".$user['nim']."'");
  $pesan=mysql_fetch_assoc($sqla);
  $pengirimpesan=$user;
  $sqlpenerima = mysql_query("select * from mahasiswa where nim='".$pesan['penerima']."'");
  if(mysql_num_rows($sqlpenerima)<=0){
    $sqlpenerima = mysql_query("select * from dosen where nip='".$pesan['penerima']."'");
  }
  $penerimapesan = mysql_fetch_assoc($sqlpenerima);
}

if($pesan['status']=="UNREAD" && $pesan['pengirim']!=$user['nim']){
  mysql_query("UPDATE pesan SET status='READ' WHERE idpesan=".$idpesan, $connection) or die(mysql_error());
}

$date = date_create($pesan['tanggal']);
$tanggalkirim= date_format($date,"d M Y");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Info Dosen - Read</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Style Buatan -->
  <link rel="stylesheet" href="../dist/css/style.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>i</b>D</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>info</b>DOSEN</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>


      <?php
        $sql = "select * from pesan where penerima='".$user['nim']."' AND status='UNREAD'";
        $sqla=mysql_query($sql);
        $jumlahUNREAD=mysql_num_rows($sqla);
      ?>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <?php
                if($jumlahUNREAD>0){
                  echo '<span class="label label-danger">'.$jumlahUNREAD.'</span>';
                }
              ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Kamu punya <?php echo $jumlahUNREAD ?> pesan yang belum dibaca</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php
                    $sql = "select * from pesan where penerima='".$user['nim']."' or pengirim='".$user['nim']."'";
                    $sqla=mysql_query($sql);
                    $jumlahPesan=mysql_num_rows($sqla);
                    $sql = "select * from pesan where penerima='".$user['nim']."' ORDER BY status DESC";
                    $sqla=mysql_query($sql);
                    for($i=0; ($data = mysql_fetch_array($sqla))&&$i<5; $i++) {
                      $sqlpengirim = mysql_query("select * from mahasiswa where nim='".$data['pengirim']."'");
                      if(mysql_num_rows($sqlpengirim)<=0){
                        $sqlpengirim = mysql_query("select * from dosen where nip='".$data['pengirim']."'");
                      }
                      $pengirim = mysql_fetch_assoc($sqlpengirim);
                      $date = date_create($data['tanggal']);
                      $tanggalkirim= date_format($date,"d M Y");
                      $subject= substr($data['subject'],0,30);
                      if($data['status']=="UNREAD"){
                        echo '<li style="background: #FFEBEE">';
                      }
                      else{
                        echo '<li>';
                      }
                      echo '
                        <a href="read.php?id='.$data['idpesan'].'">
                          <div class="pull-left">
                            <img src="../assets/images/'.$pengirim['foto'].'" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            '.$pengirim['nama'].'
                            <small><i class="fa fa-clock-o"></i> '.$tanggalkirim.'</small>
                          </h4>
                          <p>'.$subject.'</p>
                        </a>
                      </li>';
                    }
                  ?>
                </ul>
              </li>
              <li class="footer"><a href="mailbox.php">Lihat Semua Pesan</a></li>
            </ul>
          </li>
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../assets/images/<?php echo $user['foto'] ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user['nama'];?></span>
              <i class="fa fa-sort-down pull-right"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../assets/images/<?php echo $user['foto'] ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user['nama'];?>
                  <small><?php echo $user['deskripsi'];?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profil.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../assets/images/<?php echo $user['foto'] ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['nama'];?></p>
          <?php echo $user['deskripsi'];?>
        </div>
      </div>
      <!-- search form -->
      <form action="cari.php" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="dosen" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <li class="treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="active treeview">
          <a href="mailbox.php">
            <i class="fa fa-envelope"></i>
            <span>Pesan</span>
          </a>
        </li>
        <li class="treeview">
          <a href="profil.php">
            <i class="fa fa-user"></i>
            <span>Profil</span>
          </a>
        </li>
        <li class="header">CREDITS</li>
        <li><a href="aboutus.php"><i class="fa fa-users"></i> <span>Tentang Kami</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="pesanbaru.php" class="btn btn-primary btn-block margin-bottom">Tulis Pesan</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="mailbox.php?view=INBOX"><i class="fa fa-inbox"></i> Kotak Masuk
                  <?php
                    if($jumlahUNREAD>0){
                      echo '<span class="label label-primary pull-right">'.$jumlahUNREAD.'</span></a></li>';
                    }
                  ?>
                <li><a href="mailbox.php?view=OUTBOX"><i class="fa fa-envelope-o"></i> Pesan Terkirim</a></li>
                <!-- Baru diubah aga  -->
                <li><a href="mailbox.php?view=FAVORITE"><i class="fa fa-star"></i> Favorite</a>
                <li><a href="mailbox.php?view=ALL"><i class="fa fa-inbox"></i> Semua Pesan 
                  <span class="label label-warning pull-right"><?php echo $jumlahPesan ?></span></a>
                </li>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          
        </div>
        <!-- /.col -->

        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Baca Pesan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>SUBJECT : <?php echo $pesan['subject']?></h3>
                <h5><div class="col-md-1">DARI</div>   : <?php echo $pengirimpesan['nama']?> [ <?php echo $pesan['pengirim']?> ]</h5>
                <h5><div class="col-md-1">KEPADA</div> : <?php echo $penerimapesan['nama']?> [ <?php echo $pesan['penerima']?> ]
                  <span class="mailbox-read-time pull-right"><?php echo $tanggalkirim?></span></h5>
              </div>
              <div class="mailbox-read-message">
                <h4>ISI PESAN</h4><br>
                <?php echo $pesan['isipesan']?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <a href="mailbox.php"><button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</button></a>
                <?php 
                  if($user['nim']==$pesan['pengirim']){
                    echo '<a href="pesanbaru.php?ke='.$pesan['penerima'].'"><button type="button" class="btn btn-default"><i class="fa fa-share"></i> Balas</button></a>';
                  }
                  else{
                    echo '<a href="pesanbaru.php?ke='.$pesan['pengirim'].'"><button type="button" class="btn btn-default"><i class="fa fa-share"></i> Balas</button></a>';
                  }
                ?>
              </div>
              <button onclick="hapuspesan(<?php echo $pesan['idpesan']?>)" type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Hapus Pesan</button>
              <a href="../buatpdf.php?id=<?php echo $pesan['idpesan']?>"><button type="button" class="btn btn-default"><i class="fa fa-print"></i> Cetak Pesan</button></a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2016 <a href="#">infoDosen</a>.</strong> All rights reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
<script src="../assets/js/mailbox-mahasiswa.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>

<?php
mysql_close();
?>