<section class="ma_commande">

    <div class="ma_commande_titre">

        <h1 class="h1">Ma commande</h1>

        <div class="frais">

            <img src="img/livraison.svg" alt="Un camion de livraison">

            <p>Livraison offerte dès 50€ d'achat</p>

        </div>

    </div>

    <div class="ma_commande_contenu">

        <div class="contenu_produit">

            <div class="card_article">

                <a href="./img/<?= $article['photo'] ?>" class="image-popup-no-margins"><img src="./img/<?= $article['photo'] ?>" alt="<?= $article['alt'] ?>"></a>

                <h3 class="h3"><?= $article['nom'] ?></h3>

                <p class="article_prix_unitaire"><?= $article['prix_unitaire'] ?> €</p>

            </div>

            <a href="index.php?page=boutique">Supprimer</a>

        </div>

        <div class="contenu_info">

            <div class="info_input">

                <div>
                    <label for="quantite_visible">Quantité</label>
                    <input type="number" name="quantite" id="quantite_visible" value="1" min="1" oninput="updateQuantite()">
                </div>

                <div>
                    <label for="prix_article">Prix</label>
                    <input type="text" name="prix_article" id="prix_article" readonly>
                </div>


                <div>
                    <label for="livraison">Livraison</label>
                    <input type="text" name="livraison" id="livraison" readonly>
                </div>

                <div>
                    <label for="prix_total">Prix total</label>
                    <input type="text" name="prix_total" id="prix_total" readonly>
                </div>

            </div>

        </div>

    </div>

</section>

<section class="livraison formulaire">

    <p>Adresse de livraison</p>

    <form action="" method="post">

        <input type="hidden" name="quantite" id="quantite" value="1" min="1" oninput="updateQuantite()">
        <input type="hidden" name="livraison" id="livraison">
        <input type="hidden" name="prix_total" id="prix_total">
        <!-- Élément caché pour stocker le frais_livraison_id -->
        <input type="hidden" name="frais_livraison_id" id="frais_livraison_id">

        <input type="hidden" id="frais_gratuit" value="<?= $frais_livraison[0] ?>">
        <input type="hidden" id="frais_payant" value="<?= $frais_livraison[1] ?>">

        <input type="hidden" name="gain_loterie_id" id="gain_loterie_id">

        <label for="livraison_nom"></label>

        <input type="text" name="livraison_nom" id="livraison_nom" class="input_form" value="<?= $client['nom'] ?>" required>

        <label for="livraison_prenom"></label>

        <input type="text" name="livraison_prenom" id="livraison_prenom" class="input_form" value="<?= $client['prenom'] ?>" required>

        <label for="livraison_rue"></label>

        <input type="text" name="livraison_rue" id="livraison_rue" class="input_form" value="<?= $adresse['rue'] ?>" required>

        <label for="livraison_cp"></label>

        <select name="livraison_cp" id="livraison_cp" class="input_form" onchange="updateVilleSelect()" data-villes-cp1='<?php echo json_encode($villesCp1); ?>' data-villes-cp2='<?php echo json_encode($villesCp2); ?>' data-codes-postaux='<?php echo json_encode($codesPostaux); ?>' required>
            <option value="">-- Code postal --</option>

            <?php foreach ($codesPostaux as $cp) : ?>
                <option value="<?= $cp ?>"><?= $cp ?></option>
            <?php endforeach ?>

        </select>

        <label for="livraison_ville"></label>

        <select name="livraison_ville" id="livraison_ville" class="input_form" required>
            <option value="">-- Ville --</option>
            <!-- Affichage des villes via JS -->
        </select>

        <div class="date_livraison">
            <label for="livraison_date">Date de livraison</label>
            <input type="date" name="livraison_date" id="livraison_date" class="input_form input_date" min="<?= date('Y-m-d', strtotime('tomorrow')); ?>" required>
        </div>

        <input type="submit" class="btn_lien input_submit" name="paiement_submit" value="Paiement">

    </form>

</section>

<!-- Jeu spécial fête des mères -->

<section id="jeu_loterie" style="display: none;">

    <div class="machine">
        <form id="prizeForm" action="/lafleur/index.php?page=profil" method="POST" style="display: none;">
            <input type="hidden" name="prize_id" id="prize_id">
        </form>

        <div class="slots">
            <div class="slot" id="slot1">
                <div class="symbol">⭐</div>
            </div>
            <div class="slot" id="slot2">
                <div class="symbol">⭐</div>
            </div>
            <div class="slot" id="slot3">
                <div class="symbol">⭐</div>
            </div>
        </div>
        <button id="spinButton" onclick="spin()">Jouer</button>
        <span class="message" id="message"></span>
        <span class="countdown" id="countdown" style="display:none;">Redirection dans 3 secondes...</span>
    </div>

