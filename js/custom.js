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
            $('#back-to-top').addClass('ht-show');
        } else {
            $('#back-to-top').removeClass('ht-show');
        }
    });

    $('#back-to-top').click(function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 800);
    });

    /*---------Popup Search---------*/
    $('.ht-search-button a').click(function () {
        $('.ht-search-wrapper').addClass('ht-search-triggered');
        setTimeout(function () {
            viralMagSearchModalFocus($('.ht-search-wrapper'));
        }, 1000);
        return false;
    });

    $('.ht-search-close').click(function () {
        $('.ht-search-wrapper').removeClass('ht-search-triggered');
        $('.ht-search-button a').focus();
    });

    /*---------OffCanvas Sidebar---------*/
    $('.ht-offcanvas-nav a').click(function () {
        $('body').addClass('ht-offcanvas-opened');
        setTimeout(function () {
            viralMagOffcanvasFocus($('.ht-offcanvas-sidebar'));
        }, 1000);
    });

    $('.ht-offcanvas-close, .ht-offcanvas-sidebar-modal').click(function () {
        $('body').removeClass('ht-offcanvas-opened');
        $('.ht-offcanvas-nav a').focus();
    });

    $('.ht-offcanvas-sidebar .widget_nav_menu .menu-item-has-children > a').append('<span class="ht-dropdown"></span>');

    $(document).keydown(function (e) {
        // ESCAPE key pressed
        if (e.keyCode == 27 && $('body').hasClass('ht-offcanvas-opened')) {
            $('body').removeClass('ht-offcanvas-opened');
        }
    });

    $('.ht-dropdown').on('click', function () {
        $(this).parent('a').next('ul').slideToggle();
        $(this).toggleClass('ht-opened');
        return false;
    })

    /*---------Header Time---------*/
    startTime();

    /*---------Main Menu Dropdown---------*/
    $('.ht-menu > ul').superfish({
        delay: 500,
        animation: {
            opacity: 'show'
        },
        speed: 'fast'
    });

    $('#ht-mobile-menu .menu-collapser').on('click', function () {
        $(this).next('ul').slideToggle();
        viralMagMenuFocus($('#ht-mobile-menu'));
    });

    $('#ht-responsive-menu .menu-item-has-children > a').append('<button class="dropdown-nav ei arrow_carrot-down"></button>');

    $('#ht-responsive-menu .dropdown-nav').on('click', function () {
        $el = $(this);
        if (!$el.hasClass('ht-opened')) {
            $el.closest('a').next('ul').slideDown();
            $el.addClass('ht-opened');
        } else {
            $el.closest('a').next('ul').slideUp();
            $el.removeClass('ht-opened');
        }

        $el.off('keydown');
        setTimeout(function () {
            viralMagKeyboardLoop($('#ht-mobile-menu'));
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

    var $stickyHeader = $('.ht-header');

    if ($('.ht-sticky-header').length > 0 && $stickyHeader.length > 0) {
        hHeight = $stickyHeader.outerHeight();

        if ($('body').hasClass('ht-header-style4')) {
            hHeight = hHeight + 38
        }
        var hOffset = $stickyHeader.offset().top;

        var offset = hOffset - adminbarHeight;

        $stickyHeader.headroom({
            offset: offset,
            onTop: function () {
                $('#ht-content').css({
                    paddingTop: 0
                });
            },
            onNotTop: function () {
                $('#ht-content').css({
                    paddingTop: hHeight + 'px'
                });
            }
        });

        $('.ht-sticky-sidebar .secondary-wrap').css('top', (hHeight + adminbarHeight + 40) + 'px');
    }


    /*---------Widgets---------*/
    $('.ht-post-tab').each(function (index) {
        $(this).find('.ht-pt-header .ht-pt-tab:first').addClass('ht-pt-active');
        $(this).find('.ht-pt-content-wrap .ht-pt-content:first').show();
    });

    $('.ht-pt-tab').on('click', function () {
        var id = $(this).data('id');
        $(this).closest('.ht-post-tab').find('.ht-pt-tab').removeClass('ht-pt-active');
        $(this).addClass('ht-pt-active');

        $(this).closest('.ht-post-tab').find('.ht-pt-content').hide();
        $('#' + id).show();
    });

    if ($('.ht-post-carousel').length > 0) {
        $('.ht-post-carousel').owlCarousel({
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
    var $stickyHeader = $('.ht-header');

    if ($('.ht-sticky-header').length > 0 && $stickyHeader.length > 0) {
        hHeight = $stickyHeader.outerHeight();
    }

    /*---------Sticky Sidebar---------*/
    $('.ht-sticky-sidebar #secondary').theiaStickySidebar({
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
        $('.vl-time').html(h + ":" + m + ":" + s);
        t = setTimeout(function () {
            startTime()
        }, 500);
    }

    var viralMagMenuFocus = function (elem) {
        viralMagKeyboardLoop(elem);

        elem.on('keyup', function (e) {
            if (e.keyCode === 27) {
                $('#ht-responsive-menu').hide();
                $('.menu-collapser').focus();
            }
        });
    };

    var viralMagSearchModalFocus = function (elem) {
        viralMagKeyboardLoop(elem);

        elem.on('keydown', function (e) {
            if (e.keyCode == 27 && elem.hasClass('ht-search-triggered')) {
                elem.removeClass('ht-search-triggered');
                $('.ht-search-button a').focus();
            }
        });
    };

    var viralMagOffcanvasFocus = function (elem) {
        viralMagKeyboardLoop(elem);

        elem.on('keydown', function (e) {
            if (e.keyCode == 27 && $('body').hasClass('ht-offcanvas-opened')) {
                $('body').removeClass('ht-offcanvas-opened');
                $('.ht-offcanvas-nav a').focus();
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