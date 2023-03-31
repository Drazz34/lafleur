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
        mainClass: 'mfp-no-margins mfp-with-zoom',
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300
        }
    });
});


$(document).ready(function() {
  $('#livraison_cp').on('change', function() {
    var cp = $(this).val();
    if (cp) {
      $.ajax({
        url: 'get_villes.php',
        method: 'POST',
        data: { cp: cp },
        success: function(data) {
          $('#livraison_ville').html(data);
        }
      });
    } else {
      $('#livraison_ville').html('<option value="">-- Ville --</option>');
    }
  });
});
