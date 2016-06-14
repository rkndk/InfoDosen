<?php
include "../session.php";
include "../koneksi.php";
if($_SESSION['level']!="dosen"){
  header('Location: login.php');
}
$user=$userOnSession;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Info Dosen - - Dashboard</title>
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
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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
        $sql = "select * from pesan where penerima='".$user['nip']."' AND status='UNREAD'";
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
                    $sql = "select * from pesan where penerima='".$user['nip']."' ORDER BY status DESC";
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
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <li class="active treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="mailbox.php">
            <i class="fa fa-envelope"></i>
            <span>Pesan</span>
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
        <small>Dosen</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-md-8">
            <?php
              $sql = "select pengajar from matakuliah where pengajar='".$user['nip']."'";
              $sqla=mysql_query($sql);
              $row=mysql_num_rows($sqla);
              if($row>0){
                $sql = "select * from matakuliah where pengajar='".$user['nip']."'";
                $sqla=mysql_query($sql);
                echo '
                  <!-- Paneal Informasi -->
                  <div class="box box-info">
                     <div class="box-header">
                        <i class="fa fa-cogs"></i>
                        <h3 class="box-title">Panel Informasi</h3>
                     </div><!-- /.box-header -->
                     <div class="box-body">
                        <p>Hai <b>'.$user['nama'].'</b>, berikut matakuliah yang anda kelola.</p>
                        <div class="col-md-12">';
                while($data = mysql_fetch_array($sqla)) {
                            echo '
                            <div class="box box-solid box-primary collapsed-box">
                              <div class="box-header with-border">
                                <h3 class="box-title">'.$data['nama'].'</h3>
                                <div class="box-tools pull-right">
                                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                </div><!-- /.box-tools -->
                              </div><!-- /.box-header -->
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-md-6 hresize">
                                      <p>Mengirim informasi ke Mata Kuliah '.$data['nama'].'</p>
                                      <textarea required id="textarea'.$data['idpelajaran'].'" class="form-control hresize"></textarea><br>
                                      <button onclick="updateinfo('.$data['idpelajaran'].')" type="button" class="btn btn-primary pull-right btn-flat"><i class="fa fa-send"></i> KIRIM</button><br><br>
                                  </div>
                                  <div class="col-md-6 hresize">
                                      <p>Komting untuk pelajaran ini</p><br>';

                                      if(empty($data['komting'])){
                                        echo '
                                          <form action="../informasi.php" method="post">
                                            <div class="input-group input-group">
                                              <input type="hidden" name="tipe" value="tambahkomting">
                                              <input type="hidden" name="pengirim" value="dosen">
                                              <input type="hidden" name="idpelajaran" value="'.$data['idpelajaran'].'">
                                              <input name="nimkomting" type="number" class="form-control" placeholder="Masukkan NIM Mahasiswa" required>
                                                  <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-check"></i></button>
                                                  </span>
                                            </div>
                                          </form>';
                                      }else{
                                        $komting=mysql_fetch_assoc(mysql_query("select * from mahasiswa where nim='".$data['komting']."'"));
                                        echo '
                                        <div class="user-block">
                                          <img class="img-circle" src="../assets/images/'.$komting['foto'].'" alt="User Image">
                                          <span class="pull-right"><button onclick="hapuskomting('.$data['idpelajaran'].')" type="button" class="btn btn-danger btn-flat"><i class="fa fa-close"></i></button></span>
                                          <span class="username"><a href="#">'.$komting['nama'].'</a></span>
                                          <span class="description">'.$komting['nim'].'</span>
                                        </div>';
                                      }

                                      echo '
                                      <br><br>
                                  </div>
                                </div>';
                              if(!empty($data['pesandosen'])){
                                echo '
                                <div class="col-md-6 hresize">
                                    <p>Informasi dari anda sebelumnya</p>
                                    <textarea required id="textarea'.$data['idpelajaran'].'" class="form-control hresize" disabled>'.$data['pesandosen'].'</textarea><br>
                                    <button onclick="hapusinfodosen('.$data['idpelajaran'].')" type="button" class="btn btn-danger pull-right btn-flat"><i class="fa fa-close"></i> HAPUS</button><br><br>
                                </div>';
                              }
                              if(!empty($data['pesankomting'])){
                                echo '
                                <div class="col-md-6 hresize pull-right">
                                    <p>Informasi dari komting</p>
                                    <textarea required id="textarea'.$data['idpelajaran'].'" class="form-control hresize" disabled>'.$data['pesankomting'].'</textarea><br>
                                    <button onclick="hapusinfokomting('.$data['idpelajaran'].')" type="button" class="btn btn-danger pull-right btn-flat"><i class="fa fa-close"></i> HAPUS</button><br><br>
                                </div>';
                              }
                              
                              echo '
                                <div class="col-md-12 hresize" style="margin-top:20px;">
                                  <div class="box box-solid box-warning">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Mahasiswa Menunggu Persetujuan</h3>
                                      <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                      </div><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                      <table class="table table-hover">
                                        <tr>
                                          <th>NIM</th>
                                          <th>Nama</th>
                                          <th>Action</th>
                                        </tr>';
                                        $subscribers=mysql_query("select * from subscribe INNER JOIN mahasiswa ON subscribe.nim=mahasiswa.nim where pelajaran='".$data['idpelajaran']."' AND status='PENDING'");
                                        while($subscriber = mysql_fetch_array($subscribers)) {
                                          echo '
                                            <tr>
                                              <td>'.$subscriber['nim'].'</td>
                                              <td>'.$subscriber['nama'].'</td>
                                              <td><button onclick="hapussubscribe('.$subscriber['id'].')" type="button" class="btn-xs btn-danger"><i class="fa fa-close"></i></button> <button onclick="acceptsubscribe('.$subscriber['id'].')" type="button" class="btn-xs btn-success btn-flat"><i class="fa fa-check"></i></button></td>
                                            </tr>
                                          ';
                                        }
                                        echo '
                                      </table>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                                <div class="col-md-12 hresize">
                                  <div class="box box-solid box-default collapsed-box">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Daftar Mahasiswa</h3>
                                      <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                      </div><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                      <table class="table table-hover">
                                        <tr>
                                          <th>NIM</th>
                                          <th>Nama</th>
                                          <th>Action</th>
                                        </tr>';
                                        $subscribers=mysql_query("select * from subscribe INNER JOIN mahasiswa ON subscribe.nim=mahasiswa.nim where pelajaran='".$data['idpelajaran']."' AND status='APPROVED'");
                                        while($subscriber = mysql_fetch_array($subscribers)) {
                                          echo '
                                            <tr>
                                              <td>'.$subscriber['nim'].'</td>
                                              <td>'.$subscriber['nama'].'</td>
                                              <td><button onclick="hapussubscribe('.$subscriber['id'].')" type="button" class="btn-xs btn-danger"><i class="fa fa-close"></i></button></td>
                                            </tr>
                                          ';
                                        }
                                        echo '
                                      </table>
                                    </div><!-- /.box-body -->
                                  </div><!-- /.box -->
                                </div>

                              </div><!-- /.box-body -->
                            </div><!-- /.box -->';
                }
                echo '
                        </div>
                     </div><!-- /.box-body -->
                  </div><!-- /.box -->
                  <!-- /.Paneal Komting -->';
              }
            ?>

            


        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Status</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <label>Pilih Status</label>
              <form method="post" action="status.php">
                <div class="input-group input-group">
                  <select name="statusdosen" class="form-control">
                      <option value="AVAILABLE">AVAILABLE</option>
                      <option value="BUSY">BUSY</option>
                      <option value="UNAVAILABLE">UNAVAILABLE</option>
                    </select>
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat">Update</button>
                      </span>
                </div>
              </form>
              <center style="margin-top: 20px;">
                STATUS ANDA SAAT INI ADALAH<br>
                <label><?php echo $user['status'] ?></label>
              </center>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

          <div class="box box-solid box-info">
            <div class="box-header with-border">
              <i class="fa fa-flag"></i>
              <h3 class="box-title">Informasi Matakuliah</h3>
            </div><!-- /.box-header -->
            <div class="box-body">

              <?php
                  $sql = "select * from matakuliah where pengajar='".$user['nip']."'";
                  $sqla=mysql_query($sql);
                  while($data = mysql_fetch_array($sqla)) {
                    $pengajar = mysql_fetch_assoc(mysql_query("select * from dosen where nip = '".$data['pengajar']."'"));
                    $komting = mysql_fetch_assoc(mysql_query("select * from mahasiswa where nim = '".$data['komting']."'"));
                    $date = date_create($data['tanggaldosen']);
                    $tanggaldosen= date_format($date,"d M Y");
                    $date = date_create($data['tanggalkomting']);
                    $tanggalkomting= date_format($date,"d M Y");
                            echo ' 
                            <div class="col-md-12">
                              <div class="box box-info" style="box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.3);">
                                <div class="box-header with-border">
                                  <h3 class="box-title">'.

                                  $data['nama'].

                                  '</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">';
                                if(!empty($data['pesandosen'])){
                                  echo '
                                     <!-- Message. Default to the left -->
                                       <div class="direct-chat-msg">
                                          <div class="direct-chat-info clearfix">
                                              <span class="direct-chat-name pull-left">Dosen</span>
                                              <span class="direct-chat-timestamp pull-right">'.$tanggaldosen.'</span>
                                            </div><!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="../assets/images/'.$pengajar['foto'].'" alt="message user image"><!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">'.
                                              $data['pesandosen'].
                                            '</div><!-- /.direct-chat-text -->
                                        </div><!-- /.direct-chat-msg -->';
                                    }
                                  if(!empty($data['pesankomting'])){
                                  echo '         
                                    <div class="direct-chat-msg">
                                          <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left">Komting</span>
                                            <span class="direct-chat-timestamp pull-right">'.$tanggalkomting.'</span>
                                          </div><!-- /.direct-chat-info -->
                                          <img class="direct-chat-img" src="../assets/images/'.$komting['foto'].'" alt="message user image"><!-- /.direct-chat-img -->
                                          <div class="direct-chat-text">'.
                                            $data['pesankomting'].
                                          '</div><!-- /.direct-chat-text -->
                                    </div><!-- /.direct-chat-msg -->';
                                  }
                                    echo '
                                </div><!-- /.box-body -->
                              </div><!-- /.box -->
                            </div>';
                  }
                ?>




              
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
        
        
         
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

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
<!-- Page Script -->
<script src="../assets/js/dashboard-dosen.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>

<?php
mysql_close();
?>