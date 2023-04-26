<section class="nous_trouver">

    <div class="contact_titre">

        <h2 class="h1">Où nous trouver ?</h2>


        <iframe data-aos="flip-up" data-aos-duration="1000" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11525.688212555693!2d5.3629586!3d43.7640971!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12ca192abcc42867%3A0x6fb3b59d3e84dcbe!2sLafleur!5e0!3m2!1sfr!2sfr!4v1681222426760!5m2!1sfr!2sfr" width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>

    <div class="contact_coord">

            <div class="contact_adresse flex basis50">

                <img src="./img/accueil.svg" alt="Logo adresse" class="mr50">

                <p class="fs48">Place Ormeau<br>84160 Lourmarin</p>

            </div>

            <div class="contact_tel flex basis50">

                <img src="./img/tel.svg" alt="Logo téléphone" class="mr50">

                <p class="fs48">04.00.00.00.00<br>06.00.00.00.00</p>

            </div>

            <div class="contact_horaire flex">

                <img src="./img/horaire.svg" alt="Logo horaire d'ouverture" class="mr50">

                <p><span class="fs48">Horaires</span><br><span class="fs36">Tous les jours de lundi à vendredi de 8h30 à 19h.<br>Le samedi de 9h30 à 18h.</span></p>

            </div>

    </div>

</section>

<section class="formulaire">

    <h2 class="h1">Nous contacter</h2>

    <form action="controleur/c_contact.php" method="post">

            <label for="contact_nom"></label>

            <input type="text" name="nom" id="contact_nom" class="input_form" placeholder="Nom" required>

            <label for="contact_email"></label>

            <input type="email" name="email" id="contact_email" class="input_form" placeholder="Email" required>

            <label for="contact_telephone"></label>

            <input type="tel" name="telephone" id="contact_telephone" class="input_form" placeholder="Téléphone">

            <label for="contact_message"></label>

            <textarea name="message" id="contact_message" cols="30" rows="10" placeholder="Message" required></textarea>

            <input type="submit" class="btn_lien input_submit" value="Envoyer">

    </form>

</section>