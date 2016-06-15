<?php 
include "session.php";
include "../koneksi.php";

if(empty($_SESSION['user'])) {
   header("Location: loginadmin.php");
}

$profil=array();
if(!isset($_GET['nip'])||empty($_GET['nip'])){            
    header("Location: index.php");
}
else{
  $sqla=mysql_query("select * from dosen where nip='".$_GET['nip']."'");
  if(mysql_num_rows($sqla)>0){
    $profil=mysql_fetch_assoc($sqla);
  }
  else{
    header("Location: index.php");
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin - IFCO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../dist/css/font-awesome.min.css">
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
      <!-- /.content -->
      <section class="content-header">
      <h1>
        Data Dosen
      </h1>
    </section>
    
      

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
    <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../assets/images/<?php echo $profil['foto'] ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $profil['nama'] ?></h3>

              <p class="text-muted text-center">NIP : <?php echo $profil['nip'] ?>  
            </div>
            <!-- /.box-body -->
          </div>
        </div>                        
        
        <!-- left column -->
        <div class="col-md-5">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Edit</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="index.php" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputNama">Nama</label>
                  <input name="nama" type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama" value=<?php echo $profil['nama'] ?>>
                </div>
                <div class="form-group">
                  <input name="nip" type="hidden" class="form-control" id="exampleInputNIP" placeholder="14081070100" value=<?php echo $profil['nip'] ?>>
                </div>
                <div class="form-group">
                    <label for="exampleInputGender">Jenis Kelamin</label><br/>
                    <input type="radio" name="gender" value="male" checked> Male
                    <input type="radio" name="gender" value="female"> Female
                </div>
                <div class="form-group">
                  <label for="exampleInputAbout">Deskripsi</label>
                  <textarea name="deskripsi" class="form-control hresize" id="des"><?php echo $profil['deskripsi'] ?></textarea>        
                </div>
                <div class="form-group">
                  <label for="exampleInputAbout">About</label>
                  <textarea name="about" class="form-control hresize" id="encJs2"><?php echo $profil['about'] ?></textarea>
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputAward">Award</label>
                  <textarea name="award" class="form-control hresize" id="encJs2"><?php echo $profil['award'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputAward">Misc</label>
                  <textarea name="misc" class="form-control hresize" id="encJs2"><?php echo $profil['misc'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Masukkan Foto</label>
                  <input name="fotodosen" type="file" id="exampleInputFile">
                  <p class="help-block">Max 160 x 160 Pixel</p>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button name="editdosen" type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div> 
        </div>

        
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Mata Kuliah</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div><!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="index.php" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputNama">Nama Mata Kuliah</label>
                  <input name="namamk" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Mata Kuliah">
                  <input name="nip" type="hidden" value=<?php echo $profil['nip'] ?>>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button name="tambahmk" type="submit" class="btn btn-primary pull-right">Submit</button>
              </div>
            </form>
          </div> 
        </div>

      </div>
    </section>
    
  </div>
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 0.0.1
      </div>
      <strong>Copyright &copy; 2016-2017 <a href="#">IFCO</a>.</strong> All rights
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
