<?php

require_once __DIR__ . "/../models/Recette.php";
require_once __DIR__ . "/../models/Categorie.php";
require_once __DIR__ . "/../models/Ingredient.php";
require_once __DIR__ . "/../models/Etape.php";
require_once __DIR__ . "/../controllers/utilitaireController.php";

$idRecette = filter_input(INPUT_GET, "idRecette");

if (isset($idRecette)) {
    $recette = Recette::GetRecetteById($idRecette);
    $ingredients = Ingredient::GetAllIngredientsOfRecette($idRecette);

    $displayIngredients = DisplayIngredients($ingredients);

    $tempsCuisson = new DateTime($recette->tempsCuisson);

    $etapes = Etape::GetEtapesOfRecette($idRecette);

    $btnDelete = filter_input(INPUT_POST, "btnDelete");
    $btnUpdate = filter_input(INPUT_POST, "btnUpdate");

    if (isset($btnDelete)) {
        Recette::DeleteRecette($idRecette, "assets/imgUpload/" . $recette->cheminPhoto);
        header("Location: index.php");
        exit;
    }

    if (isset($btnUpdate)) {
        header("Location: index.php?page=updateRecette&idRecette=" . $idRecette);
        exit;
    }

    require_once "../src/views/viewRecette.php";
} else {
    header("Location: index.php");
    exit;
}

function DisplayIngredients($ingredients)
{
    $output = "";
    $nbIngredient = 0;
    foreach ($ingredients as $idIngredient) {
        $nbIngredient++;
        $ingredient = Ingredient::GetIngredientById($idIngredient->idIngredient);
        $output .= "
        <div class='custom-control custom-checkbox'>
            <input type='checkbox' class='custom-control-input' id='customCheck" . $nbIngredient . "'>
            <label class='custom-control-label' for='customCheck" . $nbIngredient . "'>$ingredient->nom</label>
        </div>";
    }

    return $output;
}
