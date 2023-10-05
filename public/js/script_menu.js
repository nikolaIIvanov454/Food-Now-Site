window.onload = () =>{
  try{
    let cartContainer = document.querySelector('#cart');
    let icons = document.getElementsByClassName("fa-shopping-cart")[0];

    icons.addEventListener('click', () => {
      if (cartContainer.style.display === 'block') {
        cartContainer.style.display = 'none';
      } else {
        cartContainer.style.display = 'block';
      }
    });
  }catch (exeption){
    
  }
  
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

