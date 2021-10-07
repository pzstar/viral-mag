/**
 * Viral Mag Custom JS
 *
 * @package Viral Mag
 *
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 */

jQuery(function ($) {
    /*---------scroll To Top---------*/
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            $('#back-to-top').addClass('vm-show');
        } else {
            $('#back-to-top').removeClass('vm-show');
        }
    });

    $('#back-to-top').click(function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 800);
    });

    /*---------Popup Search---------*/
    $('.vm-search-button a').click(function () {
        $('.vm-search-wrapper').addClass('vm-search-triggered');
        setTimeout(function () {
            viralMagSearchModalFocus($('.vm-search-wrapper'));
        }, 1000);
        return false;
    });

    $('.vm-search-close').click(function () {
        $('.vm-search-wrapper').removeClass('vm-search-triggered');
        $('.vm-search-button a').focus();
    });

    /*---------OffCanvas Sidebar---------*/
    $('.vm-offcanvas-nav a').click(function () {
        $('body').addClass('vm-offcanvas-opened');
        setTimeout(function () {
            viralMagOffcanvasFocus($('.vm-offcanvas-sidebar'));
        }, 1000);
    });

    $('.vm-offcanvas-close, .vm-offcanvas-sidebar-modal').click(function () {
        $('body').removeClass('vm-offcanvas-opened');
        $('.vm-offcanvas-nav a').focus();
    });

    $('.vm-offcanvas-sidebar .widget_nav_menu .menu-item-has-children > a').append('<span class="vm-dropdown"></span>');

    $(document).keydown(function (e) {
        // ESCAPE key pressed
        if (e.keyCode == 27 && $('body').hasClass('vm-offcanvas-opened')) {
            $('body').removeClass('vm-offcanvas-opened');
        }
    });

    $('.vm-dropdown').on('click', function () {
        $(this).parent('a').next('ul').slideToggle();
        $(this).toggleClass('vm-opened');
        return false;
    })

    /*---------Header Time---------*/
    startTime();

    /*---------Main Menu Dropdown---------*/
    $('.vm-menu > ul').superfish({
        delay: 500,
        animation: {
            opacity: 'show'
        },
        speed: 'fast'
    });

    $(' #vm-mobile-menu .menu-collapser').on('click', function () {
        $(this).next('ul').slideToggle();
        viralMagMenuFocus($(' #vm-mobile-menu'));
    });

    $(' #vm-responsive-menu .menu-item-has-children > a').append('<button class="dropdown-nav ei arrow_carrot-down"></button>');

    $(' #vm-responsive-menu .dropdown-nav').on('click', function () {
        $el = $(this);
        if (!$el.hasClass('vm-opened')) {
            $el.closest('a').next('ul').slideDown();
            $el.addClass('vm-opened');
        } else {
            $el.closest('a').next('ul').slideUp();
            $el.removeClass('vm-opened');
        }

        $el.off('keydown');
        setTimeout(function () {
            viralMagKeyboardLoop($(' #vm-mobile-menu'));
            $el.focus();
        }, 500);

        return false;
    })

    /*---------Sticky Header---------*/
    var hHeight = 0;
    var adminbarHeight = 0;

    if ($('body').hasClass('admin-bar')) {
        adminbarHeight = 32;
    }

    var $stickyHeader = $('.vm-header');

    if ($('.vm-sticky-header').length > 0 && $stickyHeader.length > 0) {
        hHeight = $stickyHeader.outerHeight();

        if ($('body').hasClass('vm-header-style4')) {
            hHeight = hHeight + 38
        }
        var hOffset = $stickyHeader.offset().top;

        var offset = hOffset - adminbarHeight;

        $stickyHeader.headroom({
            offset: offset,
            onTop: function () {
                $(' #vm-content').css({
                    paddingTop: 0
                });
            },
            onNotTop: function () {
                $(' #vm-content').css({
                    paddingTop: hHeight + 'px'
                });
            }
        });

        $('.vm-sticky-sidebar .secondary-wrap').css('top', (hHeight + adminbarHeight + 40) + 'px');
    }


    /*---------Widgets---------*/
    $('.vm-post-tab').each(function (index) {
        $(this).find('.vm-pt-header .vm-pt-tab:first').addClass('vm-pt-active');
        $(this).find('.vm-pt-content-wrap .vm-pt-content:first').show();
    });

    $('.vm-pt-tab').on('click', function () {
        var id = $(this).data('id');
        $(this).closest('.vm-post-tab').find('.vm-pt-tab').removeClass('vm-pt-active');
        $(this).addClass('vm-pt-active');

        $(this).closest('.vm-post-tab').find('.vm-pt-content').hide();
        $('#' + id).show();
    });

    if ($('.vm-post-carousel').length > 0) {
        $('.vm-post-carousel').owlCarousel({
            rtl: JSON.parse(viral_mag_options.rtl),
            items: 1,
            loop: true,
            mouseDrag: false,
            nav: false,
            dots: true,
            autoplayTimeout: 6000,
            autoplay: true,
            smartSpeed: 600,
            margin: 5
        });
    }


    var hHeight = 0;
    var adminbarHeight = 0;

    if ($('body').hasClass('admin-bar')) {
        adminbarHeight = 32;
    }
    var $stickyHeader = $('.vm-header');

    if ($('.vm-sticky-header').length > 0 && $stickyHeader.length > 0) {
        hHeight = $stickyHeader.outerHeight();
    }

    /*---------Sticky Sidebar---------*/
    $('.vm-sticky-sidebar #secondary').theiaStickySidebar({
        additionalMarginTop: hHeight + adminbarHeight + 40,
        additionalMarginBottom: 40
    });


    function checkTime(i) {
        return (i < 10) ? "0" + i : i;
    }

    function startTime() {
        var today = new Date(),
                h = checkTime(today.getHours()),
                m = checkTime(today.getMinutes()),
                s = checkTime(today.getSeconds());
        $('.vm-time').html(h + ":" + m + ":" + s);
        t = setTimeout(function () {
            startTime()
        }, 500);
    }

    var viralMagMenuFocus = function (elem) {
        viralMagKeyboardLoop(elem);

        elem.on('keyup', function (e) {
            if (e.keyCode === 27) {
                $(' #vm-responsive-menu').hide();
                $('.menu-collapser').focus();
            }
        });
    };

    var viralMagSearchModalFocus = function (elem) {
        viralMagKeyboardLoop(elem);

        elem.on('keydown', function (e) {
            if (e.keyCode == 27 && elem.hasClass('vm-search-triggered')) {
                elem.removeClass('vm-search-triggered');
                $('.vm-search-button a').focus();
            }
        });
    };

    var viralMagOffcanvasFocus = function (elem) {
        viralMagKeyboardLoop(elem);

        elem.on('keydown', function (e) {
            if (e.keyCode == 27 && $('body').hasClass('vm-offcanvas-opened')) {
                $('body').removeClass('vm-offcanvas-opened');
                $('.vm-offcanvas-nav a').focus();
            }
        });
    };

    var viralMagKeyboardLoop = function (elem) {
        var tabbable = elem.find('select, input, textarea, button, a').filter(':visible');

        var firstTabbable = tabbable.first();
        var lastTabbable = tabbable.last();

        /*set focus on first input*/
        firstTabbable.focus();

        /*redirect last tab to first input*/
        lastTabbable.on('keydown', function (e) {
            if ((e.which === 9 && !e.shiftKey)) {
                e.preventDefault();
                firstTabbable.focus();
            }
        });

        /*redirect first shift+tab to last input*/
        firstTabbable.on('keydown', function (e) {
            if ((e.which === 9 && e.shiftKey)) {
                e.preventDefault();
                lastTabbable.focus();
            }
        });
    }
});