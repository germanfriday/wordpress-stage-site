/**
*
* -----------------------------------------------------------------------------
*
* Template : Mifo - Creative Portfolio Wordpress Theme 
* Author : rs-theme
* Author URI : http://www.rstheme.com/
*
* -----------------------------------------------------------------------------
*
**/

(function($) {
    "use strict";
    // sticky menu
    var header = $('.menu-sticky');
    var win = $(window);

    win.on('scroll', function() {
       var scroll = win.scrollTop();
       if (scroll < 150) {
           header.removeClass("sticky");
       } else {
           header.addClass("sticky");
       }
    });

    // Smooth About
    if ($('.smoothAbout').length){
         $(".smoothAbout").on(' click ', function() {
             $('html, body').animate({
                 scrollTop: $("#rs-about").offset().top
             }, 1000);
         });
    }

    // Floating Contact Show/Hide
    if ($('.floating-icons').length){
         $(".floating-icons").on(' click ', function() {
            $(".floating-bar").slideToggle( "fast" );
            $(".floating-bar").toggleClass( "show" );
            $(this).toggleClass("float-close");
         });
    }

    // Smooth Contact
    if ($('.smoothContact').length){
         $(".smoothContact").on(' click ', function() {
             $('html, body').animate({
                 scrollTop: $("#map").offset().top
             }, 1000);
         });
    }

    // Smooth Start
    if ($('.smoothStart').length){
        $(".smoothStart").on(' click ', function() {
            $('html, body').animate({
                scrollTop: $("#rs-header").offset().top
            }, 1000);
        });
    }

    // Smooth Portfolio
    if ($('.smoothPortfolio').length){
        $(".smoothPortfolio").on(' click ', function() {
            $('html, body').animate({
                scrollTop: $("#rs-portfolio").offset().top
            }, 1000);
        });
    }

    if ($('.page-template-page-single-php .nav').length) {
        $('.nav').onePageNav({
        currentClass: 'active',
        changeHash: false,
        scrollSpeed: 750,
        scrollThreshold: 0.5,
        offsetHeight: 100,
        filter: '',
        easing: 'swing',
        begin: function() {
            //I get fired when the animation is starting
        },
        end: function() {
            //I get fired when the animation is ending
        },
        scrollChange: function($currentListItem) {
            //I get fired when you enter a section and I pass the list item of the section
        }
    });  
}


if ($('.page-template-page-particles-php .nav').length) {
        $('.nav').onePageNav({
        currentClass: 'active',
        changeHash: false,
        scrollSpeed: 750,
        scrollThreshold: 0.5,
        offsetHeight: 100,
        filter: '',
        easing: 'swing',
        begin: function() {
            //I get fired when the animation is starting
        },
        end: function() {
            //I get fired when the animation is ending
        },
        scrollChange: function($currentListItem) {
            //I get fired when you enter a section and I pass the list item of the section
        }
    });  
}

    
     // Canvas Menu Js
    $( ".nav-link-container > a" ).off("click").on("click", function(event){
        event.preventDefault();
        $(".nav-link-container").toggleClass("nav-inactive-menu-link-container");
        $(".sidenav").toggleClass("nav-active-menu-container");

    });
    
    $(".nav-close-menu-li > button").on('click', function(event){
        $(".sidenav").toggleClass("nav-active-menu-container");
        $(".content").toggleClass("inactive-body");
    });

    if ($('.rs-portfolio-style4 ').length) {

    // image loaded portfolio init
    $('.grid').imagesLoaded(function() {
        $('.portfolio-filter').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
      var $grid = $('.grid').isotope({
      itemSelector: '.grid-item',
      percentPosition: true,
      masonry: {
          columnWidth: '.grid-item',
      }
    });


    //****************************
  // Isotope Load more button
  //****************************

  var initShow = parseInt(portfolio_data.per_page); //number of items loaded on init & onclick load more button
  var counter = initShow; //counter for load more button
  var iso = $grid.data('isotope'); // get Isotope instance

  loadMore(initShow); //execute function onload

  function loadMore(toShow) {
    $grid.find(".hidden").removeClass("hidden");

    var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
      return item.element;
    });
    $(hiddenElems).addClass('hidden');
    $grid.isotope('layout');

    //when no more to load, hide show more button
    if (hiddenElems.length == 0) {
      jQuery("#load-more-view").hide();
    } else {
      jQuery("#load-more-view").show();
    };

  }

  //when load more button clicked
    $("#load-more-view").click(function() {
      if ($('#filters').data('clicked')) {
        //when filter button clicked, set initial value for counter
        counter = initShow;
   
        $('#filters').data('clicked', false);
      } else {
        counter = counter;
        
      };
      counter = counter + initShow;
      console.log(counter);
      loadMore(counter);
    });

    //when filter button clicked
    $("#filters").click(function() {
      $(this).data('clicked', true);

      loadMore(initShow);
    });   
         
  }); 

}    
         
    // portfolio Filter
    $('.portfolio-filter button').on('click', function(event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });

    $(".rs-banner .cd-words-wrapper p:first-child").addClass("is-visible");

    // collapse hidden
    $(function(){ 
         var navMain = $(".navbar-collapse"); // avoid dependency on #id
         // when you have dropdown inside navbar
         navMain.on("click", "a:not([data-toggle])", null, function () {
             navMain.collapse('hide');
         });
     });


	// video 
	if ($('.player').length) {
		$(".player").YTPlayer();
	}
      
        
     // magnificPopup init
    $('.image-popup').magnificPopup({
        type: 'image',
        callbacks: {
            beforeOpen: function() {
               this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure animated zoomInDown');
            }
        },
        gallery: {
            enabled: true
        }
    });
    
    // Get a quote popup

    $('.popup-quote').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#qname',
        removalDelay: 500, //delay removal by X to allow out-animation
        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {
                this.st.mainClass = this.st.el.attr('data-effect');
                if($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#qname';
                }
            }
        }
    });
	
	 

	 // team init
    $(".team-carousel").each(function() {
            var options = $(this).data('carousel-options');
            $(this).owlCarousel(options); 
    });

    // slider init
    $(".slider-carousel").each(function() {
            var options = $(this).data('carousel-options');
            $(this).owlCarousel(options); 
    });
	
	 // partner init

       $('.gallery-slider').slick({
      centerMode: false,
      centerPadding: '0',
      slidesToShow: 4,
      arrows: true,
      dots: false,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: '0',
            slidesToShow: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: '0',
            slidesToShow: 1
          }
        }
      ]
    });

    // testimonial init   
    $('.testi-carousel').slick({
          centerMode: true,
          centerPadding: '0px',
          slidesToShow: 3,
          focusOnSelect: true,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '0px',
                slidesToShow: 3
              }
            },
            {
              breakpoint: 480,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '0px',
                slidesToShow: 1
              }
            }
          ]
        });

    // Slider init   
    $('.rs-slider-carousel').slick({
        centerPadding: '0px',
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true
    });
		
    
    $(".testi-item  a.tab").on('click', function(e){
          e.preventDefault();
          slideIndex = $(this).index();
          $( '.testi-carousel' ).slickGoTo( parseInt(slideIndex) );
        }); 

    // blog init
     $(".blog-carousel").each(function() {
            var options = $(this).data('carousel-options');
            $(this).owlCarousel(options); 
    });
    $(function(){ 
        $( "ul.children" ).addClass( "sub-menu" );
    });    
     //Videos popup jQuery activation code
    $('.popup-videos').magnificPopup({
        disableOn: 10,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    }); 
  //preloader
    $(window).on( 'load', function() {
        $("#loading").delay(1000).fadeOut(500);
        $("#loading-center").on( 'click', function() {
        $("#loading").fadeOut(500);
        })

    if($(window).width() < 992) {
      $('.rs-menu').css('height', '0');
      $('.rs-menu').css('opacity', '0');
      $('.rs-menu').css('z-index', '-1');
      $('.rs-menu-toggle').on( 'click', function(){
         $('.rs-menu').css('opacity', '1');
         $('.rs-menu').css('z-index', '1');
     });
    }
    })
		
    // Counter Up  
    $('.rs-counter').counterUp({
        delay: 20,
        time: 1500
    });
	
    // scrollTop init
	var win=$(window);
    var totop = $('#scrollUp');    
    win.on('scroll', function() {
        if (win.scrollTop() > 150) {
            totop.fadeIn();
        } else {
            totop.fadeOut();
        }
    });
    totop.on('click', function() {
        $("html,body").animate({
            scrollTop: 0
        }, 500)
    });	

    $(function(){ 
        $( ".sidenav ul.children" ).addClass( "sub-menu" );
    });

  $(".sidenav .menu li").on('click', function() {
        $('.sidenav .menu li.active_menu').removeClass("active_menu");
        $(this).addClass("active_menu");
    });

    //RTL fix issue JS
  if ($('body').hasClass("rtl")) {
    function bs_fix_vc_full_width_row(){
        var $elements = jQuery('[data-vc-full-width="true"]');
        jQuery.each($elements, function () {
            var $el = jQuery(this);
            $el.css('right', $el.css('left')).css('left', '');
        });
    }

    // Fixes rows in RTL
    jQuery(document).on('vc-full-width-row', function () {
        bs_fix_vc_full_width_row();
    });

    // Run one time because it was not firing in Mac/Firefox and Windows/Edge some times
    bs_fix_vc_full_width_row();
  }

})(jQuery);