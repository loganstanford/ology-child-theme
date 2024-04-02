/*  Table of Contents 
01. MENU ACTIVATION
02. MOBILE MENU
03. SCROLL TO TOP MENU JS 
04. PRELOADER JS
05. STICKY HEADER JS
06. SHOW/HIDE SEARCH & CART
*/

jQuery(document).ready(function($) {
	 'use strict';

/*
=============================================== 01. MENU ACTIVATION  ===============================================
*/
	 jQuery('.progression-studios-one-page-nav-off nav#site-navigation ul.sf-menu, nav#site-navigation-right ul.sf-menu, #progression-header-top-left-container ul.sf-menu, #progression-header-top-right-container ul.sf-menu').superfish({
			 	popUpSelector: 'ul.sub-menu,.sf-mega', 	// within menu context
	 			delay:      	200,                	// one second delay on mouseout
	 			speed:      	0,               		// faster \ speed
		 		speedOut:    	200,             		// speed of the closing animation
				animation: 		{opacity: 'show'},		// animation out
				animationOut: 	{opacity: 'hide'},		// adnimation in
		 		cssArrows:     	true,              		// set to false
			 	autoArrows:  	true,                    // disable generation of arrow mark-up
		 		disableHI:      true,
		 onBeforeShow: function() {
			 //Fix for overflowing menu items + CSS
			 //https://stackoverflow.com/questions/13980122/superfish-menu-display-subitems-left-if-there-is-not-enough-screenspace-on-the/47286812#47286812
		    if($(this).parents("ul").length > 1){
		       var w = $(window).width();  
		       var ul_offset = $(this).parents("ul").offset();
		       var ul_width = $(this).parents("ul").outerWidth();

		       // Shouldn't be necessary, but just doing the straight math
		       // on dimensions can still allow the menu to float off screen
		       // by a little bit.
		       ul_width = ul_width + 50;

		       if((ul_offset.left+ul_width > w-(ul_width/2)) && (ul_offset.left-ul_width > 0)) {
		          $(this).addClass('too_narrow_fix');
		       }
		       else {
		          $(this).removeClass('too_narrow_fix');
		       }
		    };
		 }
	 });
	 

	 
/*
=============================================== 02. MOBILE MENU  ===============================================
*/
	 
   	$('ul.mobile-menu-pro').slimmenu({
   	    resizeWidth: '1024',
   	    collapserTitle: 'Menu',
   	    easingEffect:'easeInOutQuint',
   	    animSpeed:350,
   	    indentChildren: false,
   		childrenIndenter: '- '
   	});
	
	
	$('.mobile-menu-icon-pro').on('click', function(e){
		e.preventDefault();
		$('#main-nav-mobile').slideToggle(350);
		$("#masthead-pro").toggleClass("active-mobile-icon-pro");
	});
	


/*
=============================================== 03. SCROLL TO TOP MENU JS  ===============================================
*/
  	// browser window scroll (in pixels) after which the "back to top" link is shown
	$('#pro-scroll-top').hide();
	
    $(window).scroll(function(){
		if ($(this).scrollTop() > 200) {
			$('#pro-scroll-top').fadeIn();
		} else {
			$('#pro-scroll-top').fadeOut();
		}
	 });

	 // Click event to scroll to top
     $('#pro-scroll-top').on('click', function(){
         $('html, body').animate({scrollTop : 0},800);
         return false;
     }); 
	 
	 var offset_scroll = 150;
 
	
	/* Scroll to link inside page */
	$('a.scroll-to-link').on('click', function(){
	  $('html, body').animate({
	    scrollTop: $( $.attr(this, 'href') ).offset_scroll().top - pro_top_offset
	  }, 400);
	  return false;
	});



/*
=============================================== 04. PRELOADER JS  ===============================================
*/
	(function($) {
		var didDone = false;
		    function done() {
		        if(!didDone) {
		            didDone = true;
					$("#page-loader-pro").addClass('finished-loading');
					$("#boxed-layout-pro").addClass('progression-preloader-completed');
		        }
		    }
		    var loaded = false;
		    var minDone = false;
		    //The minimum timeout.
		    setTimeout(function(){
		        minDone = true;
		        //If loaded, fire the done callback.
		        if(loaded)  {  done(); } }, 400);
		    //The maximum timeout.
		    setTimeout(function(){  done();   }, 2000);
		    //Bind the load listener.
		    $(window).load(function(){  loaded = true;
		        if(minDone) { done(); }
		    });
	})(jQuery);


/*
=============================================== 05. STICKY HEADER JS  ===============================================
*/	
	
	/* HEADER HEIGHT FOR SPACING OF ONE PAGE NAV AND STICKY HEADER */
	var pro_top_offset = $('header#masthead-pro').height();  // get height of fixed navbar
		
	var pro_very_top_bar_offset = $('#ontap-progression-header-top').height();  // get height of fixed navbar
	

	$('#progression-sticky-header').scrollToFixed({ spacerClass: 'progression-studios-remove-on-mobile' });
	

	$(window).resize(function() {
		/* STICKY HEADER CLASS */
		$(window).on('load scroll resize orientationchange', function () {
			
		    var scroll = $(window).scrollTop();
		    if (scroll >=  pro_very_top_bar_offset + 1 ) {
		        $("#progression-sticky-header").addClass("progression-sticky-scrolled");
		    } else {
		        $("#progression-sticky-header").removeClass("progression-sticky-scrolled");
		    }
		});
		
	}).resize();
	
	

/*
=============================================== 06. SHOW/HIDE SEARCH & CART  ===============================================
*/	
	var hidesearch = false;
	var hidecart = false;
	var clickOrTouch = (('ontouchend' in window)) ? 'touchend' : 'click';
	
 	$("#progression-studios-header-search-icon .progression-icon-search").on(clickOrTouch, function(e) {
		var clicks = $(this).data('clicks');
		  if (clicks) {
		     $("#progression-studios-header-search-icon").removeClass("active-search-icon-pro");
		     $("#progression-studios-header-search-icon").addClass("hide-search-icon-pro");
			 
		  } else {
		     $("#progression-studios-header-search-icon").addClass("active-search-icon-pro");
			  $("#progression-studios-header-search-icon").removeClass("hide-search-icon-pro");
		  }
		  $(this).data("clicks", !clicks);
 	});
	
	
    $("#progression-shopping-cart-toggle").hover(function(){
        if (hidecart) clearTimeout(hidecart);
		$("#progression-shopping-cart-toggle").addClass("activated-class").removeClass("hover-out-class");
    }, function() {
        hidecart = setTimeout(function() { 
			$("#progression-shopping-cart-toggle").removeClass("activated-class").addClass("hover-out-class");
		}, 100);
    });
	
	
	
});