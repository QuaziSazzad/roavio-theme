/*-----------------------------------------------------------------------------------

    Note: This is Main JS File.
-----------------------------------------------------------------------------------
    JS INDEX
    ===================
    ## Header Style
    ## Dropdown menu
    ## Submenu
    ## Preloader
    
-----------------------------------------------------------------------------------*/
(function ($) {

    "use strict";
    const $documentOn = $(document);
    const $windowOn = $(window);

    $(document).ready(function () {



      //>> Mobile Menu Js Start <<//
      $('#mobile-menu').meanmenu({
        meanMenuContainer: '.mobile-menu',
        meanScreenWidth: "1199",
        meanExpand: ['<i class="far fa-plus"></i>'],
    });



        //>> Sidebar Toggle Js Start <<//
            $(".offcanvas__close,.offcanvas__overlay").on("click", function() {
                $(".offcanvas__info").removeClass("info-open");
                $(".offcanvas__overlay").removeClass("overlay-open");
            });
            $(".sidebar__toggle").on("click", function() {
                $(".offcanvas__info").addClass("info-open");
                $(".offcanvas__overlay").addClass("overlay-open");
            });

        //>> Body Overlay Js Start <<//
        $(".body-overlay").on("click", function() {
                $(".offcanvas__area").removeClass("offcanvas-opened");
                $(".df-search-area").removeClass("opened");;
                $(".body-overlay").removeClass("opened");
            });


            
        /* ================================
        Back To Top Button Js Start
        ================================ */

        // Function to toggle back-to-top button visibility
        function toggleBackTop() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                $("#back-top").addClass("show");
            } else {
                $("#back-top").removeClass("show");
            }
        }

        // On scroll
        $windowOn.on('scroll', function() {
            toggleBackTop();
        });

        // On document ready, force hide the button
        $(document).ready(function() {
            $("#back-top").removeClass("show");
        });

        // On click
        $documentOn.on('click', '#back-top', function() {
            $('html, body').animate({ scrollTop: 0 }, 800);
            return false;
        });


        //>> Sticky Header Js Start <<//

        $windowOn.on("scroll", function () {
            if ($(this).scrollTop() > 250) {
            $("#header-sticky").addClass("sticky-header");
            } else {
            $("#header-sticky").removeClass("sticky-header");
            }
        }); 

         //>> MouseCursor Start <<//
    if ($(".mouseCursor").length > 0) {
        function itCursor() {
            var myCursor = jQuery(".mouseCursor");
            if (myCursor.length) {
                if ($("body")) {
                    const e = document.querySelector(".cursor-inner"),
                        t = document.querySelector(".cursor-outer");
                    let n,
                        i = 0,
                        o = !1;
                    (window.onmousemove = function(s) {
                        o ||
                            (t.style.transform =
                                "translate(" + s.clientX + "px, " + s.clientY + "px)"),
                            (e.style.transform =
                                "translate(" + s.clientX + "px, " + s.clientY + "px)"),
                            (n = s.clientY),
                            (i = s.clientX);
                    }),
                    $("body").on(
                            "mouseenter",
                            "button, a, .cursor-pointer",
                            function() {
                                e.classList.add("cursor-hover"),
                                    t.classList.add("cursor-hover");
                            }
                        ),
                        $("body").on(
                            "mouseleave",
                            "button, a, .cursor-pointer",
                            function() {
                                ($(this).is("a", "button") &&
                                    $(this).closest(".cursor-pointer").length) ||
                                (e.classList.remove("cursor-hover"),
                                    t.classList.remove("cursor-hover"));
                            }
                        ),
                        (e.style.visibility = "visible"),
                        (t.style.visibility = "visible");
                }
            }
        }
        itCursor();
    }


    });


    /* ==========================================================================
       When document is loaded, do
    ========================================================================== */

    $(window).on('load', function () {

        // ## Preloader
        function handlePreloader() {
            if ($('.preloader').length) {
                $('.preloader').delay(200).fadeOut(500);
            }
        }
        handlePreloader();

    });

})(jQuery);
