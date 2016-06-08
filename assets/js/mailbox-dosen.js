$(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages  input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
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
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
      if(!$this.hasClass("fa-star-o")){
        favoritpesan("FAVORITE",trid);
      }
      else{
        favoritpesan("UNFAVORITE",trid);
      }
    });
  });

  function favoritpesan(tipe, id) { 
    $.post("../pesan.php",
      {
          tipe: tipe,
          id: id
      },
      function(data, status){
          //alert("Data: " + data + "\nStatus: " + status);
      }
    );
  }

  function refresh(){
    window.location.href="mailbox.php";
  }

  function hapusBanyak(){
    var selected = [];
    $('#listpesan input:checked').each(function() {
        selected.push($(this).closest('tr').attr('id'));
    });

    $.post("../pesan.php",
      {
          tipe: "hapus",
          id: selected
      },
      function(data, status){
          window.location.href="mailbox.php";
      }
    );
  }

  function hapuspesan(id){
    $.post("../pesan.php",
      {
          tipe: "hapus",
          id: id
      },
      function(data, status){
          window.location.href="mailbox.php";
      }
    );
  }