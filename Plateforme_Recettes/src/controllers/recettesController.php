<?php

require_once __DIR__ . "/../models/Recette.php";
require_once __DIR__ . "/../models/Categorie.php";
require_once __DIR__ . "/../models/SessionManager.php";

class RecettesController
{
    private $recettes = [];

    public function getRecettes()
    {
        return $this->recettes;
    }

    public function setRecettes($arrRecettes)
    {
        $this->recettes = $arrRecettes;
    }

    public function __construct()
    {
        $this->Filters("", "");
    }

    public function Filters($search, $idCategorie)
    {
        $idRecettes = null;
        $sql = "SELECT * FROM Recette";

        if (!empty($search) || !empty($idCategorie)) {

            if (!empty($idCategorie)) {
                $sqlRequestCategorie = "SELECT idRecette FROM RecetteCategorie WHERE idCategorie = $idCategorie";

                $idRecettes = Categorie::GetIdsRecettesByCategorie($sqlRequestCategorie);
            }

            // Si la recherche est rempli, faire la recherche sur les recettes de la catégorie
            if (!empty($search)) {
                $sql .= " WHERE titre LIKE '%$search%'";
            }
        }

        // Appeler la fonction qui récupère les recettes
        $recettes = Recette::GetRecettes($sql);
        $arrRecette = [];
        if ($idRecettes != null && !empty($idCategorie) && empty($search)) {
            foreach ($idRecettes as $idRecette) {
                foreach ($recettes as $recette) {
                    if ($idRecette == $recette->idRecette) {
                        array_push($arrRecette, $recette);
                    }
                }
            }
        }
        else if(empty($idCategorie) ||!empty($search)){
            foreach ($recettes as $recette) {
                array_push($arrRecette, $recette);
            }
        }

        $this->setRecettes($arrRecette);
    }

    public function DisplayRecettes()
    {
        $recettes = $this->getRecettes();
        $output = "";
        
        if (count($recettes) > 0) {
            foreach ($recettes as $recette) {
                // Affichage des recettes
                $output .= "<div class='col-12 col-sm-6 col-lg-4'>
                <div class='single-best-receipe-area mb-30'>
                    <img style='height: 300px;' src='assets/imgUpload/$recette->cheminPhoto' alt=''>
                    <div class='receipe-content'>
                        <a href='index.php?page=viewRecette&idRecette=$recette->idRecette'>
                            <h5>$recette->titre</h5>
                        </a>
                    </div>
                </div>
            </div>";
            }
        } else {
            $output .= "Aucune recette trouvé.";
        }

        return $output;
    }
}


require_once "../src/views/recettes.php";
