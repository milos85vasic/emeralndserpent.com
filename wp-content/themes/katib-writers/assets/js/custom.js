(function( $ ) {

	/**** Hidden search box ***/
	jQuery('document').ready(function($){
		jQuery('.search-box span i').click(function(){
	        jQuery(".serach_outer").slideDown(700);
	    });

	    jQuery('.closepop i').click(function(){
	        jQuery(".serach_outer").slideUp(700);
	    });
	});
})( jQuery );