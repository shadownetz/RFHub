$(function () {
    $('.loader').fadeOut();

    // Toggle navigation option for mobile
    $('.nav-btn').click(function () {
        $('.overlay-responsive').fadeToggle('fast', function () {
            $('.navigation-responsive').removeClass("slideOutRight");
            $('.navigation-responsive').toggleClass("slideInRight").toggle();
        });
    });

    // Sticky Navigation
   window.onscroll = createSticky($(".navigation"));
    function createSticky(sticky) {
        if (typeof sticky !== "undefined") {
            var pos = sticky.offset().top + 20,
                win = $(window);
            win.on("scroll", function () {
                win.scrollTop() > pos ? sticky.addClass("sticky") : sticky.removeClass("sticky");
            });
        }
    }

    // smooth scroll to element on click
    $('.rf-feedback').click(function () {
        scroll_to_element('#contact');
    })
    $('.rf-about').click(function () {
        hide_responsive_nav('#about');
    })
    $('.rf-about-alt').click(function () {
        scroll_to_element('#about');
    })
    $('.rf-contact-us').click(function () {
        hide_responsive_nav('#contact');
    })


    function scroll_to_element(value) {
        $('html, body').animate({
            scrollTop: $(value).offset().top - 100
        }, 2000);
    }
    function hide_responsive_nav(element) {
        $('.navigation-responsive').removeClass("slideInRight");
        $('.navigation-responsive').addClass("slideOutRight").toggle(function () {
            $('.overlay-responsive').fadeToggle('fast', function () {
                 scroll_to_element(element);
            });
        });
    }

    // Change images according to accordion why-rf
    $('.js-rf-no-lock').click(function () {
        let name = 'easy-investing.png';
        change_accord_img(name);
    });
    $('.js-rf-lower').click(function () {
        let name = 'thumbnail-lowerFee.png';
        change_accord_img(name);
    });
    $('.js-rf-acc-min').click(function () {
        let name = 'thumbnail-minimum100.png';
        change_accord_img(name);
    });
    $('.js-rf-digital').click(function () {
        let name = 'thumbnail-digitalexperience.png';
        change_accord_img(name);
    });
    
    function change_accord_img(image_name) {
        let image = './images/' + image_name;
        $('.js-rf-why').attr('src',image);
    }

})
