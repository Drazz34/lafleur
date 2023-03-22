<section>

    <h1 class="h1 titre_boutique">Notre boutique en ligne</h1>

    <form action="index.php?page=boutique" method="get">

        <input type="hidden" name="page" value="boutique">

        <div class="select">

            <div class="select_categorie">
                <label for="categorie">Choix par catégorie : </label>
                <select name="categorie" id="categorie">
                    <option value="">-- Catégorie --</option>
                    <option value="1" <?php if (isset($_GET['categorie']) && $_GET['categorie'] == 1) echo "selected"; ?>>Mariage</option>
                    <option value="3" <?php if (isset($_GET['categorie']) && $_GET['categorie'] == 3) echo "selected"; ?>>Remerciement</option>
                    <option value="4" <?php if (isset($_GET['categorie']) && $_GET['categorie'] == 4) echo "selected"; ?>>Naissance</option>
                    <option value="2" <?php if (isset($_GET['categorie']) && $_GET['categorie'] == 2) echo "selected"; ?>>Anniversaire</option>
                    <option value="5" <?php if (isset($_GET['categorie']) && $_GET['categorie'] == 5) echo "selected"; ?>>Amour et sentiment</option>
                </select>
            </div>

            <div class="select_couleur">
                <label for="couleur">Choix par couleur : </label>
                <select name="couleur" id="couleur">
                    <option value="">-- Couleur --</option>
                    <option value="1" <?php if (isset($_GET['couleur']) && $_GET['couleur'] == 1) echo "selected"; ?>>Rouge</option>
                    <option value="2" <?php if (isset($_GET['couleur']) && $_GET['couleur'] == 2) echo "selected"; ?>>Jaune</option>
                    <option value="3" <?php if (isset($_GET['couleur']) && $_GET['couleur'] == 3) echo "selected"; ?>>Rose</option>
                    <option value="4" <?php if (isset($_GET['couleur']) && $_GET['couleur'] == 4) echo "selected"; ?>>Orange</option>
                </select>
            </div>

            <div class="submit_button">

            <input type="submit" value="Rechercher" class="btn_lien">
            </div>

        </div>

        </div>
    </form>

</section>



<section>

    <div class="articles">

        <?php if ((!isset($_GET['categorie'])) || $_GET['categorie'] == '') : ?>

            <?php foreach ($articles as $article) : ?>

                <div class="card_article">

                    <a href="./img/<?= $article['photo'] ?>" class="image-popup-no-margins"><img src="./img/<?= $article['photo'] ?>" alt="<?= $article['alt'] ?>"></a>

                    <h3 class="h3"><?= $article['nom'] ?></h3>

                    <p><?= $article['prix_unitaire'] ?> €</p>

                    <a href="">Commander</a>

                </div>




            <?php endforeach ?>

        <?php endif ?>




    </div>


</section>