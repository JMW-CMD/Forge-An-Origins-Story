$( document ).ready(function() {
  
    // Activate Mobile Menu:
    // 1. Toggle Mobile Menu clicking on the hamburger icon
    // 2. Close Mobile Menu when mousing outside of it

    function open_mobile_menu() {

        // Cache selectors
        var hamburger_icon = $( '#mobile-menu-icon' );
        var mobile_menu = $( '#mobile-menu' );
        var mobile_menu_hover_test = $( '#nav-wrapper, #mobile-menu' );

        // Toggle Mobile Menu
        hamburger_icon.click( function() {

            mobile_menu.slideToggle( 'fast' );
       
        });

        // Close Mobile Menu when mousing outside of it
        mobile_menu_hover_test.mouseleave( function() {            
            
            if ( !$( mobile_menu ).is( ':hover' ) ) {
                
                mobile_menu.slideUp( 'fast' );

            }
                   
        });

    }

    open_mobile_menu();

});

