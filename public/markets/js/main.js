(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($("#spinner").length > 0) {
                $("#spinner").removeClass("show");
            }
        }, 1);
    };
    spinner(0);

    // Fixed Navbar
    $(window).scroll(function () {
        if ($(window).width() < 992) {
            if ($(this).scrollTop() > 55) {
                $(".fixed-top").addClass("shadow");
            } else {
                $(".fixed-top").removeClass("shadow");
            }
        } else {
            if ($(this).scrollTop() > 55) {
                $(".fixed-top").addClass("shadow").css("top", -55);
            } else {
                $(".fixed-top").removeClass("shadow").css("top", 0);
            }
        }
    });

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow");
        }
    });
    $(".back-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
        return false;
    });

    // Testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-right"></i>',
            '<i class="bi bi-arrow-left"></i>',
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 1,
            },
            768: {
                items: 1,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 2,
            },
        },
    });

    // vegetable carousel
    $(".vegetable-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-right"></i>',
            '<i class="bi bi-arrow-left"></i>',
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
            1200: {
                items: 4,
            },
        },
    });

    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $(".btn-play").click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $("#videoModal").on("shown.bs.modal", function (e) {
            $("#video").attr(
                "src",
                $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0",
            );
        });

        $("#videoModal").on("hide.bs.modal", function (e) {
            $("#video").attr("src", $videoSrc);
        });
    });

    // Product Quantity
    document.addEventListener("DOMContentLoaded", function () {
        const quantityInput = document.getElementById("quantity-input");
        const totalPriceElement = document.getElementById("total-price");
        const pricePerUnit = parseFloat(totalPriceElement.dataset.pricePerUnit);

        function updateTotalPrice() {
            const quantity = parseInt(quantityInput.value, 10);
            const totalPrice = pricePerUnit * quantity;
            totalPriceElement.textContent = totalPrice.toLocaleString("id-ID");
        }

        $(".quantity button").on("click", function () {
            var button = $(this);
            var oldValue = button.parent().parent().find("input").val();
            var newVal;

            if (button.hasClass("btn-plus")) {
                newVal = parseInt(oldValue, 10) + 1;
            } else {
                if (parseInt(oldValue, 10) > 1) {
                    newVal = parseInt(oldValue, 10) - 1;
                } else {
                    newVal = 1; // Tetap 1 karena minimal jumlah adalah 1
                }
            }

            button.parent().parent().find("input").val(newVal);
            updateTotalPrice(); // Panggil fungsi untuk memperbarui total harga
        });

        quantityInput.addEventListener("input", function () {
            updateTotalPrice();
        });
    });

    $("#nav-tab a").on("click", function (e) {
        e.preventDefault();
        $(this).tab("show");
    });
})(jQuery);
