$(document).ready(function(){ 
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 500); 
        return false; 
    }); 
    autoheight();
});

jQuery(function() {

$(".menuscroll").bind('click','a', function(event){ 
  //alert();
    event.preventDefault();
    var o =  $( $(this).data("ref") ).offset();   
    var sT = o.top // get the fixedbar height
//    var sT = o.top - $(".mainmenu-area.header").outerHeight(true); // get the fixedbar height
    // compute the correct offset and scroll to it.
   // window.scrollTo(0,sT);
     $('html, body').animate({
          scrollTop: sT
        }, 1000);
});


  // $('a[href*="#"]:not([href="#"])').click(function(event) {
  //   event.preventDefault();
  //   if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
  //     var target = $(this.hash);
  //     target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
  //     if (target.length) {
  //       $('html, body').animate({
  //         scrollTop: target.offset().top-$('.mainmenu-area.header').outerHeight(true)
  //       }, 2000);
  //       return false;
  //     }
  //   }
  // });
});

// var slideIndex = 0;
// showSlides();

// function showSlides() {
//     var i;
//     var slides = document.getElementsByClassName("mySlides");
//     console.log(slides.length);
//     // var dots = document.getElementsByClassName("dot");
//     for (i = 0; i < slides.length; i++) {
//        slides[i].style.display = "none";  
//     }
//     slideIndex++;
//     if (slideIndex > slides.length) {slideIndex = 1}    
 
//     slides[slideIndex-1].style.display = "block";  
//     // dots[slideIndex-1].className += " active";
//     setTimeout(showSlides, 3000); // Change image every 2 seconds
// }

$('.bxslider').bxSlider({
  
});

function autoheight(){
  wh=$(window).height();
  $('.custom_height').css('height',wh);
}
autoheight();

$(window).resize(function(){
  autoheight();
});