 /*
 * Custom scripts
 * Description: Custom scripts for NepalBuzz
 */

jQuery( document ).ready(function($) {
    var jQueryheader_search = $( '#search-toggle' );
    jQueryheader_search.click( function() {
        var jQuerythis_el_search = $(this),
            jQueryform_search = jQuerythis_el_search.siblings( '#search-container' );

        if ( jQueryform_search.hasClass( 'displaynone' ) ) {
            jQueryform_search.removeClass( 'displaynone' ).addClass( 'displayblock' ).animate( { opacity : 1 }, 300 );
        } else {
            jQueryform_search.removeClass( 'displayblock' ).addClass( 'displaynone' ).animate( { opacity : 0 }, 300 );
        }
    });

    //Sticky Header Top bar when there is admin bar
    var stickyNav = function(){
        var scrollTop = $(window).scrollTop();

        if (scrollTop > 46) {
            $('#header-top').addClass('sticky');
        } else {
            $('#header-top').removeClass('sticky');
        }
    };

    stickyNav();

    $(window).scroll(function() {
      stickyNav();
    });


    //Fit vids
    if ( $.isFunction( $.fn.fitVids ) ) {
        $('.hentry, .widget').fitVids();
    }

    //Load Menu
    /**
     * Contains handlers for navigation
     */

    var body, masthead, menuToggle, siteNavigation, siteHeaderMenu;

    function initMainNavigation( container ) {
        // Add dropdown toggle that displays child menu items.
        var dropdownToggle = $( '<button />', {
            'class': 'dropdown-toggle',
            'aria-expanded': false
        } ).append( $( '<span />', {
            'class': 'screen-reader-text',
            text: nepalbuzzScreenReaderText.expand
        } ) );

        container.find( '.menu-item-has-children > a' ).after( dropdownToggle );

        // Toggle buttons and submenu items with active children menu items.
        container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
        container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

        // Add menu items with submenus to aria-haspopup="true".
        container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

        // For default page menu
        container.find( '.page_item_has_children > a' ).after( dropdownToggle );
        container.find( '.current_page_ancestor > button' ).addClass( 'toggled-on' );
        container.find( '.current_page_ancestor > .sub-menu' ).addClass( 'toggled-on' );
        container.find( '.page_item_has_children' ).attr( 'aria-haspopup', 'true' );


        container.find( '.dropdown-toggle' ).click( function( e ) {
            var _this            = $( this ),
                screenReaderSpan = _this.find( '.screen-reader-text' );

            e.preventDefault();
            _this.toggleClass( 'toggled-on' );
            _this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

            // jscs:disable
            _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
            screenReaderSpan.text( screenReaderSpan.text() === nepalbuzzScreenReaderText.expand ? nepalbuzzScreenReaderText.collapse : nepalbuzzScreenReaderText.expand );
        } );
    }

    //For Primary Menu
    menuTogglePrimary = $( '#menu-toggle-primary' ); // button id
    siteHeaderMenu    = $( '#site-header-menu' ); // wrapper id
    siteNavigation    = $( '#site-navigation' ); // nav id
    initMainNavigation( siteNavigation );

    // Enable menuTogglePrimary.
    ( function() {
        // Return early if menuTogglePrimary is missing.
        if ( ! menuTogglePrimary.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuTogglePrimary.add( siteNavigation ).attr( 'aria-expanded', 'false' );

        menuTogglePrimary.on( 'click', function() {
            $( this ).add( siteHeaderMenu ).toggleClass( 'toggled-on' );
            $('#header-top').toggleClass('fullheight');

            // jscs:disable
            $( this ).add( siteNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    ( function() {
        if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( window.innerWidth >= 910 ) {
                $( document.body ).on( 'touchstart', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                } );
                siteNavigation.find( '.menu-item-has-children > a' ).on( 'touchstart', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                } );
            } else {
                siteNavigation.find( '.menu-item-has-children > a' ).unbind( 'touchstart' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigation.find( 'a' ).on( 'focus blur', function() {
            $( this ).parents( '.menu-item' ).toggleClass( 'focus' );
        } );
    })();
    //Primary Menu End

    //For Secondary Menu
    menuToggleSecondary     = $( '#menu-toggle-secondary' ); // button id
    siteSecondaryMenu       = $( '#site-secondary-menu' ); // wrapper id
    siteNavigationSecondary = $( '#nav-secondary' ); // nav id
    initMainNavigation( siteNavigationSecondary );

    // Enable menuToggleSecondary.
    ( function() {
        // Return early if menuToggleSecondary is missing.
        if ( ! menuToggleSecondary.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggleSecondary.add( siteNavigationSecondary ).attr( 'aria-expanded', 'false' );

        menuToggleSecondary.on( 'click', function() {
            $( this ).add( siteSecondaryMenu ).toggleClass( 'toggled-on' );

            // jscs:disable
            $( this ).add( siteNavigationSecondary ).attr( 'aria-expanded', $( this ).add( siteNavigationSecondary ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    ( function() {
        if ( ! siteNavigationSecondary.length || ! siteNavigationSecondary.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( window.innerWidth >= 910 ) {
                $( document.body ).on( 'touchstart', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                } );
                siteNavigationSecondary.find( '.menu-item-has-children > a' ).on( 'touchstart', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                } );
            } else {
                siteNavigationSecondary.find( '.menu-item-has-children > a' ).unbind( 'touchstart' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigationSecondary.find( 'a' ).on( 'focus blur', function() {
            $( this ).parents( '.menu-item' ).toggleClass( 'focus' );
        } );
    })();
    //Secondary Menu End

    //For Header Top Menu
    menuToggleHeaderTop     = $( '#menu-toggle-header-top' ); // button id
    siteHeaderTopMenu       = $( '#site-header-top-menu' ); // wrapper id
    siteNavigationHeaderTop = $( '#nav-header-top' ); // nav id
    initMainNavigation( siteNavigationHeaderTop );

    // Enable menuToggleHeaderTop.
    ( function() {
        // Return early if menuToggleHeaderTop is missing.
        if ( ! menuToggleHeaderTop.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggleHeaderTop.add( siteNavigationHeaderTop ).attr( 'aria-expanded', 'false' );

        menuToggleHeaderTop.on( 'click', function() {
            $( this ).add( siteHeaderTopMenu ).toggleClass( 'toggled-on' );

            // jscs:disable
            $( this ).add( siteNavigationHeaderTop ).attr( 'aria-expanded', $( this ).add( siteNavigationHeaderTop ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    ( function() {
        if ( ! siteNavigationHeaderTop.length || ! siteNavigationHeaderTop.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( window.innerWidth >= 910 ) {
                $( document.body ).on( 'touchstart', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                } );
                siteNavigationHeaderTop.find( '.menu-item-has-children > a' ).on( 'touchstart', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                } );
            } else {
                siteNavigationHeaderTop.find( '.menu-item-has-children > a' ).unbind( 'touchstart' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigationHeaderTop.find( 'a' ).on( 'focus blur', function() {
            $( this ).parents( '.menu-item' ).toggleClass( 'focus' );
        } );
    })();
    //Header Top Menu End

    //For Header Right Menu
    menuToggleHeaderRight     = $( '#menu-toggle-header-right' ); // button id
    siteHeaderRightMenu       = $( '#site-header-right-menu' ); // wrapper id
    siteNavigationHeaderRight = $( '#nav-header-right' ); // nav id
    initMainNavigation( siteNavigationHeaderRight );

    // Enable menuToggleHeaderRight.
    ( function() {
        // Return early if menuToggleHeaderRight is missing.
        if ( ! menuToggleHeaderRight.length ) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggleHeaderRight.add( siteNavigationHeaderRight ).attr( 'aria-expanded', 'false' );

        menuToggleHeaderRight.on( 'click', function() {
            $( this ).add( siteHeaderRightMenu ).toggleClass( 'toggled-on' );

            // jscs:disable
            $( this ).add( siteNavigationHeaderRight ).attr( 'aria-expanded', $( this ).add( siteNavigationHeaderRight ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            // jscs:enable
        } );
    } )();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    ( function() {
        if ( ! siteNavigationHeaderRight.length || ! siteNavigationHeaderRight.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( window.innerWidth >= 910 ) {
                $( document.body ).on( 'touchstart', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                } );
                siteNavigationHeaderRight.find( '.menu-item-has-children > a' ).on( 'touchstart', function( e ) {
                    var el = $( this ).parent( 'li' );

                    if ( ! el.hasClass( 'focus' ) ) {
                        e.preventDefault();
                        el.toggleClass( 'focus' );
                        el.siblings( '.focus' ).removeClass( 'focus' );
                    }
                } );
            } else {
                siteNavigationHeaderRight.find( '.menu-item-has-children > a' ).unbind( 'touchstart' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigationHeaderRight.find( 'a' ).on( 'focus blur', function() {
            $( this ).parents( '.menu-item' ).toggleClass( 'focus' );
        } );
    })();
    //Header Right Menu End
});