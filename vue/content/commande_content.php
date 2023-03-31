<section class="ma_commande">

    <div class="ma_commande_titre">

        <h1 class="h1">Ma commande</h1>

        <div class="frais">

            <img src="img/livraison.svg" alt="Un camion de livraison">

            <p>Livraison offerte dès 50€ d'achat</p>

        </div>

    </div>

    <div class="ma_commande_contenu">

        <div class="contenu_produit">

            <div class="card_article">

                <a href="./img/<?= $article['photo'] ?>" class="image-popup-no-margins"><img src="./img/<?= $article['photo'] ?>" alt="<?= $article['alt'] ?>"></a>

                <h3 class="h3"><?= $article['nom'] ?></h3>

                <p><?= $article['prix_unitaire'] ?> €</p>

            </div>

            <a href="index.php?page=boutique">Supprimer</a>

        </div>

        <div class="contenu_info">

            <div class="info_input">

                <div>
                    <label for="quantite">Quantité</label>
                    <input type="number" name="quantite" id="quantite" value="1" min="1">
                </div>

                <div>
                    <label for="livraison">Livraison</label>
                    <input type="number" name="livraison" id="livraison" disabled>
                </div>

                <div>
                    <label for="prix_total">Prix total</label>
                    <input type="number" name="prix_total" id="prix_total">
                </div>

            </div>

        </div>

    </div>

</section>

<section class="livraison formulaire">

    <p>Adresse de livraison</p>

    <form action="" method="post">

        <input type="hidden" name="quantite" id="quantite" value="1" min="1">
        <input type="hidden" name="livraison" id="livraison">
        <input type="hidden" name="prix_total" id="prix_total">

        <label for="livraison_nom"></label>

        <input type="text" name="livraison_nom" id="livraison_nom" class="input_form" value="<?= $client['nom'] ?>">

        <label for="livraison_prenom"></label>

        <input type="text" name="livraison_prenom" id="livraison_prenom" class="input_form" value="<?= $client['prenom'] ?>">

        <label for="livraison_rue"></label>

        <input type="text" name="livraison_rue" id="livraison_rue" class="input_form" value="<?= $adresse['rue'] ?>">

        <label for="livraison_cp"></label>

        <select name="livraison_cp" id="livraison_cp">
            <option value="">-- Code postal --</option>

            <?php foreach ($codesPostaux as $cp) : ?>
                <option value="<?= $cp ?>"><?= $cp ?></option>
            <?php endforeach ?>

        </select>

        <label for="livraison_ville"></label>
        <select name="livraison_ville" id="livraison_ville">
            <option value="">-- Ville --</option>
            <?php foreach ($villesLivrables as $ville) : ?>
                <option value="<?= $ville ?>"><?= $ville ?></option>
            <?php endforeach ?>
        </select>

        <input type="submit" class="btn_lien input_submit" name="paiement_submit" value="Paiement">

    </form>

</section>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cp = $_POST['livraison_cp'];

    // Connexion à la base de données
    $pdo = AccesDonnees::getPdo();

    // Requête pour récupérer les villes correspondantes au code postal
    $stmt = $pdo->prepare("SELECT v.nom_ville
                           FROM lf_villes v
                           JOIN lf_adresses a ON v.id = a.ville_id
                           JOIN lf_codes_postaux cp ON a.code_postal_id = cp.id
                           WHERE cp.code_postal = :cp
                           ORDER BY v.nom_ville");
    $stmt->bindParam(':cp', $cp);
    $stmt->execute();

    // Récupération des résultats de la requête
    $villes = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Construction de la liste déroulante des villes
    if (!empty($villes)) {
        $options = '';
        foreach ($villes as $ville) {
            $options .= '<option value="' . $ville . '">' . $ville . '</option>';
        }
    } else {
        $options = '<option value="">-- Aucune ville disponible --</option>';
    }

    // Mise en mémoire tampon de la sortie de PHP
    ob_start();
    echo $options;
    $ville_options = ob_get_clean();
}

?>

<label for="livraison_cp"></label>
<select name="livraison_cp" id="livraison_cp">
  <option value="">-- Code postal --</option>
  <?php foreach ($codesPostaux1 as $cp) : ?>
    <option value="<?= $cp['code_postal'] ?>"><?= $cp['code_postal'] ?></option>
  <?php endforeach ?>
</select>

<label for="livraison_ville"></label>
<select name="livraison_ville" id="livraison_ville">
  <option value="">-- Ville --</option>
  <?php if (isset($ville_options)) : ?>
    <?= $ville_options ?>
  <?php endif ?>
</select>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    var livraison_cp = document.getElementById('livraison_cp');
    var livraison_ville = document.getElementById('livraison_ville');

    livraison_cp.addEventListener('change', function() {
      var cp = this.value;
      if (cp) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (xhr.status === 200) {
            livraison_ville.innerHTML = xhr.responseText;
          } else {
            livraison_ville.innerHTML = '<option value="">-- Ville --</option>';
          }
        };
        xhr.send('livraison_cp=' + cp);
      } else {
        livraison_ville.innerHTML = '<option value="">-- Ville --</option>';
      }
    });
  });
</script>