<section id="jeuLoterie">

    <h2 class="h1">Jeu spécial fête des mères</h2>

    <p class="pLoterie">Tentez de gagner un de nos nombreux lots, bonne chance <?= $client['prenom'] ?> !</p>

    <div class="machine">

        <!-- <form id="prizeForm" action="/lafleur/index.php?page=profil" method="POST" style="display: none;">
            <input type="hidden" name="prize_id" id="prize_id">
        </form> -->

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
        <form action="#" method="post" id="formGain">
            <input type="hidden" name="prize_id" id="prize_id">
            <input type="submit" value="Valider le gain" name="valide_gain" style="display: none;" class="submitGain">
        </form>


        <span class="message" id="message"></span>

        <span class="countdown" id="countdown" style="display:none;">Redirection dans 3 secondes...</span>

    </div>

</section>




<script>
    const gains = <?php echo json_encode($gains); ?>;

    const probabilityThresholds = { // seuil
        1: {
            threshold: 2,
            prize: "bouquet de roses",
            symbol: "💐"
        },
        2: {
            threshold: 10,
            prize: "rose",
            symbol: "🌹"
        },
        3: {
            threshold: 30,
            prize: "porte-clé",
            symbol: "🔑"
        },
        4: {
            threshold: 60,
            prize: "sac réutilisable",
            symbol: "🛍️"
        },
        5: {
            threshold: 100,
            prize: "stylo",
            symbol: "🖊️"
        }
    };


    function getPrize(gains) {
        const randomNumber = Math.random() * 100;

        for (let gain of gains) {
            let id = gain.id;
            let quantite = gain.quantite_totale;
            let threshold = probabilityThresholds[id].threshold;

            if (quantite > 0 && randomNumber < threshold) {
                return {
                    id: id,
                    prize: probabilityThresholds[id].prize,
                    symbol: probabilityThresholds[id].symbol
                };
            }

        }
        return null;
    }

    let prizeId;

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

        // Génère un nombre aléatoire pour déterminer si le joueur gagne (nombre <= 0.75) ou perd (nombre > 0.75)
        const winOrLose = Math.random();

        // Initialise les variables prize (lot) et symbol (symbole à afficher sur les rouleaux)
        let prize = null;
        let symbol = "❌";
        let result = null;

        // Si le joueur gagne, appelle la fonction getPrize() pour obtenir le lot et le symbole correspondant
        if (winOrLose <= 0.75) {
            result = getPrize(gains);
            if (result !== null) {
                prize = result.prize;
                symbol = result.symbol;
            }
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
                message.textContent = "Gagné ! Vous avez remporté 1 " + prize + " !";
                message.style.color = "white";
                // Ajoute l'ID du lot gagné à l'input caché
                document.getElementById("prize_id").value = result.id;
                document.querySelector('input[name="valide_gain"]').style.display = "block";
            } else {
                // Sinon, le joueur a perdu, affiche le message de perte
                message.textContent = "Perdu";
                message.style.color = "white";

                // Compte à rebours de 3 secondes avant le retour automatique sur le site
                let secondsLeft = 3;
                const countdown = setInterval(() => {
                    message.textContent = `Redirection vers le site dans ${secondsLeft} secondes...`;
                    secondsLeft--;
                    if (secondsLeft === -1) {
                        clearInterval(countdown);
                        window.location.href = "/site_lafleur/index.php?page=profil";
                    }
                }, 1000);
            }

        }, 500)
    }
</script>