// Menu responsive hamburger
const hamburgerBtn = document.querySelector(".nav-toggler");

const navigation = document.querySelector("nav");

hamburgerBtn.addEventListener("click", toggleNav)

function toggleNav() {
    hamburgerBtn.classList.toggle("active");
    navigation.classList.toggle("active");
}

// Popup photo article
$(document).ready(function () {

    $('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });
});