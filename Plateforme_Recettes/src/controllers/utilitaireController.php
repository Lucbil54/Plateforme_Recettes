<?php

require_once __DIR__ . "/../models/Recette.php";
require_once __DIR__ . "/../models/Categorie.php";


function DisplaySelectCategories()
{
    $categories = Categorie::GetAllCategories();

    $selectHTML = "";

    if (count($categories) > 0) {

        $selectHTML = "<select name='selectCategories' id='selectCategories'>";

        foreach ($$categories as $categorie) {
            $selectHTML .=  "<option value='$categorie->idCategorie'>$categorie->nom</option>";
        }

        $selectHTML .= "</select>";
    }

    return $selectHTML;
}
