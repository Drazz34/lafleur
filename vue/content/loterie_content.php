<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loterie spéciale fête des mères</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #333;
            margin: 0;
        }

        .machine {
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
        }

        .slots {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #555;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            height: 50px;
        }

        .slot {
            background-color: white;
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            font-weight: bold;
            margin: 0 5px;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
        }

        .slot .symbol {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            line-height: 50px;
            text-align: center;
            font-weight: bold;
            transition: transform 1s;
        }

        button {
            background-color: #555;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #666;
        }

        .message {
            display: inline-block;
            margin-left: 10px;
            font-weight: bold;
        }
    </style>

</head>

<body>

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

    <script>
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
                    document.getElementById("prize_id").value = result.id;
                    
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
                    message.textContent = `Redirection vers le site dans ${secondsLeft} secondes...`;
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

</body>

</html>