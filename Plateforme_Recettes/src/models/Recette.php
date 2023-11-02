<?php 

// Inclusions des fichiers
require_once __DIR__ . "/ConnexionDB.php";

class Recette
{
    public static function GetRecetteById($idRecette){
        $sql = "SELECT * FROM Recette WHERE idRecette = :idRecette";

        $param = ["idRecette" => $idRecette];

        return ConnexionDB::DbRun($sql, $param)->fetch(PDO::FETCH_OBJ);
    }

    public static function GetRecettes($sql){
        return ConnexionDB::DbRun($sql)->fetchAll(PDO::FETCH_OBJ);
    } 

    public static function AddRecette($titre, $tempsCuisson, $image, $idCategorie){

    }
}
