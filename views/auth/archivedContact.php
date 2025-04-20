<?php
$pageTitle = "Contacts archivés - AddressVault";
ob_start();

$archivedContacts = [
    [
      'id' => 1, 
      'nom' => 'Lefevre', 
      'prenom' => 'Marie', 
      'email' => 'marie.lefevre@example.com', 
      'telephone' => '0102030406', 
      'categorie' => 'client', 
      'archived_date' => '2023-03-01'
    ],
    [
      'id' => 2, 
      'nom' => 'Bernard', 
      'prenom' => 'Luc', 
      'email' => 'luc.bernard@example.com', 
      'telephone' => '0607080911', 
      'categorie' => 'fournisseur', 
      'archived_date' => '2023-03-05'
    ],
];
?>

<div class="container archived-contacts">
  <h1>Contacts archivés</h1>
  <div class="table-responsive">
    <table class="contact-table">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Téléphone</th>
          <th>Catégorie</th>
          <th>Date archivage</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($archivedContacts as $contact): ?>
          <tr>
            <td><?= htmlspecialchars($contact['nom']) ?></td>
            <td><?= htmlspecialchars($contact['prenom']) ?></td>
            <td><?= htmlspecialchars($contact['email']) ?></td>
            <td><?= htmlspecialchars($contact['telephone']) ?></td>
            <td><?= htmlspecialchars($contact['categorie']) ?></td>
            <td><?= htmlspecialchars($contact['archived_date']) ?></td>
            <td>
              <a href="/index.php?action=archive/restore&id=<?= urlencode($contact['id']) ?>" class="btn-edit">Restaurer</a>
              <a href="/index.php?action=archive/delete&id=<?= urlencode($contact['id']) ?>" class="btn-delete" onclick="return confirm('Confirmez la suppression définitive de ce contact ?')">Supprimer définitivement</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php
$content = ob_get_clean();
include 'views/template/template.view.php';
?>
