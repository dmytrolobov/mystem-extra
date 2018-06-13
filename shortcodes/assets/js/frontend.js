/*-----------------------------------------------------------------------------------*/
/*	jQuery Tabs
/*-----------------------------------------------------------------------------------*/	
(function($) {
	$(function() {
		
		$('ul.tabs__caption').on('click', 'li:not(.active)', function() {
			$(this)
			.addClass('active').siblings().removeClass('active')
			.closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
		});
		
	});
})(jQuery);


/*-----------------------------------------------------------------------------------*/
/*	jQuery Accordion
/*-----------------------------------------------------------------------------------*/	
jQuery(document).ready(function() {
	//ACCORDION BUTTON ACTION (ON CLICK DO THE FOLLOWING)
	jQuery('.accordion-title').click(function() {
		//REMOVE THE ON CLASS FROM ALL BUTTONS
		jQuery('.accordion-title').removeClass('active');
		//NO MATTER WHAT WE CLOSE ALL OPEN SLIDES
		jQuery('.accordion-content').slideUp('normal');
		//IF THE NEXT SLIDE WASN'T OPEN THEN OPEN IT
		if(jQuery(this).next().is(':hidden') == true) {
			//ADD THE ON CLASS TO THE BUTTON
			jQuery(this).addClass('active');
			//OPEN THE SLIDE
			jQuery(this).next().slideDown('normal');
		}
	});
	// CLOSES ALL S ON PAGE LOAD
	jQuery('.accordion-content').hide();
}); 


/*-----------------------------------------------------------------------------------*/
/*	jQuery Toggles
/*-----------------------------------------------------------------------------------*/	
//Hide (Collapse) the toggle containers on load
	jQuery(".toggle-content").hide(); 
	//Switch the "Open" and "Close" state per click
	jQuery(".toggle-action").toggle(function(){
		jQuery(this).addClass("active");
		}, function () {
		jQuery(this).removeClass("active");
	});
	//Slide up and down on click
	jQuery(".toggle-action").click(function(){
		jQuery(this).next(".toggle-content").slideToggle();
	});
	
	