</section>

<script>
    document.querySelector('input[name="paiement_submit"]').addEventListener('click', function() {
        // Empêcher l'envoi du formulaire
        event.preventDefault();
        // Afficher la section de jeu
        document.getElementById('jeu_loterie').style.display = 'block';
    });

    function soumettreFormulaire(idLot) {
        // Mettre à jour la valeur de l'élément caché "gain_loterie_id"
        document.getElementById("gain_loterie_id").value = idLot;
        // Soumettre le formulaire
        document.querySelector('section.livraison.formulaire form').submit();
    }
    // Fonction qui détermine le lot gagné en fonction des probabilités souhaitées
    function getPrize() {
        // Génère un nombre aléatoire entre 0 et 100
        const randomNumber = Math.random() * 100;

        // Compare le nombre aléatoire aux seuils pour déterminer le prix et le symbole correspondant
        if (randomNumber < 2) {
            return {
                id: 1,
                prize: "un bouquet de roses",
                symbol: "💐"
            };
        } else if (randomNumber < 10) {
            return {
                id: 2,
                prize: "une rose",
                symbol: "🌹"
            };
        } else if (randomNumber < 30) {
            return {
                id: 3,
                prize: "un porte-clé",
                symbol: "🔑"
            };
        } else if (randomNumber < 60) {
            return {
                id: 4,
                prize: "un sac réutilisable",
                symbol: "🛍️"
            };
        } else {
            return {
                id: 5,
                prize: "un stylo",
                symbol: "🖊️"
            };
        }
    }



    // Fonction qui déclenche l'animation des rouleaux et détermine le résultat
    function spin() {

        // Obtient les éléments DOM pour les trois rouleaux et le message
        const slot1 = document.getElementById("slot1").querySelector(".symbol");
        const slot2 = document.getElementById("slot2").querySelector(".symbol");
        const slot3 = document.getElementById("slot3").querySelector(".symbol");
        const message = document.getElementById("message");
        const spinButton = document.getElementById("spinButton");

        // Désactive le bouton pour empêcher de jouer à nouveau
        spinButton.disabled = true;
        spinButton.style.opacity = 0.5;

        // Génère un nombre aléatoire pour déterminer si le joueur gagne (nombre <= 0.5) ou perd (nombre > 0.5)
        const winOrLose = Math.random();

        // Initialise les variables prize (lot) et symbol (symbole à afficher sur les rouleaux)
        let prize = null;
        let symbol = "❌";
        let result = null;

        // Si le joueur gagne, appelle la fonction getPrize() pour obtenir le lot et le symbole correspondant
        if (winOrLose <= 1) {
            result = getPrize();
            prize = result.prize;
            symbol = result.symbol;
        }

        // Anime les rouleaux en les déplaçant vers le haut de 50 pixels
        slot1.style.transform = "translateY(-50px)";
        slot2.style.transform = "translateY(-50px)";
        slot3.style.transform = "translateY(-50px)";

        // Après 500ms, met à jour les symboles des rouleaux et les ramène à leur position initiale
        setTimeout(() => {
            slot1.textContent = symbol;
            slot2.textContent = symbol;
            slot3.textContent = symbol;
            slot1.style.transform = "translateY(0)";
            slot2.style.transform = "translateY(0)";
            slot3.style.transform = "translateY(0)";

            // Si le joueur a gagné un lot, affiche le message de gain et le lot remporté
            if (prize) {
                message.textContent = "Gagné ! Vous avez remporté " + prize + " !";
                message.style.color = "lime";
                // Ajoute l'ID du lot gagné à l'input caché et soumet le formulaire
                soumettreFormulaire(result.id);

            } else {
                // Sinon, le joueur a perdu, affiche le message de perte
                message.textContent = "Perdu";
                message.style.color = "red";
            }

            console.log(result.id);
            console.log(prize);

            // Compte à rebours de 3 secondes avant le retour automatique sur le site
            let secondsLeft = 3;
            const countdown = setInterval(() => {
                message.textContent = `Redirection vers votre profil dans ${secondsLeft} secondes...`;
                secondsLeft--;
                if (secondsLeft === -1) {
                    clearInterval(countdown);
                    // Soumettre le formulaire après le compte à rebours
                    if (prize) {
                        document.getElementById("prizeForm").submit();
                    } else {
                        window.location.href = "/lafleur/index.php?page=profil";
                    }

                }
            }, 1000);
        }, 500)
    }
</script>