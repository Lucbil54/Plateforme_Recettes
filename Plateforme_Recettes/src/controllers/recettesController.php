<?php

require_once __DIR__ . "/../models/Recette.php";
require_once __DIR__ . "/../models/Categorie.php";


class RecettesController
{

    private $recettes = [];

    public function getRecettes()
    {
        return $this->recettes;
    }

    public function setRecettes($recettes)
    {
        $this->recettes = $recettes;
    }


    public function __construct()
    {
        $this->Filters("", "");
    }

    public function Filters($search, $idCategorie)
    {
        $idRecettes = null;
        $sql = "SELECT * FROM Recette";

        if ($search != "" || $idCategorie != "") {

            if ($idCategorie != "") {
                $sqlRequestCategorie = "SELECT idRecette FROM RecetteCategorie WHERE idCategorie = idCategorie";

                $idRecettes = Categorie::GetIdsRecettesByCategorie($sqlRequestCategorie);
            }

            // Si la recherche est rempli, faire la recherche sur les recettes de la catégorie
            if ($search != "") {
                $sql .= " WHERE titre LIKE '%$search%'";
            }
        }

        // Appeler la fonction qui récupère les recettes
        $recettes = Recette::GetRecettes($sql);
        
        $arrRecette = [];
        if ($idRecettes != null) {
            foreach ($idRecettes as $idRecette) {
                foreach ($recettes as $recette) {
                    if ($idRecette == $recette->idRecette) {
                        array_push($arrRecette, $recette);
                    }
                }
            }
        }

        $this->setRecettes($arrRecette);
    }

    public function DisplayRecettes()
    {
        $recettes = $this->getRecettes();

        if (count($recettes) > 0) {


            foreach ($recettes as $recette) {
                // Affichage des recettes
            }
        } else {
            return "Aucune recette trouvé.";
        }
    }

    public function DisplayOneRecette(){

    }
}


require_once "../src/views/recettes.php";
