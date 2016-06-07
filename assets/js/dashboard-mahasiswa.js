  $(function () {
    $(".favorit-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var fa = $this.hasClass("fa");
      var sectionid = $(this).closest('section').attr('id');

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
      if(!$this.hasClass("fa-star-o")){
        favorit("favorite",sectionid);
      }
      else{
        favorit("unfavorite",sectionid);
      }
    });
  });

  function favorit(tipe, nip) { 
    $.post("favorit.php",
      {
          tipe: tipe,
          nip: nip
      },
      function(data, status){
          window.location.href="index.php";
      }
    );
  }

  function unsubscibe(id){
  	$.post("subscribe.php",
      {
          tipe: "unsubscribe",
          id: id
      },
      function(data, status){
          window.location.href="index.php";
      }
    );
  }

  function updateinfo(idpelajaran){
    var pesan = $('textarea#textarea'+idpelajaran).val();
    if(pesan!=""){
      $.post("informasi.php",
        {
            tipe: "update",
            pengirim: "komting",
            idpelajaran: idpelajaran,
            pesan: pesan
        },
        function(data, status){
            window.location.href="index.php";
        }
      );
    }
    else{
      document.getElementById('textarea'+idpelajaran).style.borderColor="red";
    }
  }

  function hapusinfo(idpelajaran){
    $.post("informasi.php",
        {
            tipe: "hapus",
            pengirim: "komting",
            idpelajaran: idpelajaran
        },
        function(data, status){
            window.location.href="index.php";
        }
      );
  }

  function editlist(idcatatan){
    document.getElementById('catatan'+idcatatan).style.display = "none";
    document.getElementById('editcatatan'+idcatatan).style.display = "block";
  }

  function hapuslist(idcatatan){
    $.post("catatan.php",
        {
            tipe: "hapus",
            idcatatan: idcatatan
        },
        function(data, status){
            //window.location.href="index.php";
            $("#catatan"+idcatatan).closest('li').remove();
        }
    );
  }

  function batalEdit(idcatatan){
    document.getElementById('catatan'+idcatatan).style.display = "block";
    document.getElementById('editcatatan'+idcatatan).style.display = "none";
  }

  function simpanEdit(idcatatan){
    var catatan = $('#inputcatatan'+idcatatan).val();
    if(catatan!=""){
      $.post("catatan.php",
        {
            tipe: "edit",
            idcatatan: idcatatan,
            catatan: catatan
        },
        function(data, status){
            //window.location.href="index.php";
            document.getElementById("teks"+idcatatan).innerHTML = catatan;
            batalEdit(idcatatan);
        }
      );
    }
    else{
      document.getElementById('inputcatatan'+idcatatan).style.borderColor="red";
    }
  }

  function catatanbaru(){
    document.getElementById('tambahcatatan').style.display = "block";
  }

  function bataltambah(){
    $('#input-tambahcatatan').val('');
    document.getElementById('tambahcatatan').style.display = "none";
  }

  function tambahcatatan(){
    var catatan = $('#input-tambahcatatan').val();
    if(catatan!=""){
      $.post("catatan.php",
        {
            tipe: "tambah",
            catatan: catatan
        },
        function(data, status){
            //window.location.href="index.php";
            $('#listcatatan:last').append( 
              `
                      <li>
                        <div id="catatan`+data+`">
                          <!-- drag handle -->
                              <span class="handle">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                              </span>
                          <!-- todo text -->
                          <span id="teks`+data+`" class="text">`+catatan+`</span>
                          <!-- General tools such as edit or delete-->
                          <div class="tools">
                            <i onclick="editlist(`+data+`)" class="fa fa-edit"></i>
                            <i onclick="hapuslist(`+data+`)" class="fa fa-trash-o"></i>
                          </div>
                        </div>
                        <div id="editcatatan`+data+`" style="display: none;">
                          <div class="input-group">
                            <input id="inputcatatan`+data+`" type="text" name="edit" class="form-control" placeholder="Edit" value="`+catatan+`">
                                <span class="input-group-btn">
                                  <button onclick="simpanEdit(`+data+`)" type="button" name="simpanEdit" id="submitEdit" class="btn btn-flat"><i class="fa fa-pencil"></i>
                                  </button>
                                  <button onclick="batalEdit(`+data+`)" type="button" name="batalEdit" id="batalEdit" class="btn btn-flat"><i class="fa fa-close"></i>
                                  </button>
                                </span>
                          </div>
                        </div>
                      </li>     
              `
            );
            bataltambah();
        }
      );
    }
    else{
      document.getElementById('input-tambahcatatan').style.borderColor="red";
    }
  }