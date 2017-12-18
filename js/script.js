jQuery(function () {
	"use strict";
    
    // Preloader
	$(window).load(function() { // makes sure the whole site is loaded
		$('#status').fadeOut(3500); // will first fade out the loading animation
		$('#preloader').delay(3000).fadeOut('slow'); // will fade out the white DIV that covers the website.
		
	})
    

	// Document Ready Method 
	$(document).ready(function(){
        
		// Countdown
		$(function(){
            
			var endDate = "June 7, 2016 15:03:25";

			$('.countdown.styled').countdown({
			  date: endDate,
			  render: function(data) {
				$(this.el).html("<div>" + "<span>" + this.leadingZeros(data.days, 3) + "</span>" + " <span>Days</span></div><div>" + "<span>" + this.leadingZeros(data.hours, 2) + "</span>" + " <span>Hours</span></div><div>" + "<span>" + this.leadingZeros(data.min, 2) + "</span>" + " <span>Minutes</span></div><div>" + "<span>" + this.leadingZeros(data.sec, 2) + "</span>" + " <span>Seconds</span></div>");
			  }
			});
            
		}); // End Countdown
		
        
        
        // Owl Carousel
		 $("#owl-demo").owlCarousel({
			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true,
			autoPlay: true,
			navigationText:["<",">"],
		});
		 $(".testimonials").owlCarousel({
			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true,
			autoPlay: true,
			navigationText:["<",">"],
		});

        // Google Map
		var myOptions = {
			zoom: 15,
			center: new google.maps.LatLng(25.493240, 81.861659),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#193341"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2c5a71"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#29768a"},{"lightness":-37}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#3e606f"},{"weight":2},{"gamma":0.84}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"#1a3541"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#2c5a71"}]}]
		};
		
		var map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);


        // Navigation  
		$('#navigation').onePageNav({
			'scrollOffset': 0,
		});
		 jQuery('#navigation').affix({
		  offset: { top: $('#navigation').offset().top }
		});
		jQuery('.navbar-collapse').click('li', function() {
			jQuery('.navbar-collapse').collapse('hide');
		});
        
        
        // Magnific Popup

		// Initialize popup as usual
		$('.popup-link').magnificPopup({
		  type: 'image',
		  mainClass: 'mfp-with-zoom', // this class is for CSS animation below

		    
		  // other options
			gallery: {
			  enabled: true, // set to true to enable gallery

			  preload: [0,2], // read about this option in next Lazy-loading section

			  navigateByImgClick: true,

			  arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button

			  tPrev: 'Previous (Left arrow key)', // title for left button
			  tNext: 'Next (Right arrow key)', // title for right button
			  tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
			},
		    
		    
		  zoom: {
		    enabled: true, // By default it's false, so don't forget to enable it

		    duration: 300, // duration of the effect, in milliseconds
		    easing: 'ease-in-out', // CSS transition easing function

		    // The "opener" function should return the element from which popup will be zoomed in
		    // and to which popup will be scaled down
		    // By defailt it looks for an image tag:
		    opener: function(openerElement) {
		      // openerElement is the element on which popup was initialized, in this case its <a> tag
		      // you don't need to add "opener" option if this code matches your needs, it's defailt one.
		      return openerElement.is('img') ? openerElement : openerElement.find('img');
		    }
		  }

		});
     
        
        
        // Text Rotator
        $(".rotate").textrotator({
          animation: "dissolve", // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
          separator: ",", // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
          speed: 5000 // How many milliseconds until the next word show.
        });
        
		
        // Parallax
		$('#home').parallax("50%", 0.1);
		$('.testimonial-area').parallax("50%", 0.1);
		$('.separator-area').parallax("50%", 0.1);
		$('.venue-area').parallax("50%", 0.1);
		$('.faq-area').parallax("50%", 0.1);
		$('#subscribe').parallax("50%", 0.1);
		$('.tab_panel_one').parallax("50%", 0.1);
		$('.conact-area').parallax("50%", 0.1);
        
	}); // End Document Ready Method
	
}());

