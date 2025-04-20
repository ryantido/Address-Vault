function showDropDown(){
    const dropdown = document.querySelector(".options");
    dropdown.classList.remove("hidden")
    dropdown.classList.add("show")
}

function hideDropDown(){
    const dropdown = document.querySelector(".options");
    setTimeout(() => {
        dropdown.classList.add("hidden")
        dropdown.classList.remove("show")
    },3750);
}

function subHideDropDown(){
    const dropdown = document.querySelector(".options"); 
    dropdown.classList.add("hidden")
    dropdown.classList.remove("show")
}

document.addEventListener("DOMContentLoaded", function(){
    const searchInput = document.getElementById('contactSearch');
    const filterButton = document.getElementById('filterButton');
    const filterOptions = document.getElementById('filterOptions');
    const sortButton = document.getElementById('sortButton');
    const sortOptions = document.getElementById('sortOptions');
    const tableBody = document.getElementById('contactTableBody');
    
    let currentFilter = 'all';
    let currentSort = '';

    // Gestion de l'affichage des dropdowns
    filterButton.addEventListener('click', function(e){
       filterOptions.classList.toggle('hidden');
    });
    sortButton.addEventListener('click', function(e){
       sortOptions.classList.toggle('hidden');
    });
    
    // Sélection d'une option de filtre
    filterOptions.querySelectorAll('a').forEach(option => {
       option.addEventListener('click', function(e){
          e.preventDefault();
          currentFilter = this.getAttribute('data-filter');
          filterOptions.classList.add('hidden');
          updateTable();
       });
    });
    
    // Sélection d'une option de tri
    sortOptions.querySelectorAll('a').forEach(option => {
       option.addEventListener('click', function(e){
          e.preventDefault();
          currentSort = this.getAttribute('data-sort');
          sortOptions.classList.add('hidden');
          updateTable();
       });
    });
    
    // Mise à jour de l'affichage lors de la saisie
    searchInput.addEventListener('keyup', updateTable);
    
    function updateTable(){
       const searchTerm = searchInput.value.trim().toLowerCase();
       const rows = Array.from(tableBody.querySelectorAll('tr.contact-row'));
       let visibleCount = 0;
       
       // Filtrage des lignes en fonction de la recherche et du filtre par catégorie
       rows.forEach(row => {
          const fullText = row.textContent.toLowerCase();
          const category = row.querySelector('.contact-category').textContent.toLowerCase();
          
          const matchesSearch = searchTerm === "" || fullText.includes(searchTerm);
          const matchesFilter = (currentFilter === 'all' || category === currentFilter);
          
          if(matchesSearch && matchesFilter){
             row.style.display = "";
             visibleCount++;
          } else {
             row.style.display = "none";
          }
       });
       
       // Tri des lignes
       if(currentSort){
          let visibleRows = rows.filter(row => row.style.display !== "none");
          visibleRows.sort((a, b) => {
             const aVal = a.querySelector(`.contact-${currentSort}`).textContent.toLowerCase();
             const bVal = b.querySelector(`.contact-${currentSort}`).textContent.toLowerCase();
             return aVal.localeCompare(bVal);
          });
          
          visibleRows.forEach(row => tableBody.appendChild(row));
       }
       
       let notFoundRow = document.getElementById('notFoundRow');
       if(visibleCount === 0){
          if(!notFoundRow){
             notFoundRow = document.createElement('tr');
             notFoundRow.id = 'notFoundRow';
             const td = document.createElement('td');
             td.colSpan = 6;
             td.textContent = 'Aucun contact trouvé.';
             notFoundRow.appendChild(td);
             tableBody.appendChild(notFoundRow);
          } else {
             notFoundRow.style.display = "";
          }
       } else {
          if(notFoundRow) notFoundRow.style.display = "none";
       }
    }
});

