<?php 


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $action = $_GET['action'] ?? 'home';
    $action = trim($action, '/');


    switch ($action) {

        case 'home':
            require 'views/home.php';
        break;
        case 'contact':
            require 'views/contact.view.php';
        break;
        case 'register':
            require 'controllers/AuthController.php';
            $auth = new AuthController();
            $auth->register();
        break;
        case 'login':
            require 'controllers/AuthController.php';
            $auth = new AuthController();
            $auth->login();
        break;
        case 'reset':
            require 'views/auth/reset.php';
        break;
        case 'export' :
            require 'views/auth/export.php';
        break;
        case 'archive':
            require 'views/auth/archivedContact.php';
        break;
        case 'assistance':
            require 'views/auth/assistance.php';
        break;
        case 'contact/add':
            require 'views/methods/addContact.php';
        break;
        case 'contact/update':
            require 'views/methods/updateContact.php';
        break;
        case 'manage':
            require 'views/methods/manageContact.php';
        break;
        case 'contact/details':
            require 'views/methods/contactDetails.php';
        break;
        case 'logout':
            require 'controllers/AuthController.php';
            $auth = new AuthController();
            $auth->logout();
        break;
        
        default: http_response_code(404); echo 'Not Found !';

    }