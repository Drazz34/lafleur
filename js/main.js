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

// Attends que le contenu du document soit chargé avant d'exécuter le code
document.addEventListener('DOMContentLoaded', function () {
    // Sélectionne les éléments du formulaire pour les utiliser ultérieurement
    const quantiteInput = document.getElementById('quantite');
    const livraisonInput = document.getElementById('livraison');
    const prixTotalInput = document.getElementById('prix_total');
    const prixArticleInput = document.getElementById('prix_article');

    // Récupère le prix unitaire de l'article à partir du contenu du paragraphe dans la div '.card_article'
    const prixUnitaire = parseFloat(document.querySelector('.card_article p').textContent);

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

    // Ajoute un écouteur d'événement pour mettre à jour les champs lorsque la quantité d'articles change
    quantiteInput.addEventListener('input', updateLivraisonEtPrixTotal);
});