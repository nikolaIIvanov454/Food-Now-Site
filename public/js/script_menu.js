window.onload = () =>{
    $(document).ready(function() {
    $("#nav-icon").click(function() {
      $(".navbar-items").slideToggle();
    });
  });
  
  $(document).ready(function(){
    $('#nav-icon').click(function(){
      $(this).toggleClass('open');
    });
  });
}

