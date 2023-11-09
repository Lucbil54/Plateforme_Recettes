<?php

require_once __DIR__ . "/../models/Recette.php";
require_once __DIR__ . "/../models/Categorie.php";
require_once __DIR__ . "/../models/Ingredient.php";
require_once __DIR__ . "/../models/Etape.php";

session_destroy();

class HomeController{
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
        $recettes = Recette::GetRecettesRecently();
        
        $this->setRecettes($recettes);
    }

    public function DisplayRecettesRecently(){
        $recettes = $this->getRecettes();
        
        $output = "";

        foreach ($recettes as $recette) {
            $idRecette = $recette["idRecette"];
            $titre = $recette["titre"];
            $etapes = Etape::GetEtapesOfRecette($idRecette);
            $etapes = $etapes->description;
            $image = $recette["cheminPhoto"];

            $output .=  "<div class='single-hero-slide bg-img' style='background-image: url(assets/imgUpload/$image);'>
            <div class='container h-100'>
                <div class='row h-100 align-items-center'>
                    <div class='col-12 col-md-9 col-lg-7 col-xl-6'>
                        <div class='hero-slides-content' data-animation='fadeInUp' data-delay='100ms'>
                            <h2 data-animation='fadeInUp' data-delay='300ms'>$titre</h2>
                            <p data-animation='fadeInUp' data-delay='700ms'>$etapes</p>
                            <a href='index.php?page=viewRecette&idRecette=$idRecette' class='btn delicious-btn' data-animation='fadeInUp' data-delay='1000ms'>See Receipe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }

        return $output;
    }


}

require_once "../src/views/home.php";
?>