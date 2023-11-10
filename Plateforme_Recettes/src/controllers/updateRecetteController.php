<?php

require_once __DIR__ . "/../models/Recette.php";
require_once __DIR__ . "/../models/Categorie.php";
require_once __DIR__ . "/../models/Ingredient.php";
require_once __DIR__ . "/../models/Etape.php";
require_once __DIR__ . "/../controllers/utilitaireController.php";

$idRecette = filter_input(INPUT_GET, "idRecette");

class UpdateRecetteController
{
    public static function UpdateRecette($idRecette, $titre, $tempsCuisson, $etapes, $selectedIngredients, $selectedCategories, $file)
    {

        $fileName = $file['name'];
        $fileName = RenameFileRandom($fileName);
        $file_tmp = $file['tmp_name'];

        $tmp = "assets/imgUpload/";

        $recette = Recette::GetRecetteById($idRecette);

        // Traitement de l'image (suppression précédente, ajout de la nouvelle)
        $oldfile_path = $tmp . $recette->cheminPhoto;
        if (file_exists($oldfile_path)) {
            if (unlink($oldfile_path)) {
                move_uploaded_file($file_tmp, $tmp . $fileName);
            }
        }

        // Récupérer les catégories et ingrédients associés à la recette avant la mise à jour
        $anciennesCategories = Categorie::GetCategoriesOfRecette($idRecette);
        $anciensIngredients = Ingredient::GetAllIngredientsOfRecette($idRecette);

        // Identifier les nouvelles catégories et supprimer les anciennes non cochées
        $categoriesToAdd = [];
        $categoriesToRemove = [];

        foreach ($selectedCategories as $newCategoryId) {

            $categorie_is_selected = false;
                        
            foreach ($anciennesCategories as $ancienneCategorie) {
                
                if ($ancienneCategorie->idCategorie == $newCategoryId) {
                    $categorie_is_selected = true;
                    break;
                }
            }

            if (!$categorie_is_selected) {
                $categoriesToAdd[] = $newCategoryId;
            }
        }


        foreach ($anciennesCategories as $oldCategoryId) {
            $categorie_is_selected = false;
            foreach ($selectedCategories as $selectedCategorie) {
                if ($selectedCategorie == $oldCategoryId) {
                    $categorie_is_selected = true;
                    break;
                }
            }
            if (!$categorie_is_selected) {
                $categoriesToRemove[] = $oldCategoryId;
            }
        }

        // Identifier les nouveaux ingrédients et supprimer les anciens non cochés
        $ingredientsToAdd = [];
        $ingredientsToRemove = [];

        foreach ($selectedIngredients as $newIngredientId) {
            $ingredient_is_selected = false;
            foreach ($anciensIngredients as $ancienIngredient) {
                if ($ancienIngredient->idIngredient == $newIngredientId) {
                    $ingredient_is_selected = true;
                    break;
                }
            }

            if (!$ingredient_is_selected) {
                $ingredientsToAdd[] = $newIngredientId;
            }
        }

        foreach ($anciensIngredients as $oldIngredientId) {
            $ingredient_is_selected = false;
            foreach ($selectedIngredients as $selectedIngredient) {
                if ($selectedIngredient == $oldIngredientId) {
                    $ingredient_is_selected = true;
                    break;
                }
            }
            if (!$ingredient_is_selected) {
                $ingredientsToRemove[] = $oldIngredientId;
            }
        }


        try {
            ConnexionDB::Db()->beginTransaction();

            // Mettre à jour la base de données avec les nouvelles associations
            foreach ($categoriesToAdd as $newCategoryId) {
                
                Categorie::AttributeCategorie($idRecette, $newCategoryId);
            }

            foreach ($categoriesToRemove as $oldCategoryId) {
                var_dump($oldCategoryId->idCategorie);
                Categorie::RemoveCategorieOfRecette($idRecette, $oldCategoryId->idCategorie);
            }

            foreach ($ingredientsToAdd as $newIngredientId) {
                Ingredient::AttributeIngredientForRecettes($idRecette, $newIngredientId);
            }

            foreach ($ingredientsToRemove as $oldIngredientId) {
                Ingredient::RemoveIngredientFromRecette($idRecette, $oldIngredientId->idIngredient);
            }

            // Modifie l'étape
            Etape::UpdateEtapeOfRecette($idRecette, $etapes);

            // Modifier la recette
            Recette::UpdateRecette($idRecette, $titre, $tempsCuisson, $fileName);

            ConnexionDB::Db()->commit();

            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            ConnexionDB::Db()->rollback();
            throw new Exception("Erreur lors de la modification de la recette. " . $e->getMessage());
        }
    }
}

if ($idRecette != null) {
    $old_recette = Recette::GetRecetteById($idRecette);
    $old_etapes = Etape::GetEtapesOfRecette($idRecette);
    require_once __DIR__ . "/../views/updateRecette.php";
} else {
    header("Location: index.php");
    exit;
}
