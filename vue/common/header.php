<header id="header">

    <h1><a href="index.php?page=accueil">lafleur</a></h1>

    <nav>
        <ul>
            <li><a href="index.php?page=accueil">Accueil</a></li>
            <li><a href="index.php?page=presentation">Présentation</a></li>
            <li><a href="index.php?page=prestations">Prestations</a></li>
            <li><a href="index.php?page=boutique">Boutique</a></li>
            <li><a href="index.php?page=contact">Contact</a></li>
            <li><a href="">Blog</a></li>
            <?php if (empty($client)) {
                echo '<li><a href="index.php?page=connexion">Se connecter</a></li>';
            } else {
                echo '<li><a href="index.php?page=profil">Mon profil</a></li>';
                echo '<form action="index.php" method="post">
                <input type="hidden" name="deconnexion" value="true">
                <button type="submit" class="btn_clean" onclick="return confirm("Êtes-vous sûr(e) de vouloir vous déconnecter ?")">Déconnexion</button>
            </form>';
            } ?>
        </ul>
    </nav>

    <!-- Menu burger -->
    <button type="button" class="nav-toggler">

        <span class="line l1"></span>
        <span class="line l2"></span>
        <span class="line l3"></span>

        </p>

</header>

<div class="banniere">

<!-- <?php if (!empty($client)) {
        echo "<h3>Bienvenue " . $client['prenom'] . " !</h3>";
    } ?> -->



    <img src="./img/banniere.svg" alt="Bannière du site" class="banniere_img">

    <img src="./img/logo.svg" alt="Logo de Lafleur" class="banniere_logo">

    <div class="titre">

        <span class="ligne"></span>

        <p class="banniere_titre">Artisan fleuriste sur Lourmarin (84160)</p>

        <span class="ligne"></span>

    </div>

</div>