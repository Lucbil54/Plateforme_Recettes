<?php

require_once __DIR__ . "/../models/Recette.php";
require_once __DIR__ . "/../models/Categorie.php";
require_once __DIR__ . "/../models/Ingredient.php";


function DisplaySelectMultipleCategories()
{
    $categories = Categorie::GetAllCategories();
    $selectHTML = "";

    if (count($categories) > 0) {

        $selectHTML = "<select class='nice-select' name='selectCategories[]' id='selectCategories' multiple>";

        foreach ($categories as $categorie) {
            $selectHTML .=  "<option value='$categorie->idCategorie'>$categorie->nom</option>";
        }

        $selectHTML .= "</select>";
    }

    return $selectHTML;
}

function DisplaySelectCategorie()
{
    $categories = Categorie::GetAllCategories();
    $selectHTML = "";

    if (count($categories) > 0) {

        $selectHTML = "<select class='nice-select' name='selectCategorie' id='selectCategorie'>";

        foreach ($categories as $categorie) {
            $selectHTML .=  "<option value='$categorie->idCategorie'>$categorie->nom</option>";
        }

        $selectHTML .= "</select>";
    }

    return $selectHTML;
}


function DisplaySelectedCategoriesOfRecette($idRecette)
{
    $categories = Categorie::GetAllCategories();
    $categoriesOfRecette = Categorie::GetCategoriesOfRecette($idRecette);

    $checkboxHTML = "";
    foreach ($categories as $categorie) {
        $selected = false;

        foreach ($categoriesOfRecette as $key => $idCategorie) {
            if ($categorie->idCategorie == $idCategorie->idCategorie) {
                $selected = true;
                break;
            }
        }


        $checkboxHTML .= "<div class='custom-control custom-checkbox'>";
        $checkboxHTML .= "<input type='checkbox' class='custom-control-input' id='checkboxIngredient_$categorie->idCategorie'name='selectIngredients[]' value='$categorie->idCategorie'";

        if ($selected) {
            $checkboxHTML .= " checked";
        }

        $checkboxHTML .= ">";
        $checkboxHTML .= "<label class='custom-control-label' for='checkboxIngredient_$categorie->idCategorie'>$categorie->nom</label>";
        $checkboxHTML .= "</div>";
    }

    return $checkboxHTML;
}


function DisplaySelectedIngredientsOfRecette($idRecette)
{
    $ingredients = Ingredient::GetAllIngredients();
    $ingredientsOfRecette = Ingredient::GetAllIngredientsOfRecette($idRecette);

    $checkboxHTML = "";

    foreach ($ingredients as $ingredient) {
        $selected = false;

        foreach ($ingredientsOfRecette as $key => $idIngredient) {
            if ($ingredient->idIngredient == $idIngredient->idIngredient) {
                $selected = true;
                break;
            }
        }


        $checkboxHTML .= "<div class='custom-control custom-checkbox'>";
        $checkboxHTML .= "<input type='checkbox' class='custom-control-input' id='checkboxIngredient_$ingredient->idIngredient'name='selectIngredients[]' value='$ingredient->idIngredient'";

        if ($selected) {
            $checkboxHTML .= " checked";
        }

        $checkboxHTML .= ">";
        $checkboxHTML .= "<label class='custom-control-label' for='checkboxIngredient_$ingredient->idIngredient'>$ingredient->nom</label>";
        $checkboxHTML .= "</div>";
    }

    return $checkboxHTML;
}

function DisplaySelectMutipleIngredients()
{
    $ingredients = Ingredient::GetAllIngredients();
    $selectHTML = "";

    if (count($ingredients) > 0) {

        $selectHTML = "<select class='nice-select' name='selectIngredients[]' id='selectIngredients' multiple>";
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
