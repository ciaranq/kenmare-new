// check if is a touch device
function is_touch_device() {
  return !!('ontouchstart' in window);
}

jQuery(document).ready(function($) {

  //mobile nav
  var mobilenav = new MobileNav('.header-nav');

  function MobileNav(nav) {
    var $nav = $(nav);
    var $navlink = $('.mobile-menu-link');

    function openNav() {
      $nav.animate({
        right: '0px'
      }, 300, 'linear');
      $nav.addClass('nav-open');
      $navlink.addClass('menu-open');
    }

    function closeNav() {
      $nav.animate({
        right: '-100%'
      }, 300, 'linear');
      $nav.removeClass('nav-open');
      $navlink.removeClass('menu-open');
    }

    $navlink.click(function() {
      if ($nav.css('right') == '0px') {
        closeNav();
      } else {
        openNav();
      }
    });

    if ($navlink.css('display') == 'block') {
      var hammer = new Hammer($nav.get(0), {
        dragLockToAxis: true,
        dragBlockHorizontal: true
      }); //hammer wants the javascript object - not the jquery one

      hammer.on('panleft panright', function(e) {
        $nav.css({
          'right': '-' + e.deltaX + 'px'
        });
      });

      hammer.on('panend', function(e) {

        if (e.deltaX < $nav.outerWidth() * .3) {
          openNav();
        } else {
          closeNav();
        }

        added = 0;

      });
    }
  }
  //end mobile nav


  //disable navigation links on first click of drop down menus for LT BIG BP
  $('.header-nav > ul > li.menu-item-has-children > a').click(function(e) {
    if ($('.header-nav').hasClass('nav-open') && !($(this).hasClass('nav-item-open'))) {
      $(this).addClass('nav-item-open');
      $(this).parent('li').find('ul').slideDown();
      e.preventDefault();
    }
  });
  //end disable navigation links on first click of drop down menus for touch devices


/// debug wpml dropdown menu
jQuery(document).ready(function(e) {
    jQuery('.wpml-ls-current-language').on('click', function(event){
        jQuery(this).find('ul.wpml-ls-sub-menu').toggleClass('open');
    });
});

  // set up carousel
  if ($('.banner-carousel').length > 0) {
    $(".banner-carousel").addClass('owl-carousel');
    $(".banner-carousel").owlCarousel({
      items: 1,
      autoplay: true,
      autoplaySpeed: 1000,
      autoplayTimeout: 10000,
      responsiveRefreshRate: 0,
      margin:0,
      loop: true,
      nav: false,
      dots: true,
      transitionStyle : "fade",
      // animateIn: 'fadeIn',
      animateOut: 'fadeOut'
    });
  }
  // end set up carousel

  /// custom product gallery
  if ($('.swiper-wrapper').length > 0) {
    $(".swiper-wrapper").addClass('owl-carousel');
    $(".swiper-wrapper").owlCarousel({
      responsive: {
        0: {
          items: 1,
        },
        451: {
          items: 2,
        },
        600: {
          items: 2,
        },
        930: {
          items: 3,
        },
        1120: {
          items: 3,
        },
      },
      autoPlay: true,
      responsiveRefreshRate: 0,
      loop: true,
      nav: false,
      dots: true
    });
  }

  //set up team carousel
  if ($('.team-carousel').length > 0) {
      $(".team-carousel").addClass('owl-carousel');
    $(".team-carousel").owlCarousel({
      responsive: {
        0: {
          items: 1,
          dots: false,
        },
        451: {
          items: 1,
          dots: false,
        },
        600: {
          items: 1,
        },
        930: {
          items: 2,
        },
        1120: {
          items: 3,

        },
      },
      autoPlay: true,
      responsiveRefreshRate: 0,
      loop: true,
      nav: true,
      dots: true
    });
  }
  // end set up of teamcarousel
  // set up products carousel
  if ($('.product-items').length > 0) {
    $(".product-items").owlCarousel({
      responsive: {
        0: {
          items: 1,
        },
        451: {
          items: 2,
        },
        600: {
          items: 2,
        },
        930: {
          items: 3,
        },
        1120: {
          items: 3,

        },
      },
      autoPlay: true,
      responsiveRefreshRate: 0,
      loop: true,
      nav: true,
      dots: false
    });
  }
  // end set up carousel
  // set up carousel
  // if ($('.subnav-cta-items').length > 0) {
  // 	$(".subnav-cta-items").each(function(i,e){
  // 		if($(this).children().length > 1) {
  // 			$(".subnav-cta-items").addClass('owl-carousel');
  // 			$(".subnav-cta-items").owlCarousel({
  // 				responsive:{
  // 						0:{
  // 								items:1,
  // 								margin:20
  // 						},
  // 						521:{
  // 								items:2,
  // 								margin:20
  // 						},
  // 						771:{
  // 								items:2,
  // 								margin:40
  // 						},
  // 						931:{
  // 								items:3,
  // 								margin:40
  // 						},
  // 				},
  // 				autoplay: true,
  // 				autoplaySpeed: 1000,
  // 				autoplayTimeout:20000,
  // 				responsiveRefreshRate:0,
  // 				loop:false,
  // 				nav:true,
  // 				navText:['<span class="screen-reader-text">Previous</span>','<span class="screen-reader-text">Next</span>'],
  // 				dots:true
  // 			});
  // 		}
  // 	});
  // }
  // end set up carousel


  /***
   * HOME INSTAGRAM PLUGIN
   ***/
  if ($('#sbi_images').length > 0) {
    $("#sbi_images").addClass('owl-carousel');
    $("#sbi_images").owlCarousel({
      responsive: {
        0: {
          items: 2
        },
        400: {
          items: 3
        },
        600: {
          items: 4
        },
        800: {
          items: 5
        }
      },
      autoplay: true,
      autoplaySpeed: 1000,
      autoplayTimeout: 15000,
      responsiveRefreshRate: 0
    });
  }


  // set up carousel
  if ($('.ti-panel-image-items').length > 0) {
    $(".ti-panel-image-items").addClass('owl-carousel');
    $(".ti-panel-image-items").owlCarousel({
      items: 1,
      autoplay: true,
      autoplaySpeed: 1000,
      autoplayTimeout: 30000,
      responsiveRefreshRate: 0,
      loop: true,
      nav: false,
      dots: true,
      // navText:['<span class="screen-reader-text">Previous</span>','<span class="screen-reader-text">Next</span>'],
    });
  }
  // end set up carousel


  // video / single lightbox
  // internals
  if ($(".lightbox-video").length > 0) {
    $(".lightbox-video").fancybox();
  }
  // video lightbox homepage
  if ($(".tc-item-videolink-link").length > 0) {
    $(".tc-item-videolink-link").fancybox();
  }

  /***
   * FAQS
   ***/
  $('.faq-item-question').click(function() {
    $(this).next($('.faq-item-answer')).slideToggle();
    $(this).toggleClass('faq-item-question-active');
    rwdTables();
  });

  /***
   * RESPONSIVE TABLES
   ***/
  rwdTables();

  function rwdTables() {
    $('.main table').each(function(index){
      var $table = $(this);
			// if table has overflowed
      $tableScrollWidth = Math.ceil($table.get(0).scrollWidth);
      $tableWidth = Math.ceil($table.width());
      $tableWrapperDoesntExist = isNaN(Math.ceil($table.width()));
			
      if (($tableScrollWidth > $tableWidth) && $tableWrapperDoesntExist) {
        $table.wrap("<div class='table-wrapper table-wrapper-'+index></div>");
        $('.table-wrapper-'+index).before('<div class="table-instruction">&#8592; Swipe table to see more</div>');
        $('.table-wrapper-'+index).after('<div class="table-instruction">&#8592; Swipe table to see more</div>');
      }
    });
  }
  // end when tables get too wide


  //responsive tabs
  $('#tabInfo').responsiveTabs({
    startCollapsed: 'accordion'
  });

  // set height for video
  fixIframeHeight();

  function fixIframeHeight() {
    var $videoHeight = $(".iframe-resize").width() * .5625; /* guesstimating a standard aspect ratio */
    $(".iframe-resize").css({
      'height': $videoHeight + 'px'
    })
  }
  window.addEventListener('resize', function(e) {
    fixIframeHeight();
  });
  // END set height for video


///select on homepage add to cart buttons
$('.pbc-item').each(function(index){
	var $btn = $(this).find('.pbc-btn');
	var $menu = $(this).find('.pbc-select');
	
	$btn.attr('disabled', true);
	$btn.addClass('disabled');
	
	$menu.change(function() {
		$btn.attr('disabled', false);
		$btn.removeClass('disabled');
	});
	
	$btn.click(function() {
		location.href = $menu.find(":selected").val();
	})
});




  ///CSS ANIMATIONS USING WAYPOINTS

  $('#moving-up').waypoint(function() {
    $("#moving-up").addClass("movingUp");
  }, {
    offset: '100%'
  });

  $('.moving-up').waypoint(function() {
    $(".moving-up").addClass("movingUp");
  }, {
    offset: '100%'
  });

  $('.tc-image-overlay:first-child').waypoint(function() {
    $(".tc-image-overlay:first-child").addClass(" movingUp");
  }, {
    offset: '200%'
  });

  $('.tc-image-overlay:last-child').waypoint(function() {
    $(".tc-image-overlay:last-child").addClass(" movingUp");
  }, {
    offset: '100%'
  });




  $('.ti-panel-contents-text-left, .ti-panel-contents-text-right, .tc-touchpoint-button, .tc-touchpoint-heading, .tc-item-left-col, .tc-item-right-col, .ti-panel-image-block').waypoint(function() {
    $(".fadeIn").css("visibility", "visible");
    $(".ti-panel-contents-text-left, .ti-panel-contents-text-right, .tc-touchpoint-button, .tc-item-left-col, .tc-item-right-col, .tc-touchpoint-heading, .ti-panel-image-block").addClass("fadeIn");

  }, {
    offset: '100%'
  });

  $('.carousel-overlay').waypoint(function() {
    $(".movingDown").css("visibility", "visible");
  }, {
    offset: '100%'
  });

  $('.ti-panel-multi-img:first-child').waypoint(function() {
    $(".ti-panel-multi-img:first-child").addClass("movingDown");
    $(".movingDown").css("visibility", "visible");
  }, {
    offset: '100%'
  });
  $('.ti-panel-multi-img:last-child').waypoint(function() {
    $(".ti-panel-multi-img:last-child").addClass("movingUp");
    $(".movingUp").css("visibility", "visible");
  }, {
    offset: '100%'
  });




  ////end of js
});
