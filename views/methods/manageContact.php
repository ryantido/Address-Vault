<?php
$pageTitle = "Gestion des contacts - AddressVault";
ob_start();

// Récupération des contacts depuis la base de données (ici, un exemple simulé)
$contacts = [
    ['id' => 1, 'nom' => 'Dupont', 'prenom' => 'Jean', 'email' => 'jean.dupont@example.com', 'telephone' => '0102030405', 'categorie' => 'client'],
    ['id' => 2, 'nom' => 'Martin', 'prenom' => 'Sophie', 'email' => 'sophie.martin@example.com', 'telephone' => '0607080910', 'categorie' => 'fournisseur'],
    ['id' => 3, 'nom' => 'Durand', 'prenom' => 'Paul', 'email' => 'paul.durand@example.com', 'telephone' => '0203040506', 'categorie' => 'client'],
    // Ajoutez d'autres contacts ici...
];
?>

<div class="container manage-contact">
  <h1>Gestion des contacts</h1>
  
  <!-- Barre de recherche et filtres -->
  <div class="manage-controls">
    <!-- Barre de recherche moderne -->
    <div class="search-bar">
      <input type="text" id="manageSearch" placeholder="Rechercher un contact..." />
    </div>
    
    <!-- Dropdown pour le filtre par catégorie -->
    <div class="dropdown-container">
      <button id="manageFilterButton" class="btn-dropdown">Filtrer par catégorie</button>
      <div id="manageFilterOptions" class="dropdown-options hidden">
        <a href="#" data-filter="all">Tous</a>
        <a href="#" data-filter="client">Client</a>
        <a href="#" data-filter="fournisseur">Fournisseur</a>
        <!-- Autres options selon vos besoins -->
      </div>
    </div>
    
    <!-- Dropdown pour la classification -->
    <div class="dropdown-container">
      <button id="manageSortButton" class="btn-dropdown">Classer par</button>
      <div id="manageSortOptions" class="dropdown-options hidden">
        <a href="#" data-sort="nom">Nom</a>
        <a href="#" data-sort="prenom">Prénom</a>
      </div>
    </div>
  </div>
  
  <!-- Tableau des contacts -->
  <div class="table-responsive">
    <table class="contact-table" id="manageContactTable">
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
      <tbody id="manageContactTableBody">
        <!-- Les contacts seront insérés ici par JavaScript -->
      </tbody>
    </table>
  </div>
  
  <!-- Pagination dynamique -->
  <div class="pagination" id="managePagination">
    <!-- Les liens de pagination seront générés ici -->
  </div>
</div>

