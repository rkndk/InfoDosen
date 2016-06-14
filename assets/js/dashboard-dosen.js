  function updateinfo(idpelajaran){
    var pesan = $('textarea#textarea'+idpelajaran).val();
    if(pesan!=""){
      $.post("../informasi.php",
        {
            tipe: "update",
            pengirim: "dosen",
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

  function hapusinfodosen(idpelajaran){
    $.post("../informasi.php",
        {
            tipe: "hapus",
            pengirim: "dosen",
            idpelajaran: idpelajaran
        },
        function(data, status){
            window.location.href="index.php";
        }
      );
  }

  function hapusinfokomting(idpelajaran){
    $.post("../informasi.php",
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

  function hapussubscribe(pelajaran, nip){
    $.post("../subscribe.php",
      {
          tipe: "unsubscribe",
          user: nip,
          pelajaran: pelajaran
      },
      function(data, status){
          window.location.href="index.php";
      }
    );
  }

  function acceptsubscribe(pelajaran, nip){
    $.post("../subscribe.php",
      {
          tipe: "accept",
          user: nip,
          pelajaran: pelajaran
      },
      function(data, status){
          window.location.href="index.php";
      }
    );
  }

  function hapuskomting(idpelajaran){
    $.post("../informasi.php",
        {
            tipe: "hapuskomting",
            pengirim: "dosen",
            idpelajaran: idpelajaran
        },
        function(data, status){
            window.location.href="index.php";
        }
      );
  }

  function tambahkomting(idpelajaran){
    var nimkomting= ('#nimkomting').val();
    $.post("../informasi.php",
        {
            tipe: "tambahkomting",
            pengirim: "dosen",
            nimkomting: nimkomting,
            idpelajaran: idpelajaran
        },
        function(data, status){
            window.location.href="index.php";
        }
      );
  }