<section class="ma_commande">

    <div class="ma_commande_titre">

        <h2 class="h1">Ma commande</h2>

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

    <form action="#" method="post">

        <input type="hidden" name="quantite" id="quantite" value="1" oninput="updateQuantite()">
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