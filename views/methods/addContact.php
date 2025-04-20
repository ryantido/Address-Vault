<?php 

    $headTitle = '';
    ob_start();
    
?>

    <section id="add-contact">
        <h2>Ajouter un contact</h2>
        <form>
            <button type="button" class="exit-button"><i>Exit</i></button>
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>
    
            <label for="surname">Prénom :</label>
            <input type="text" id="surname" name="surname" required>
    
            <label for="fonction">Fonction : (client, fournisseur, juriste, etc.)</label>
            <input type="text" id="fonction" name="fonction" required>
    
            <label for="category">Catégorie : (VIP, blacklisté, etc.)</label>
            <input type="text" id="category" name="category" required>
    
            <div class="button-group">
                <button type="submit" name="added">Ajouter</button>
                <button type="reset">Réinitialiser</button>
            </div>
        </form>
    </section>
    

<?php 

    $content = ob_get_clean();
    require 'views/template/template.view.php';

?>

