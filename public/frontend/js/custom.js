 var testimonialslider = new Swiper(".testimonial-slider", {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.testimonial-slider-next',
            prevEl: '.testimonial-slider-prev',
        },
        breakpoints: {
            // when window width is >= 640px
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            // when window width is >= 768px
            992: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        }
    });
    var typeOfSpa = new Swiper(".type-of-spa", {
      slidesPerView: 1,
      spaceBetween: 24,
      loop: true,
      // autoplay: {
      //     delay: 2000,
      //     disableOnInteraction: false
      // },
      pagination: {
          el: '.swiper-pagination',
          clickable: true,
      },
      navigation: {
          nextEl: '.type-of-spa-slider-next',
          prevEl: '.type-of-spa-slider-prev',
      },
      breakpoints: {
          // when window width is >= 640px
          768: {
              slidesPerView: 2,
              spaceBetween: 20,
          },
          // when window width is >= 768px
          992: {
              slidesPerView: 3,
              spaceBetween: 30,
          },
      }
  });

var swiperHome = new Swiper(".swiper-home", {
  // direction: "vertical",
  // autoHeight: true, 
  spaceBetween: 24,
  slidesPerView: "auto",
  centeredSlides: true,
  effect: "cards",
      // grabCursor: true,
});

$(function () {
  //Scroll event
  $(window).on("scroll", function () {
    var scrolled = $(window).scrollTop();
    if (scrolled > 300) $(".go-top").fadeIn("slow");
    if (scrolled < 300) $(".go-top").fadeOut("slow");
  });
  //Click event
  $(".go-top").on("click", function () {
    $("html, body").animate({ scrollTop: "0" }, 500);
  });
});


// number count/
$(".counter-count").each(function () {
  $(this)
    .prop("Counter", 0)
    .animate(
      {
        Counter: $(this).text(),
      },
      {
        duration: 5000,
        easing: "swing",
        step: function (now) {
          $(this).text(Math.ceil(now));
        },
      }
    );
});


$(".dropdown-toggle-icon .down-arrow").click(function (e) {
    if ($(e.target.parentElement).hasClass("active-down-arrow")) {
        $(e.target.parentElement).removeClass("active-down-arrow");
    } else {
        $(e.target.parentElement).addClass("active-down-arrow");
    }

    if ($(this).hasClass("down-arrow-add")) {
        $(this)
            .removeClass("down-arrow-add")
            .parent(".dropdown-toggle-icon")
            .next()
            .removeClass("show");
    } else {
        $(this)
            .addClass("down-arrow-add")
            .parent(".dropdown-toggle-icon")
            .next()
            .addClass("show");
    }
});