<!-- Script JavaScript pour gérer la recherche, le filtrage, le tri et la pagination sans recharger la page -->
<script>
  document.addEventListener("DOMContentLoaded", function(){
      // Stockage de l'ensemble des contacts provenant de PHP
      let allContacts = <?php echo json_encode($contacts); ?>;
      let currentFilter = 'all';
      let currentSort = '';
      let currentPage = 1;
      const contactsPerPage = 20;
      
      // Références aux éléments du DOM
      const searchInput   = document.getElementById('manageSearch');
      const filterButton  = document.getElementById('manageFilterButton');
      const filterOptions = document.getElementById('manageFilterOptions');
      const sortButton    = document.getElementById('manageSortButton');
      const sortOptions   = document.getElementById('manageSortOptions');
      const tableBody     = document.getElementById('manageContactTableBody');
      const paginationDiv = document.getElementById('managePagination');
      
      // Gestion de l'affichage des dropdowns
      filterButton.addEventListener('click', () => {
          filterOptions.classList.toggle('hidden');
      });
      sortButton.addEventListener('click', () => {
          sortOptions.classList.toggle('hidden');
      });
      
      // Sélection d'une option de filtre par catégorie
      filterOptions.querySelectorAll('a').forEach(option => {
          option.addEventListener('click', function(e){
              e.preventDefault();
              currentFilter = this.getAttribute('data-filter');
              filterOptions.classList.add('hidden');
              currentPage = 1;
              updateDisplay();
          });
      });
      
      // Sélection d'une option de tri
      sortOptions.querySelectorAll('a').forEach(option => {
          option.addEventListener('click', function(e){
              e.preventDefault();
              currentSort = this.getAttribute('data-sort');
              sortOptions.classList.add('hidden');
              currentPage = 1;
              updateDisplay();
          });
      });
      
      // Recherche avec effet debounce (pour limiter les appels)
      let debounceTimer;
      searchInput.addEventListener('keyup', function(){
          clearTimeout(debounceTimer);
          debounceTimer = setTimeout(() => {
              currentPage = 1;
              updateDisplay();
          }, 300);
      });
      
      // Fonction de mise à jour de l'affichage
      function updateDisplay(){
          let searchTerm = searchInput.value.trim().toLowerCase();
          // Filtrage des contacts selon la recherche et la catégorie
          let filtered = allContacts.filter(contact => {
              let matchSearch = searchTerm === "" || 
                  contact.nom.toLowerCase().includes(searchTerm) || 
                  contact.prenom.toLowerCase().includes(searchTerm) || 
                  contact.email.toLowerCase().includes(searchTerm) || 
                  contact.telephone.toLowerCase().includes(searchTerm);
              let matchFilter = (currentFilter === 'all' || contact.categorie.toLowerCase() === currentFilter.toLowerCase());
              return matchSearch && matchFilter;
          });
          
          // Tri des contacts si un critère est sélectionné
          if(currentSort){
              filtered.sort((a, b) => {
                  return a[currentSort].toLowerCase().localeCompare(b[currentSort].toLowerCase());
              });
          }
          
          // Gestion de la pagination côté client
          let totalPages = Math.ceil(filtered.length / contactsPerPage);
          if(totalPages === 0) totalPages = 1;
          if(currentPage > totalPages) currentPage = totalPages;
          let startIndex = (currentPage - 1) * contactsPerPage;
          let paginated = filtered.slice(startIndex, startIndex + contactsPerPage);
          
          // Mise à jour du tableau
          tableBody.innerHTML = "";
          if(paginated.length === 0){
              let row = document.createElement('tr');
              let td = document.createElement('td');
              td.colSpan = 6;
              td.textContent = "Aucun contact trouvé.";
              row.appendChild(td);
              tableBody.appendChild(row);
          } else {
              paginated.forEach(contact => {
                  let row = document.createElement('tr');
                  row.innerHTML = `
                      <td>${contact.nom}</td>
                      <td>${contact.prenom}</td>
                      <td>${contact.email}</td>
                      <td>${contact.telephone}</td>
                      <td>${contact.categorie}</td>
                      <td>
                        <a href="/index.php?action=contact/details&id=${contact.id}" class="btn btn-view">Consulter</a>
                        <a href="/index.php?action=contact/update&id=${contact.id}" class="btn btn-edit">Modifier</a>
                      </td>
                  `;
                  tableBody.appendChild(row);
              });
          }
          
          // Mise à jour de la pagination
          updatePagination(totalPages);
      }
      
      function updatePagination(totalPages){
          paginationDiv.innerHTML = "";
          if(totalPages <= 1) return;
          
          // Bouton Précédent
          if(currentPage > 1){
              let prev = document.createElement('a');
              prev.href = "#";
              prev.textContent = "Précédent";
              prev.classList.add('pagination-link');
              prev.addEventListener('click', function(e){
                  e.preventDefault();
                  currentPage--;
                  updateDisplay();
              });
              paginationDiv.appendChild(prev);
          }
          
          // Liens numériques
          for(let i = 1; i <= totalPages; i++){
              let link = document.createElement('a');
              link.href = "#";
              link.textContent = i;
              link.classList.add('pagination-link');
              if(i === currentPage) link.classList.add('active');
              link.addEventListener('click', function(e){
                  e.preventDefault();
                  currentPage = i;
                  updateDisplay();
              });
              paginationDiv.appendChild(link);
          }
          
          // Bouton Suivant
          if(currentPage < totalPages){
              let next = document.createElement('a');
              next.href = "#";
              next.textContent = "Suivant";
              next.classList.add('pagination-link');
              next.addEventListener('click', function(e){
                  e.preventDefault();
                  currentPage++;
                  updateDisplay();
              });
              paginationDiv.appendChild(next);
          }
      }
      
      // Initialisation de l'affichage
      updateDisplay();
  });
</script>

<?php
$content = ob_get_clean();
include 'views/template/template.view.php';
?>


