<section>

    <div class="prestation_titre">

        <h1 class="h1">Nos prestations</h1>

    </div>

    <div class="presta">

        <?php foreach ($lesCategories as $uneCategorie) : ?>

            <div class="presta_art">

                <a href="index.php?page=boutique&categorie=<?= $uneCategorie['id'] ?>"><img src="./img/<?= $uneCategorie['photo'] ?>" alt="<?= $uneCategorie['alt'] ?>"></a>

                <a href="index.php?page=boutique&categorie=<?= $uneCategorie['id'] ?>" class="presta_cate h3"><?= $uneCategorie['nom'] ?></a>

                <p><?= $uneCategorie['description'] ?></p>

            </div>

        <?php endforeach ?>

    </div>

</section>

<section class="prestation_boutique">

    <div class="presta_boutique">

        <img src="./img/banniere.jpg" alt="Bannière de lilas" class="banniere_lilas">

        <div class="presta_boutique_ligne">

            <h3 class="h3">Découvrez notre boutique en ligne</h3>

            <a href="index.php?page=boutique"><img src="./img/livraison.jpg" alt="Boutique de fleuriste en ligne" class="boutique_ligne"></a>

        </div>

    </div>

</section>