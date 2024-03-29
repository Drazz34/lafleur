// Menu responsive hamburger
const hamburgerBtn = document.querySelector(".nav-toggler");

const navigation = document.querySelector("nav");

hamburgerBtn.addEventListener("click", toggleNav)

// change l'apparence du bouton et affiche / cache la navigation
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

// AOS Animate
AOS.init();

// Sélectionne les villes livrables suivant le code postal choisi
function updateVilleSelect() {
    let cpSelect = document.getElementById('livraison_cp');
    let villeSelect = document.getElementById('livraison_ville');
    let selectedCp = cpSelect.value;

    villeSelect.innerHTML = '<option value="">-- Ville --</option>';

    if (selectedCp === '') {
        return;
    }

    let villesCp1 = JSON.parse(cpSelect.getAttribute('data-villes-cp1'));
    let villesCp2 = JSON.parse(cpSelect.getAttribute('data-villes-cp2'));
    let codesPostaux = JSON.parse(cpSelect.getAttribute('data-codes-postaux'));

    let cpIndex = codesPostaux.indexOf(selectedCp);
    let villes = [];

    if (cpIndex === 0) {
        villes = villesCp1;
    } else if (cpIndex === 1) {
        villes = villesCp2;
    }

    for (let i = 0; i < villes.length; i++) {
        villeSelect.innerHTML += '<option value="' + villes[i] + '">' + villes[i] + '</option>';
    }
}

// Récupère les paramètres de la chaîne de requête de l'URL
const params = new URLSearchParams(window.location.search);

// Vérifie si la valeur de l'argument "page" est égale à "commande"
if (params.get('page') === 'commande') {

    // Attends que le contenu du document soit chargé avant d'exécuter le code
    document.addEventListener('DOMContentLoaded', function () {
        // Sélectionne les éléments du formulaire pour les utiliser ultérieurement
        const quantiteInput = document.getElementById('quantite_visible');
        const livraisonInput = document.getElementById('livraison');
        const prixTotalInput = document.getElementById('prix_total');
        const prixArticleInput = document.getElementById('prix_article');

        // Récupère le prix unitaire de l'article à partir du contenu du paragraphe dans la div '.card_article'
        const prixUnitaire = parseFloat(document.querySelector('.card_article .article_prix_unitaire').textContent);

        // Récupère les frais de livraison à partir des éléments cachés et les stocke dans un objet
        const fraisLivraison = {
            gratuit: parseFloat(document.getElementById('frais_gratuit').value),
            payant: parseFloat(document.getElementById('frais_payant').value)
        };

        // Fonction pour mettre à jour les champs de livraison et de prix total
        function updateLivraisonEtPrixTotal() {
            // Récupère la quantité d'articles sélectionnée
            const quantite = parseInt(quantiteInput.value);

            // Calcule le prix total des articles en multipliant la quantité par le prix unitaire
            const prixArticle = quantite * prixUnitaire;

            prixArticleInput.value = prixArticle.toFixed(2);

            // Met à jour les frais de livraison en fonction du prix total des articles

            if (prixArticle >= 50) {
                livraisonInput.value = fraisLivraison.gratuit;

            } else {
                livraisonInput.value = fraisLivraison.payant;

            }

            // Calcule le prix total en ajoutant le prix total des articles aux frais de livraison
            const prixTotal = prixArticle + parseFloat(livraisonInput.value);

            // Met à jour le champ du prix total avec le nouveau prix total
            prixTotalInput.value = prixTotal.toFixed(2);
        }

        // Appelle la fonction pour mettre à jour les champs de livraison et de prix total une première fois
        updateLivraisonEtPrixTotal();

        // Appelle la fonction pour initialiser le champ frais_livraison_id une première fois
        updateFraisLivraisonId();

        // Ajoute un écouteur d'événement pour mettre à jour les champs lorsque la quantité d'articles change
        quantiteInput.addEventListener('input', updateLivraisonEtPrixTotal);
    });
}

// Met à jour l'affichage des frais de livraison
function updateFraisLivraisonId() {
    const prix = parseFloat(document.getElementById('prix_article').value);
    const fraisLivraisonIdField = document.getElementById('frais_livraison_id');

    if (prix >= 50) {
        fraisLivraisonIdField.value = 1; // Livraison gratuite (ID 1)
    } else {
        fraisLivraisonIdField.value = 2; // Livraison payante (ID 2)
    }
}

// Met à jour la quantité d'articles selectionnée et les frais de livraison
function updateQuantite() {
    var quantite_visible = document.getElementById('quantite_visible');
    var quantite = document.getElementById('quantite');
    quantite.value = quantite_visible.value;
    updateFraisLivraisonId();
}

var quantite_visible = document.getElementById('quantite_visible');
if (quantite_visible) {
    quantite_visible.addEventListener('input', updateQuantite);
}

// Validation de l'email à l'inscription
function validateEmail() {
    const emailInput = document.getElementById("creation_email");
    const emailError = document.getElementById("email_error");
    const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w]{2,4}$/;

    if (emailRegex.test(emailInput.value)) {
        emailError.style.display = "none";
        return true;
    } else {
        emailError.style.display = "block";
        scrollToEmailInput();
        return false;
    }
}

// Validation du mot de passe à l'inscription
function validatePassword() {
    const passwordInput = document.getElementById("creation_password");
    const passwordError = document.getElementById("password_error");
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (passwordInput.value.length >= 8 && passwordRegex.test(passwordInput.value)) {
        passwordError.style.display = "none";
        return true;
    } else {
        passwordError.style.display = "block";
        scrollToPasswordInput();
        return false;
    }
}

// Vérifie si les champs email et mot de passe sont correctement remplis et empêche la soumission si incorrects
function validateForm(event) {
    let validEmail = validateEmail();
    let validPassword = validatePassword();

    if (!validEmail || !validPassword) {
        event.preventDefault();
    }
}

function validateNewPassword() {
    const passwordNewInput = document.getElementById("modif_password");
    const passwordNewError = document.querySelector(".password_error");
    const passwordNewRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (passwordNewInput.value.length >= 8 && passwordNewRegex.test(passwordNewInput.value)) {
        passwordNewError.style.display = "none";
        return true;
    } else {
        passwordNewError.style.display = "block";
        return false;
    }
}

function validateNewForm(event) {
    let validNewPassword = validateNewPassword();

    if (!validNewPassword) {
        event.preventDefault();
    }
}

// remonter au champ mot de passe
function scrollToPasswordInput() {
    const passwordInput = document.getElementById("creation_password");
    passwordInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// remonter au champ email
function scrollToEmailInput() {
    const emailInput = document.getElementById("creation_email");
    emailInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
}



// Ajouter une validation côté client pour les champs de saisie d'e-mail et de mot de passe et empêcher la soumission du formulaire si l'une des validations échoue.
window.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("creation_form");
    const emailInput = document.getElementById("creation_email");
    const passwordInput = document.getElementById("creation_password");
    const passwordNewInput = document.getElementById("modif_password");

    if (form) {
        form.addEventListener("submit", validateForm);
    }

    if (emailInput) {
        emailInput.addEventListener("blur", validateEmail);
    }

    if (passwordInput) {
        passwordInput.addEventListener("blur", validatePassword);
    }

    if (passwordNewInput) {
        passwordNewInput.addEventListener("blur", validateNewPassword);
    }
});