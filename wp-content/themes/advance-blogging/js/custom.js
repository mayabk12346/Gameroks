jQuery(function($){
 "use strict";
   jQuery('.main-menu-navigation > ul').superfish({
     delay:       500,                            
     animation:   {opacity:'show',height:'show'},  
     speed:       'fast'                        
   });

});

function resMenu_open() {
	  document.getElementById("menu-sidebar").style.width = "250px";
}
function resMenu_close() {
  document.getElementById("menu-sidebar").style.width = "0";
}

function search_open() {
	jQuery(".serach_outer").animate({width: '100%'});
}
function search_close() {
	jQuery(".serach_outer").animate({width: '0'});
}
(function( $ ) {

	/**** Hidden search box ***/
	// jQuery('document').ready(function($){
	// 	$('.search-box span i').click(function(){
	//         $(".serach_outer").animate({width: '100%'});
	//     });

	//     $('.closepop i').click(function(){
	//         $(".serach_outer").animate({width: '0'});
	//     });
	// });
		
})( jQuery );