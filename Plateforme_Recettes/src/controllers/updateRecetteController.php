<?php

require_once __DIR__ . "/../models/Recette.php";
require_once __DIR__ . "/../models/Categorie.php";
require_once __DIR__ . "/../models/Ingredient.php";
require_once __DIR__ . "/../models/Etape.php";
require_once __DIR__ . "/../controllers/utilitaireController.php"; 

$idRecette = filter_input(INPUT_GET, "idRecette");

class UpdateRecetteController{
    public static function UpdateRecette($idRecette, $titre, $tempsCuisson, $etapes, $ingredients, $categories, $file){
        
        $fileName = $file['name'];
        $fileName = RenameFileRandom($fileName);
        $file_tmp = $file['tmp_name'];
        
        $tmp = "assets/imgUpload/";

        $recette = Recette::GetRecetteById($idRecette);

        // Traitement de l'image (suppression précédente, ajout de la nouvelle)
        $oldfile_path = $tmp . $recette->cheminPhoto;
        if(unlink($oldfile_path)){
            move_uploaded_file($file_tmp, $tmp . $fileName);
        }

        try{
            ConnexionDB::Db()->beginTransaction();

            // Créé la recette
            Recette::UpdateRecette($idRecette, $titre, $tempsCuisson, $fileName);
    
            // Attribue les catégories
            foreach ($categories as $idCategorie) {
                Categorie::AttributeCategorie($idRecette, $idCategorie);    
            }

            // Attribue l'étape
            Etape::AttributeEtape($idRecette, $etapes);
            
            // Attribue les différents ingrédients
            foreach ($ingredients as $idIngredient) {
                Ingredient::AttributeIngredientForRecettes($idIngredient, $idRecette);
            }
            
            ConnexionDB::Db()->commit();
            
            header("Location: index.php");
            exit;
        }
        catch (Exception $e) {
            ConnexionDB::Db()->rollback();
            throw new Exception("Erreur lors de la création de la recette. " . $e);
        }
        
    }
}

if ($idRecette != null) {
    $old_recette = Recette::GetRecetteById($idRecette);
    $old_etapes = Etape::GetEtapesOfRecette($idRecette);
    require_once __DIR__ . "/../views/updateRecette.php";
}
else{
    header("Location: index.php");
    exit;
}

?>