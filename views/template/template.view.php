
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo !empty($headTitle) ? $headTitle : "AddressVault"; ?></title>
    <meta name="description" content="A simple contact App">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="public/images/shortcut.jpg" type="image/x-icon">
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="public/css/search.css">
    <link rel="stylesheet" href="public/css/dropdown.css">
  </head>
  <body>         
    <header>
      <span class="app-logo"><span class="first-letter">Address</span>Vault</span>
      <nav class="navigation">
        <a href="index.php?action=home" class="nav-link">Home</a>
        <a href="index.php?action=contact" class="nav-link">Contacts</a> 
        <a href="index.php?action=manage" class="nav-link">Manage</a>
        <a href="index.php?action=favorites" class="nav-link">Favorites</a>
        <a href="index.php?action=assistance" class="nav-link">Assistance</a>
      </nav>
      <div class="settings">
        <!-- <div class="active-option" onmouseover="showDropDown()" onclick="subHideDropDown()" onmouseout="hideDropDown()"> -->
        <div class="active-option" onclick="showDropDown()"  onmouseout="hideDropDown()">
          <img src="public/images/icon-settings.svg" alt="setting" title="settings" class="setting">
          <p>Options</p>
        </div>
        <div class="options hidden" title="user-options">                            
          <a href="index.php?action=profile" onclick="subHideDropDown()"><hob class="option" title="Profile user" >Archived</p></a>
          <a href="index.php?action=logout" onclick="subHideDropDown()"><p class="option" title="Logout" >Logout</p></a>
        </div>                
      </div>
    </header>

      <!-- <main class="container">        -->

        <?= isset($title) ? $title : '' ?>     
        <?= $content ?>

      <!-- </main> -->

      <footer>
          <p class="markdown">© 2025 AddressVault  all rights reserved.</p>
      </footer>
      <script src="public/js/main.js" async defer></script>
    </body>
</html>

