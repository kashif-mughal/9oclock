$(document).ready(function () {
   $('.bg-overlay').hide();
      $("body").css({"height": "100%", "overflow-y": "none"});
      $("html").css({"overflow": "auto"});
  // $(".featured-product-slider").slick({
  //   dots: true,
  //   infinite: true,
  //   speed: 300,
  //   slidesToShow: 4,
  //   slidesToScroll: 4,
  //   responsive: [
  //     {
  //     breakpoint: 1024,
  //     settings: {
  //       slidesToShow: 3,
  //       slidesToScroll: 3,
  //       infinite: true,
  //       dots: true
  //     }
  //   },
  //   {
  //     breakpoint: 600,
  //     settings: {
  //       slidesToShow: 3,
  //       slidesToScroll: 3
  //     }
  //   },
  //   {
  //     breakpoint: 480,
  //     settings: {
  //       slidesToShow: 2,
  //       slidesToScroll: 2
  //     }
  //   }
  //   ]
  // });

  $('.featured-product-slider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    responsive: [
    {
       breakpoint: 2559,
       settings: {
          slidesToShow: 6,
          slidesToScroll: 6,
          infinite: true,
          dots: false
       }
    },
    {
       breakpoint: 1440,
       settings: {
          slidesToShow: 6,
          slidesToScroll: 6,
          dots: false
       }
    },
    {
       breakpoint: 1200,
       settings: {
          slidesToShow: 6,
          slidesToScroll: 6,
          dots: false
       }
    },
    {
       breakpoint: 992,
       settings: {
          slidesToShow: 5,
          slidesToScroll: 5
       }
    },
    {
       breakpoint: 768,
       settings: {
          slidesToShow: 3,
          slidesToScroll: 3
       }
    },
    {
       breakpoint: 576,
       settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          //centerMode: true
       }
    }
    ]
  });
   
   $(".bg-overlay").click(function () {
      $("#mySidenav").css('right', '-315px');
      $('.bg-overlay').fadeOut();
   });
    
   $("#btn-sidebar").click(function () {
      var screenWidth = $(document).width();
      
      // document.getElementById("mySidenav").style.width = "315px";
      document.getElementById("mySidenav").style.right = "0";
      $('.bg-overlay').fadeIn();
      var bodyContent = document.getElementById("body-content");
      if(bodyContent)
         bodyContent.style.marginLeft = "315px";
   //  $('.sidebar-menu').fadeIn("slow");
    // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  });

   $("#btn-close-sidebar").click(function () {
      var screenWidth = $(document).width();
      // document.getElementById("mySidenav").style.width = "0";
      document.getElementById("mySidenav").style.right = "-315px";
      $('.bg-overlay').fadeOut();
      var bodyContent = document.getElementById("body-content");
      if(bodyContent)
         bodyContent.style.marginLeft = "0";
   //  $('.sidebar-menu').fadeOut(1000);
    // document.body.style.backgroundColor = "white";
  });

  if ($(window).width() < 768) {
      $(".edibles-main .product-category").removeClass('show');
      $(".filter-brand-button").removeClass('show');
      $(".filter-weight-button").removeClass('show');
      $(".filter-type-checkbox").removeClass('show');
      $("#InnerPageMenuContent").removeClass('show');
      $('.bg-overlay').hide();
  }

  
  
  $(window).resize(WindowsResizeFunc);
 
});