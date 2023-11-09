<?php

session_start();

if (empty($_GET['page'])) {
    $page = "home";
} else {
    $page = $_GET['page'];
}

switch ($page) {
    case 'home':
        require_once(__DIR__ . "/../src/controllers/homeController.php");
        break;
    case 'recettes':
        require_once(__DIR__ . "/../src/controllers/recettesController.php");
        break;
    case 'createRecette':
        require_once(__DIR__ . "/../src/controllers/createRecetteController.php");
        break;
    case 'viewRecette':
        require_once(__DIR__ . "/../src/controllers/viewRecetteController.php");
        break;
    case 'updateRecette':
        require_once(__DIR__ . "/../src/controllers/updateRecetteController.php");
        break;
    default:
        require_once(__DIR__ . "/../src/controllers/homeController.php");
        break;
}
