<?php
include "../session.php";
include "../koneksi.php";
if($_SESSION['level']!="mahasiswa"){
  header('Location: ../login.php');
}
if(!isset($_GET['nip'])||empty($_GET['nip'])){
  header('Location: index.php');
}
$nip=$_GET['nip'];
$user=$userOnSession;
$sqla=mysql_query("select * from dosen where nip='".$nip."'");
$dosen=mysql_fetch_assoc($sqla);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JUDUL HAHAHAHA</title>
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
      <span class="logo-mini"><b>H</b>JD</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>HAHAHA</b>JUDUL</span>
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
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
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
          <a href="dosen.php">
            <i class="fa fa-user"></i>
            <span>Profil Dosen</span>
          </a>
        </li>
        <li class="treeview">
          <a href="tugas.php">
            <i class="fa fa-flag"></i>
            <span>Tugas</span>
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
        Dosen
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>        
        <li class="active">Dosen</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../assets/images/<?php echo $dosen['foto'] ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $dosen['nama'] ?></h3>

              <p class="text-muted text-center">NIP : <?php echo $dosen['nip'] ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                   <div class="knob-label">  <?php echo $dosen['status'] ?></div>
                </li>                
              </ul>
              <a href="pesanbaru.php?ke=<?php echo $dosen['nip'] ?>" class="btn btn-primary btn-block"><b>Message</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
          <div class="col-md-9">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Deskripsi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>About</dt>
                <dd><?php echo $dosen['about'] ?></dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
      
      <!-- /.row -->
      <!-- END TYPOGRAPHY -->
        <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#tab_1-1" data-toggle="tab">Misc</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Award</a></li>
                <li class="active"><a href="#tab_3-2" data-toggle="tab">Mata Kuliah</a></li>              
                <li class="pull-left header"><i class="fa fa-th"></i>Menu</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab_1-1">
                <ul>
                <li><?php echo $dosen['misc'] ?></li>
                </ul>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                <ul>
                <li><?php echo $dosen['award'] ?></li>
                </ul>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_3-2">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Mata Kuliah</th>
                    <th>Ikuti</th>                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sqla=mysql_query("select * from matakuliah where pengajar='".$dosen['nip']."'");
                    while($matakuliah=mysql_fetch_array($sqla)){
                      echo '
                      <tr id="'.$matakuliah['idpelajaran'].'">
                        <td>'.$matakuliah['nama'].'</td>
                        <td class="haha-star"><a href="#"><i class="fa fa-eye-slash text-green"></i> Ikuti</a></td>
                      </tr>';
                    }
                  ?>               
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
    </div>
    </section>    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2016 <a href="#">HAHA</a>.</strong> All rights reserved.
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
<script>
  $(function () {
    //Handle starring for glyphicon and font awesome
    $(".haha-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");
      var trid = $(this).closest('tr').attr('id');

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-eye");
        $this.toggleClass("fa-eye-slash");
      }
      if(!$this.hasClass("fa-eye")){
        subscribe("subscribe",trid);
      }
      else{
        subscribe("unsubscribe",trid);
      }
    });
  });

  function subscribe(tipe, id){
    $.post("../subscribe.php",
      {
          tipe: tipe,
          id: id
      },
      function(data, status){
      }
    );
  }
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>

<?php
mysql_close();
?>