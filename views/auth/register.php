<?php 

    $headTitle = 'AddressVault - Register';
    ob_start();

?>

    <div class="form-overlay">
        <form class="auth-form">
          <h1>Create an Account 🖌</h1>
          <label for="password">Mot de passe :</label>
          <input type="password" name="password" placeholder="Mot de passe" class="input-field">
          <label for="password2">Vérifier le mot de passe :</label>
          <input type="password" name="password2" placeholder="Confirmer le mot de passe" class="input-field">
          <input type="submit" value="Sign in" class="submit-btn">
        </form>
    </div>

<?php 

    $content = ob_get_clean();
    require 'views/template/template.view.php';

?>