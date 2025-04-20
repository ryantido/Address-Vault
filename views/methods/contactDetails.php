<?php
$pageTitle = "Détails du contact - AddressVault";
ob_start();

// Récupération du contact (à remplacer par la méthode d'extraction depuis votre modèle)
// Exemple simulé :
$contact = [
    'id'       => 1,
    'nom'      => 'Dupont',
    'prenom'   => 'Jean',
    'contact'  => 'jean.dupont@example.com', // peut être un numéro ou un email
    'categorie'=> 'client',
    'fonction' => 'Manager',
    'libelle'  => 'Personnel'
];
?>

<div class="contact-details">
  <div class="details-header">
    <h1>Détails du contact</h1>
  </div>
  
  <div class="details-card">
    <div class="detail-item">
      <span class="detail-label">Nom :</span>
      <span class="detail-value"><?= htmlspecialchars($contact['nom']) ?></span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Prénom :</span>
      <span class="detail-value"><?= htmlspecialchars($contact['prenom']) ?></span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Contact :</span>
      <span class="detail-value"><?= htmlspecialchars($contact['contact']) ?></span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Catégorie :</span>
      <span class="detail-value"><?= htmlspecialchars($contact['categorie']) ?></span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Fonction :</span>
      <span class="detail-value"><?= htmlspecialchars($contact['fonction']) ?></span>
    </div>
    <div class="detail-item">
      <span class="detail-label">Libellé :</span>
      <span class="detail-value"><?= htmlspecialchars($contact['libelle']) ?></span>
    </div>
  </div>
  
  <div class="action-buttons">
    <a href="/index.php?action=contact/update&id=<?= urlencode($contact['id']) ?>" class="btn btn-edit">Modifier</a>
    <a href="/index.php?action=contact/manage" class="btn btn-back">Retour</a>
  </div>
</div>

<?php
$content = ob_get_clean();
include 'views/template/template.view.php';
?>
