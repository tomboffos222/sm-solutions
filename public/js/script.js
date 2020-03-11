// header start //
$(document).ready(function() {
  $('.header__burger').click(function(event) {
    $('.header__burger,.header__menu').toggleClass('active');
    $('body').toggleClass('lock');
  });
  $('.header__list a').click(function(){
      $('.header__burger,.header__menu').toggleClass('active');
      $('body').toggleClass('lock');

  });
});


// header end //
$(document).ready(function(){
  $(".owl-new").owlCarousel({
  margin:50,
  nav:true,
  dots:true,
  loop:true,
  responsive : {
    // breakpoint from 0 up
	    0 : {

	       items:1
	    },
	    // breakpoint from 480 up
	    480 : {
	       items:1
	    },
	    // breakpoint from 768 up
	    768 : {
	       items:3
	    }
	}
  });
});

