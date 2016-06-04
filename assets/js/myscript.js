  $(function () {
    //Handle starringfont awesome
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