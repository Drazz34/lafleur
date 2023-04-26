<section>

    <h2 class="h1 titre_boutique">Notre boutique en ligne</h2>

    <form action="index.php?page=boutique" method="get">

        <input type="hidden" name="page" value="boutique">

        <div class="select">

            <div class="select_categorie">
                <label for="categorie">Choix par catégorie : </label>
                <select name="categorie" id="categorie">
                    <option value="">-- Catégories --</option>
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= $categorie['id'] ?>" <?php if (isset($_GET['categorie']) && $_GET['categorie'] == $categorie['id']) echo "selected"; ?>><?= $categorie['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="select_couleur">
                <label for="couleur">Choix par couleur : </label>
                <select name="couleur" id="couleur">
                    <option value="">-- Couleurs --</option>
                    <?php foreach ($couleurs as $couleur) : ?>
                        <option value="<?= $couleur['id'] ?>" <?php if (isset($_GET['couleur']) && $_GET['couleur'] == $couleur['id']) echo "selected"; ?>><?= $couleur['nom_couleur'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="submit_button">

                <input type="submit" value="Rechercher" class="btn_lien">
            </div>

        </div>

    </form>

</section>



<section>

    <div class="articles">

        <!-- Afficher tous les articles -->
        <?php if ((!isset($_GET['categorie']) && (!isset($_GET['couleur']))) || ($_GET['categorie'] == "" && $_GET['couleur'] == "")) : ?>

            <?php foreach ($articles as $article) : ?>

                <div class="card_article" data-aos="fade-up">

                    <a href="./img/<?= $article['photo'] ?>" class="image-popup-no-margins"><img src="./img/<?= $article['photo'] ?>" alt="<?= $article['alt'] ?>"></a>

                    <h3 class="h3"><?= $article['nom'] ?></h3>

                    <p><?= $article['prix_unitaire'] ?> €</p>

                    <?php if ($article['quantite_dispo'] > 0) : ?>
                        <a href="<?= $url_commande; ?>&article_id=<?= $article['id'] ?>">Commander</a>
                    <?php else : ?>
                        <p class="article_indispo">En rupture de stock</p>
                    <?php endif; ?>

                </div>

            <?php endforeach ?>

        <?php endif ?>

        <!-- Afficher les articles par catégorie -->
        <?php if (isset($_GET['categorie']) && (!isset($_GET['couleur']) || $_GET['couleur'] == "")) : ?>

            <?php foreach ($articlesDUneCategorie as $article) : ?>

                <div class="card_article" data-aos="fade-up">

                    <a href="./img/<?= $article['photo'] ?>" class="image-popup-no-margins"><img src="./img/<?= $article['photo'] ?>" alt="<?= $article['alt'] ?>"></a>

                    <h3 class="h3"><?= $article['nom'] ?></h3>

                    <p><?= $article['prix_unitaire'] ?> €</p>

                    <?php if ($article['quantite_dispo'] > 0) : ?>
                        <a href="<?= $url_commande; ?>&article_id=<?= $article['id'] ?>">Commander</a>
                    <?php else : ?>
                        <p class="article_indispo">En rupture de stock</p>
                    <?php endif; ?>

                </div>

            <?php endforeach ?>

        <?php endif ?>

        <!-- Afficher les articles par couleur -->
        <?php if (isset($_GET['couleur']) && (!isset($_GET['categorie']) || $_GET['categorie'] == "")) : ?>

            <?php foreach ($articlesDUneCouleur as $article) : ?>

                <div class="card_article" data-aos="fade-up">

                    <a href="./img/<?= $article['photo'] ?>" class="image-popup-no-margins"><img src="./img/<?= $article['photo'] ?>" alt="<?= $article['alt'] ?>"></a>

                    <h3 class="h3"><?= $article['nom'] ?></h3>

                    <p><?= $article['prix_unitaire'] ?> €</p>

                    <?php if ($article['quantite_dispo'] > 0) : ?>
                        <a href="<?= $url_commande; ?>&article_id=<?= $article['id'] ?>">Commander</a>
                    <?php else : ?>
                        <p class="article_indispo">En rupture de stock</p>
                    <?php endif; ?>

                </div>

            <?php endforeach ?>

        <?php endif ?>

        <!-- Afficher les articles par catégorie et par couleur -->
        <?php if (isset($_GET['categorie']) && isset($_GET['couleur'])) : ?>

            <?php foreach ($articlesDUneCategorieEtDUneCouleur as $article) : ?>

                <div class="card_article" data-aos="fade-up">

                    <a href="./img/<?= $article['photo'] ?>" class="image-popup-no-margins"><img src="./img/<?= $article['photo'] ?>" alt="<?= $article['alt'] ?>"></a>

                    <h3 class="h3"><?= $article['nom'] ?></h3>

                    <p><?= $article['prix_unitaire'] ?> €</p>

                    <?php if ($article['quantite_dispo'] > 0) : ?>
                        <a href="<?= $url_commande; ?>&article_id=<?= $article['id'] ?>">Commander</a>
                    <?php else : ?>
                        <p class="article_indispo">En rupture de stock</p>
                    <?php endif; ?>

                </div>

            <?php endforeach ?>

        <?php endif ?>

    </div>


</section>