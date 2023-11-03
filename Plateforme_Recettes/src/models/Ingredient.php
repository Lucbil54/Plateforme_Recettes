<?php 

// Inclusions des fichiers
require_once __DIR__ . "/ConnexionDB.php";

class Ingredient
{
    public static function GetIngredientById($idIngredient){
        $sql = "SELECT * FROM Ingredient WHERE idIngredient = :idIngredient";

        $param = ["idIngredient" => $idIngredient];

        return ConnexionDB::DbRun($sql, $param)->fetch(PDO::FETCH_OBJ);
    }

    public static function GetAllIngredients(){
        $sql = "SELECT * FROM Ingredient";
        return ConnexionDB::DbRun($sql)->fetchAll(PDO::FETCH_OBJ);
    } 

    public static function AttributeIngredientForRecettes($idIngredient, $idRecette){
        $sql = "INSERT INTO RecetteIngredient (idRecette, idIngredient) VALUES (?,?) ";
       $param = [$idRecette, $idIngredient];

       ConnexionDB::DbRun($sql, $param);
    }

    public static function GetAllIngredientsOfRecette($idRecette){
        $sql = "SELECT idIngredient FROM RecetteIngredient WHERE idRecette = :idRecette";
        $param = [":idRecette" => $idRecette];
        return ConnexionDB::DbRun($sql, $param)->fetchAll(PDO::FETCH_OBJ);
    } 
}
