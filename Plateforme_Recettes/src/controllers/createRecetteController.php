<?php

require_once __DIR__ . "/../models/Recette.php";
require_once __DIR__ . "/../models/Categorie.php";
require_once __DIR__ . "/../models/Ingredient.php";
require_once __DIR__ . "/../models/Etape.php";
require_once __DIR__ . "/../controllers/utilitaireController.php"; 


class CreateRecetteController{
    public static function CreateRecette($titre, $tempsCuisson, $etapes, $ingredients, $idCategorie, $file){
        
        $fileName = $file['name'];
        $fileName = RenameFileRandom($fileName);
        $file_tmp = $file['tmp_name'];
        
        move_uploaded_file($file_tmp, "assets/imgUpload/" . $fileName);

        try{
            ConnexionDB::Db()->beginTransaction();

            // Créé la recette
            Recette::AddRecette($titre, $tempsCuisson, $fileName);
            $idRecette = ConnexionDB::Db()->lastInsertId();
    
            // Attribue la catégorie
            Categorie::AttributeCategorie($idRecette, $idCategorie);

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


require_once "../src/views/createRecette.php";
?>