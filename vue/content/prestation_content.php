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




        <!-- <div class="presta_art">
    
            <a href="index.php?page=boutique&categorie="><img src="./img/mariage.jpg" alt="Bouquet de la mariée"></a>
    
            <a href="index.php?page=boutique&categorie=" class="presta_cate h3">Mariages</a>
    
            <p>Nous réalisons les bouquets de mariée retombants, ronds, en forme d'éventail, des centres de table...</p>
    
        </div>
    
        <div class="presta_art">
    
            <a href=""><img src="./img/merci.jpg" alt="Mot de remerciement accompagné de tulipes rouges"></a>
    
            <a href="" class="presta_cate h3">Remerciements</a>
    
            <p>Montrez votre reconnaissance et votre gratitude en offrant des fleurs.</p>
    
        </div>
    
        <div class="presta_art">
    
            <a href=""><img src="./img/naissance.jpg" alt="Nounours tenant un bouquet de pâquerettes"></a>
    
            <a href="" class="presta_cate h3">Naissances</a>
    
            <p>Les naissances, les baptêmes... Avec des sujets accompagnant vos compositions et vos bouquets.</p>
    
        </div>
    
        <div class="presta_art">
    
            <a href=""><img src="./img/cadeau.jpg" alt="Mains tenant un paquet contenant des fleurs"></a>
    
            <a href="" class="presta_cate h3">Anniversaires</a>
    
            <p>Nous réalisons des bouquets ronds ou allongées ainsi que des bouquets aériens.</p>
    
        </div>
    
        <div class="presta_art">
    
            <a href=""><img src="./img/amour.jpg" alt="Couple amoureux"></a>
    
            <a href="" class="presta_cate h3">Amour et sentiments</a>
    
            <p>Nos compositions sont élégantes en hauteur ou rondes avec des contenants ou vanneries.</p>
    
        </div> -->

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