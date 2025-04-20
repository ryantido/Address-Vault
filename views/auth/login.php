<?php 

    $headTitle = 'AddressVault - Login';
    ob_start();

?>

    <div class="form-overlay">        
        <form class="auth-form hidden">
            <h1>Welcome Back ! 🥂</h1>
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" placeholder="Mot de passe" class="input-field">
            <input type="submit" value="Login" class="submit-btn">
        </form>
    </div>

<?php 

    $content = ob_get_clean();
    require 'views/template/template.view.php';

?>