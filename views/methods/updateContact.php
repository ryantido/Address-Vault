<?php 

    $headTitle = '';
    ob_start();

?>

    <section id="update-contact">
        <h2>Mettre à jour un contact</h2>
        <form>
            <button type="button" class="exit-button"><i>Exit</i></button>
            <label for="name-update">Nom</label>
            <input type="text" id="name-update" name="name" required>

            <label for="surname-update">Prénom</label>
            <input type="text" id="surname-update" name="surname" required>

            <label for="fonction-update">Fonction (client, fournisseur, juriste, etc.)</label>
            <input type="text" id="fonction-update" name="fonction" required>

            <label for="category-update">Catégorie (VIP, blacklisté, etc.)</label>
            <input type="text" id="category-update" name="category" required>

            <div class="button-group">
                <button type="submit" name="added">Mettre à jour</button>
                <button type="reset">Réinitialiser</button>
            </div>
        </form>
    </section>
    

<?php 

    $content = ob_get_clean();
    require 'views/template/template.view.php';

?>