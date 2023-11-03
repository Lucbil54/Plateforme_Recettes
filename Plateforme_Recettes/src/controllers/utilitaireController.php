<?php

require_once __DIR__ . "/../models/Recette.php";
require_once __DIR__ . "/../models/Categorie.php";
require_once __DIR__ . "/../models/Ingredient.php";


function DisplaySelectCategories()
{
    $categories = Categorie::GetAllCategories();
    $selectHTML = "";

    if (count($categories) > 0) {

        $selectHTML = "<select name='selectCategories' id='selectCategories'>";

        foreach ($categories as $categorie) {
            $selectHTML .=  "<option value='$categorie->idCategorie'>$categorie->nom</option>";
        }

        $selectHTML .= "</select>";
    }

    return $selectHTML;
}

function DisplaySelectMutipleIngredients()
{
    $ingredients = Ingredient::GetAllIngredients();
    $selectHTML = "";

    if (count($ingredients) > 0) {

        $selectHTML = "<select name='selectIngredients[]' id='selectIngredients' multiple>";
        $firstSelected = true;
        foreach ($ingredients as $ingredient) {
            if ($firstSelected) {
                $selectHTML .=  "<option value='$ingredient->idIngredient' selected>$ingredient->nom</option>";
                $firstSelected = false;
            } else {
                $selectHTML .=  "<option value='$ingredient->idIngredient'>$ingredient->nom</option>";
            }
        }

        $selectHTML .= "</select>";
    }

    return $selectHTML;
}


function RenameFileRandom($file_name)
{
    $newName = explode('.', $file_name)[0];
    $extension = explode('.', $file_name)[1];

    $newName = uniqid($newName);

    $newName .= "." . $extension;
    return $newName;
}
