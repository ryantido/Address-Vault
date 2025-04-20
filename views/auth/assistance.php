<?php 

    $headTitle = 'AddressVault - Assistance';
    ob_start();

?>

<section class="contact-form">
    <h2>Assistance Contact Form</h2>
    <form>
        <input type="text" placeholder="Code Client" required>
        <textarea placeholder="Expliquez votre problème..." rows="5" required></textarea>
        <input type="file" accept="image/*">
        <button type="submit">Envoyer</button>
    </form>
    <div class="contact-options">
        <p>Autres méthodes de contact :</p>
        <a href="https://wa.me/+237680989732" target="_blank">WhatsApp</a>
        <a href="tel:+237680989732">Appel direct</a>
        <a href="mailto:ryantido34@gmail.com" style="text-decoration:wavy;">support@exemple.com</a>
    </div>
</section>


<?php 

    $content = ob_get_clean();
    require 'views/template/template.view.php';

?>
