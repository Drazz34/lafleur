<section class="commande">

    <h2 class="h1">Mon profil</h2>

    <?php if (!empty($commandesClient)) : ?>

        <p>Mes commandes passées :</p>

        <table class="commandes">

            <thead>

                <tr>
                    <th>Num. Com.</th>
                    <th>Article</th>
                    <th>Commandé le</th>
                    <th>Prix en €</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($commandesClient as $key => $commande) : ?>

                    <tr>
                        <td><?= $commande['id'] ?></td>
                        <td><?= $commande['nom'] ?><?php if($commande['gain'] != null) { echo "<br>Gain : 1 " . $commande['gain']; } ?></td>
                        <td><?= $commande['date_de_commande'] ?></td>
                        <td><?= $commande['prix'] ?></td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>


    <?php else : ?>

        <p>Aucune commande passée pour le moment.</p>

    <?php endif; ?>

</section>

<section class="information formulaire">

    <p>Modifier mes informations :</p>

    <form action="#" method="post" id="modifForm">

        <label for="modif_email"></label>

        <input type="email" name="modif_email" id="modif_email" class="input_form" value="<?= $client['email'] ?>">

        <label for="modif_ancien_password"></label>

        <input type="password" name="modif_ancien_password" id="modif_ancien_password" class="input_form" placeholder="Ancien mot de passe">

        <label for="modif_password"></label>
        <span class="password_error error" style="display:none; color: red;">Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, un chiffre et un caractère spécial (@, $, !, %, *, ?, &).</span>
        <input type="password" name="modif_password" id="modif_password" class="input_form" placeholder="Nouveau mot de passe">

        <label for="modif_nom"></label>

        <input type="text" name="modif_nom" id="modif_nom" class="input_form" value="<?= $client['nom'] ?>">

        <label for="modif_prenom"></label>

        <input type="text" name="modif_prenom" id="modif_prenom" class="input_form" value="<?= $client['prenom'] ?>">

        <label for="modif_rue"></label>

        <input type="text" name="modif_rue" id="modif_rue" class="input_form" value="<?= $adresse['rue'] ?>">

        <label for="modif_cp"></label>

        <input type="text" name="modif_cp" id="modif_cp" class="input_form" value="<?= $adresse['code_postal'] ?>" maxlength="5">

        <label for="modif_ville"></label>

        <input type="text" name="modif_ville" id="modif_ville" class="input_form" value="<?= $adresse['nom_ville'] ?>">

        <input type="submit" class="btn_lien input_submit" name="modif_submit" value="Modifier">

    </form>

</section>