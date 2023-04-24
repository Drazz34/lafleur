<section class="formulaire">

    <h1 class="h1 connexion_h1">Connectez-vous</h1>

        <form action="#" method="post">

            <label for="connexion_email"></label>

            <input type="email" name="email" id="connexion_email" class="input_form" placeholder="Email" required>

            <label for="connexion_password"></label>

            <input type="password" name="password" id="connexion_password" class="input_form" placeholder="Mot de passe" required>

            <input type="submit" class="btn_lien input_submit" name="connexion_submit" value="Connexion">

        </form>

</section>

<section class="formulaire">

    <h1 class="h1 connexion_h1">Créez votre compte</h1>

        <form action="#" method="post" id="creation_form">

            <label for="creation_email"></label>
            <span id="email_error" class="error" style="display:none; color: red;">L'adresse email est invalide.</span>
            <input type="email" name="creation_email" id="creation_email" class="input_form" placeholder="Email" required>

            <label for="creation_password"></label>
            <span id="password_error" class="error" style="display:none; color: red;">Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, un chiffre et un caractère spécial (@, $, !, %, *, ?, &).</span>
            <input type="password" name="creation_password" id="creation_password" class="input_form" placeholder="Mot de passe" required>

            <label for="creation_nom"></label>

            <input type="text" name="creation_nom" id="creation_nom" class="input_form" placeholder="Nom" required>

            <label for="creation_prenom"></label>

            <input type="text" name="creation_prenom" id="creation_prenom" class="input_form" placeholder="Prénom" required>

            <label for="creation_rue"></label>

            <input type="text" name="creation_rue" id="creation_rue" class="input_form" placeholder="Rue" required>

            <label for="creation_cp"></label>

            <input type="text" name="creation_cp" id="creation_cp" class="input_form" placeholder="Code postal" maxlength="5" required>

            <label for="creation_ville"></label>

            <input type="text" name="creation_ville" id="creation_ville" class="input_form" placeholder="Ville" required>

            <input type="submit" class="btn_lien input_submit" name="submit" value="Créer mon compte">

        </form>

</section>