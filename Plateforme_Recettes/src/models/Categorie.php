<?php 

// Inclusions des fichiers
require_once __DIR__ . "/ConnexionDB.php";

class Categorie
{
    public static function GetIdsRecettesByCategorie($sql){
        return ConnexionDB::DbRun($sql)->fetchAll(PDO::FETCH_OBJ);
    } 

    public static function GetAllCategories(){
        $sql = "SELECT * FROM Categorie";

        return ConnexionDB::DbRun($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public static function AttributeCategorie($idRecette, $idCategorie){
       $sql = "INSERT INTO RecetteCategorie (idRecette, idCategorie) VALUES (?,?) ";
       $param = [$idRecette, $idCategorie];

       ConnexionDB::DbRun($sql, $param);
    } 
}
