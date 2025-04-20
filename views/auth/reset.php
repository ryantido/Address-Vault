<?php 

    $headTitle = 'AddressVault - Reset';
    ob_start();

?>

    <div class="form-overlay">
        <form class="auth-form hidden">
            <h1>Reset your Password ⚒</h1>
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" name="password" placeholder="Nouveau mot de passe" class="input-field">
            <label for="password2">Confirmer le mot de passe :</label>
            <input type="password" name="password2" placeholder="Confirmer" class="input-field">
            <input type="submit" value="Reset Password" class="submit-btn">
            <a href="/login" class="back-link">Retour</a>
        </form>
    </div>

<?php 

    $content = ob_get_clean();
    require 'views/template/template.view.php';

?>