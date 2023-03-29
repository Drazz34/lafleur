<section class="commande">

    <h1 class="h1">Mon profil</h1>

    <?php if (!empty($commandesClient)) : ?>

        <p>Mes commandes passées :</p>

        <table class="commandes">

            <thead>

                <tr>
                    <th>Num. Com.</th>
                    <th>Article</th>
                    <th>Commandé le</th>
                    <th>Prix</th>
                </tr>

            </thead>

            <tbody>

                <?php foreach ($commandesClient as $key => $commandes) : ?>

                    <tr>
                        <?php foreach ($commandes as $value) : ?>
                            <td><?= $value ?></td>
                        <?php endforeach; ?>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</section>

<section class="information">

    <p>Modifier mes informations :</p>

</section>