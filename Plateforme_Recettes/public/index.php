<?php

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
    default:
        require_once(__DIR__ . "/../src/controllers/homeController.php");
        break;
}
