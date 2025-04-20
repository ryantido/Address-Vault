<?php

    ob_start();

    ?>

        <section class="hero">
            <h1>Gérez vos contacts en toute simplicité</h1>
            <p>AddressVault est une plateforme sécurisée pour organiser, exporter et protéger vos contacts.</p>
            <div class="cta-buttons">
                <a href="#contact-form">Formulaire d'Assistance</a>
                <a href="#export-section">Exportation de Contacts</a>
            </div>
        </section>

        <section class="info-section">
            <h2>Pourquoi choisir AddressVault ?</h2>
            <p>Sécurité, simplicité et efficacité sont au cœur de notre plateforme. Nous vous permettons de gérer et d'exporter vos contacts en toute confiance.</p>
        </section>

        <section class="features-section">
            <h2>Fonctionnalités clés</h2>
            <div class="feature">Gestion centralisée et sécurisée des contacts</div>
            <div class="feature">Exportation en plusieurs formats (CSV, PDF)</div>
            <div class="feature">Assistance et support en ligne</div>
            <div class="feature">Interface intuitive et épurée</div>
        </section>

    <?php 

    $content = ob_get_clean();
    require 'views/template/template.view.php';

?>    