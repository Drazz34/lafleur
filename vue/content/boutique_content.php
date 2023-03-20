<section>

    <h1 class="h1">Notre boutique en ligne</h1>

    <div class="select">

        <label for="categorie">Choix par catégorie : </label>
        <select name="categorie" id="categorie" onchange="window.location.href=this.value">
            <option value="">-- Catégorie --</option>
            <option value="index.php?page=boutique&categorie=1">Mariage</option>
            <option value="index.php?page=boutique&categorie=3">Remerciement</option>
            <option value="index.php?page=boutique&categorie=4">Naissance</option>
            <option value="index.php?page=boutique&categorie=2">Anniversaire</option>
            <option value="index.php?page=boutique&categorie=5">Amour et sentiment</option>
        </select>

        <label for="couleur">Choix par couleur : </label>
        <select name="couleur" id="couleur">
            <option value="">-- Couleur --</option>
            <option value="rouge">Rouge</option>
            <option value="jaune">Jaune</option>
            <option value="rose">Rose</option>
            <option value="orange">Orange</option>
        </select>

    </div>

</section>

<section>

    <div class="articles">

        <?php if (isset($_GET['categorie'])) : ?>
            <?php var_dump($categorie); ?>

            <?php foreach ($categorie as $article) : ?>
                <p><?= $article ?></p>
            <?php endforeach ?>
        <?php endif ?>




    </div>


</section>