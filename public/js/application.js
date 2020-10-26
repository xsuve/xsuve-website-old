$(document).ready(function() {
  // Affix
  $(window).scroll(function() {
    if($(window).scrollTop() <= $('body').offset().top) {
      $('.navbar-c').removeClass('affix');
    } else {
      $('.navbar-c').addClass('affix');
    }
  });

  // Navbar
  var open = false;
  $('.btn-mobile-menu').on('click', function() {
    if(open == false) {
      $('.navbar-c-links-mobile').slideDown();
      open = true;
    } else {
      $('.navbar-c-links-mobile').slideUp();
      open = false;
    }
  });

  // Portfolio
  $('.portfolio-carousel').flipster({
    scrollwheel: false
  });
});
