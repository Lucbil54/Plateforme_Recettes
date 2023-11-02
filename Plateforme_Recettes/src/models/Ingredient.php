<?php 

// Inclusions des fichiers
require_once __DIR__ . "/ConnexionDB.php";

class Recette
{
    public static function GetIngredientById($idIngredient){
        $sql = "SELECT * FROM Ingredient WHERE idIngredient = :idIngredient";

        $param = ["idIngredient" => $idIngredient];

        return ConnexionDB::DbRun($sql, $param)->fetch(PDO::FETCH_OBJ);
    }

    public static function GetAllIngredient(){
        $sql = "SELECT * FROM Ingredient";
        return ConnexionDB::DbRun($sql)->fetchAll(PDO::FETCH_OBJ);
    } 

    public static function AttributeIngredientForRecettes($idIngredient, $idRecette){
        $sql = "INSERT INTO RecetteIngredient (idRecette, idIngredient) VALUES (?,?) ";
       $param = [$idRecette, $idIngredient];

       ConnexionDB::DbRun($sql, $param);
    }
}
