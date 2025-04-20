<?php
  $pageTitle = "Liste des contacts - AddressVault";
  ob_start();

  $allContacts = [
      ['id' => 1, 'nom' => 'Dupont', 'prenom' => 'Jean', 'email' => 'jean.dupont@example.com', 'telephone' => '0102030405', 'categorie' => 'client'],
      ['id' => 2, 'nom' => 'Martin', 'prenom' => 'Sophie', 'email' => 'sophie.martin@example.com', 'telephone' => '0607080910', 'categorie' => 'fournisseur'],
      ['id' => 3, 'nom' => 'Durand', 'prenom' => 'Paul', 'email' => 'paul.durand@example.com', 'telephone' => '0203040506', 'categorie' => 'client'],
  ];
?>

<div class="container contact-list">
  <h1>Liste des contacts</h1>
  
  <div class="search-filter-bar">
    <div class="search">
      <input type="text" id="contactSearch" placeholder="Rechercher un contact...">
    </div>
    
    <div class="dropdown-container">
      <button id="filterButton" class="btn-dropdown">Filtrer par catégorie</button>
      <div id="filterOptions" class="dropdown-options hidden">
        <a href="#" data-filter="all">Tous</a>
        <a href="#" data-filter="client">Client</a>
        <a href="#" data-filter="fournisseur">Fournisseur</a>
      </div>
    </div>
    
    <div class="dropdown-container">
      <button id="sortButton" class="btn-dropdown">Classer par</button>
      <div id="sortOptions" class="dropdown-options hidden">
        <a href="#" data-sort="nom">Nom</a>
        <a href="#" data-sort="prenom">Prénom</a>
      </div>
    </div>
  </div>
  
  <div class="table-responsive">
    <table class="contact-table">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Téléphone</th>
          <th>Catégorie</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="contactTableBody">
        <?php foreach ($allContacts as $contact): ?>
          <tr class="contact-row">
            <td class="contact-name"><?= htmlspecialchars($contact['nom']) ?></td>
            <td class="contact-prenom"><?= htmlspecialchars($contact['prenom']) ?></td>
            <td><?= htmlspecialchars($contact['email']) ?></td>
            <td><?= htmlspecialchars($contact['telephone']) ?></td>
            <td class="contact-category"><?= htmlspecialchars($contact['categorie']) ?></td>
            <td>
              <a href="/index.php?action=contact/details&id=<?= urlencode($contact['id']) ?>" class="btn-view">Consulter</a>
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
