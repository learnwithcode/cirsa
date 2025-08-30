$(document).ready(function () {
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
        // Set the initial value of the counter to 0
        counter.innerText = '0';

        // Function to update 
        const updateCounter = () => {
            // Get the target value from the 'data-target' attribute of the counter element
            const target = +counter.getAttribute('data-target');

            // Get the current value of the counter
            const current = +counter.innerText;

            // Calculate the increment value
            const increment = target / 100;

            // Check if the current value is less than the target value
            if (current < target) {
                // Increment the counter value and update the display
                counter.innerText = `${Math.ceil(current + increment)}`;
                // Call the updateCounter function again after a short delay (1 millisecond)
                setTimeout(updateCounter, 1);
            } else {
                // If the current value is greater than or equal to the target value, set the counter to the target value
                counter.innerText = target;
            }
        }

        // Call the updateCounter function to start the counter animation
        updateCounter();
    });
});

$(".dashboard-main .right-content .right-main>.heading-main>.right-content>div>ul li").click(function () {
        $(".dashboard-main .right-content .right-main>.heading-main>.right-content>div>ul li").removeClass('active');
        $(this).addClass('active');
    });

    $("button .fa-times").click(function(){
        $(".dashboard-main .right-content .right-main>.heading-main>.right-content>div>ul li").removeClass("active");
    });
$(document).ready(function () {
    // Delete that line if you don't want the first Div to be displayed by default
    // $(".drop-down-main>ul > li > .drop-down:first").css("display", "block");

    // 
    $(".site-bar-content > .menu-link > ul > li > a").click(function () {
        $(this).next().slideToggle(500);
        $(this).parent().toggleClass("active");
        $(".site-bar-content > .menu-link > ul > li > .drop-down").not($(this).next()).slideUp(500);

    });

});



$(document).ready(function () {
    $(window).scroll(function () {
        if ($(document).scrollTop() > 50) {
            $("#header-main").addClass("header-fixed");
        } else {
            $("#header-main").removeClass("header-fixed");
        };
    });

    $(window).scroll(function () {
        if ($(document).scrollTop() > 100) {
            $(".footer-bottom-main").addClass("footer-fixed");

        };
    });



    $(".left-content .menu-bar .fa-bars").click(function () {
        $(".dashboard-main").toggleClass('show-bar');
    });

    // $(".site-bar-content > .menu-link > ul > li").click(function () {
    //     $(".site-bar-content > .menu-link > ul > li").removeClass('active');
    //     $(this).addClass('active');
    // });




    $(".header-content .right-content ul > li.active-profile").click(function () {
        $(".profile-main").toggleClass('active');
    });

    $(".header-content .right-content ul li.active-profile").click(function () {
        $(".overlayer-main").toggleClass('active');
    });

    $(".profile-main > ul.menu-list > li").click(function () {
        $(".profile-main > ul.menu-list > li").removeClass('active');
        $(this).addClass('active');
    });

    $(".overlayer-main").click(function () {
        $(".profile-main,.overlayer-main").removeClass('active');
    });

    $(".header-content .right-content ul li.search-bar").click(function () {
        $(".header-content .left-content .search-bar").toggleClass('active');
    });

    $(".header-content .left-content .search-bar .fa-times").click(function () {
        $(".header-content .left-content .search-bar").removeClass('active');
    });

    $(".header-content .left-content .search-bar .fa-times").click(function () {
        $(".overlayer").removeClass('active');
    });

    $(".logout-btn").click(function () {
        $(".overlay,.logout-main,.overlayer-main").toggleClass('active');
        $(".overlayer-main").addClass('active');
    });

    $(".dashboard-main .site-bar .heading-main > div > .sidebar-pro-img").click(function () {
        $(".dashboard-main .site-bar .heading-main > .sitebar-profile").slideToggle();
    });

    $(".cancle-btn").click(function () {
        $(".overlayer-main,.logout-main,.profile-main").removeClass('active');
    });

    $(".dashboard-main .right-content .right-main .planpoup > div .fa-times").click(function () {
        $(".dashboard-main .right-content .right-main .planpoup").hide();
    });

    $('.work-slider-main').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,

        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true
                }
            },

            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 439,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.card-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
    });

    $('.plan-slider').slick({
        dots: false,
        infinite: true,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });

});

$('#tabs-nav li:first-child').addClass('active');
$('.tab-content').hide();
$('.tab-content:first').show();

$('#tabs-nav li').click(function () {
    $('#tabs-nav li').removeClass('active');
    $(this).addClass('active');
    $('.tab-content').hide();

    var activeTab = $(this).find('a').attr('href');
    $(activeTab).fadeIn();
    return false;
});


$(document).ready(function () {
    $("#div1").load("demo_test.txt", function (responseTxt, statusTxt, xhr) {
        if (statusTxt == "success")
            alert("External content loaded successfully!");
        if (statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
});

$(document).ready(function () {
    $(".signin-content .left-content .singIn-main").click(function () {
        $(".singup-poup-main,.overlayer-signInUp").addClass("active");
    });
    $("#signin-main .singup-poup-main > div:last-child .btn-main").click(function () {
        $(".singup-poup-main,.overlayer-signInUp").removeClass("active");
    });
});


// window.onload = function () {
//     document.getElementById('button').onclick = function () {
//         document.getElementById('main-poup').style.display = 'none'
//     };
// };

