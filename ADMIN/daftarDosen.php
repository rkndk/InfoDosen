<?php 
include "session.php";
include "../koneksi.php";

if(empty($_SESSION['user'])) {
   header("Location: loginadmin.php");
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
        </div>                        
        
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Daftar</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="index.php" role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputNama">Nama</label>
                  <input name="nama" type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                  <label for="exampleInputNIP">NIP</label>
                  <input name="nip" type="number" class="form-control" id="exampleInputNIP" placeholder="NIP">
                </div>
                <div class="form-group">
                  <label for="exampleInputNIP">Email</label>
                  <input name="email" type="email" class="form-control" id="exampleInputNIP" placeholder="Email">
                </div>
                <div class="form-group">                  
                    <label for="exampleInputGender">Jenis Kelamin</label><br/>
                    <input type="radio" name="gender" value="male" > Male
                    <input type="radio" name="gender" value="female"> Female                  
                </div>
                <div class="form-group">
                  <label for="exampleInputAbout">Deskripsi</label>
                  <textarea name="deskripsi" class="form-control hresize" id="des"></textarea>        </div>
                   <div class="form-group">
                  <label for="exampleInputAbout">About</label>
                  <textarea name="about" class="form-control hresize" id="about"></textarea>        </div>
                <div class="form-group">
                  <label for="exampleInputAward">Award</label>
                  <textarea name="award" class="form-control hresize" id="award"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputAward">Misc</label>
                  <textarea name="misc" class="form-control hresize" id="misc"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Masukkan Foto</label>
                  <input name="fotodosen" type="file" id="exampleInputFile">
                  <p class="help-block">Max 160 x 160 Pixel</p>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button name="tambahdosen" type="submit" class="btn btn-primary">Submit</button>
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
