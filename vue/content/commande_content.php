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

                <p><?= $article['prix_unitaire'] ?> €</p>

            </div>

            <a href="index.php?page=boutique">Supprimer</a>

        </div>

        <div class="contenu_info">

            <div class="info_input">

                <div>
                    <label for="quantite">Quantité</label>
                    <input type="number" name="quantite" id="quantite" value="1" min="1">
                </div>

                <div>
                    <label for="livraison">Livraison</label>
                    <input type="number" name="livraison" id="livraison" disabled>
                </div>

                <div>
                    <label for="prix_total">Prix total</label>
                    <input type="number" name="prix_total" id="prix_total">
                </div>

            </div>

        </div>

    </div>

</section>

<section class="livraison formulaire">

    <p>Adresse de livraison</p>

    <form action="" method="post">

        <input type="hidden" name="quantite" id="quantite" value="1" min="1">
        <input type="hidden" name="livraison" id="livraison">
        <input type="hidden" name="prix_total" id="prix_total">

        <label for="livraison_nom"></label>

        <input type="text" name="livraison_nom" id="livraison_nom" class="input_form" value="<?= $client['nom'] ?>">

        <label for="livraison_prenom"></label>

        <input type="text" name="livraison_prenom" id="livraison_prenom" class="input_form" value="<?= $client['prenom'] ?>">

        <label for="livraison_rue"></label>

        <input type="text" name="livraison_rue" id="livraison_rue" class="input_form" value="<?= $adresse['rue'] ?>">

        <label for="livraison_cp"></label>

        <input type="text" name="livraison_cp" id="livraison_cp" class="input_form" value="<?= $adresse['code_postal'] ?>" maxlength="5">

        <label for="livraison_ville"></label>

        <input type="text" name="livraison_ville" id="livraison_ville" class="input_form" value="<?= $adresse['nom_ville'] ?>">

        <input type="submit" class="btn_lien input_submit" name="paiement_submit" value="Paiement">

    </form>

</section>