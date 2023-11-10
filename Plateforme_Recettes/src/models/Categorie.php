<?php 

// Inclusions des fichiers
require_once __DIR__ . "/ConnexionDB.php";

class Categorie
{
    public static function GetIdsRecettesByCategorie($sql){
        $result = ConnexionDB::DbRun($sql)->rowCount();
        return $result == 1 ? ConnexionDB::DbRun($sql)->fetch(PDO::FETCH_OBJ) : ConnexionDB::DbRun($sql)->fetchAll(PDO::FETCH_OBJ);
    } 

    public static function GetAllCategories(){
        $sql = "SELECT * FROM Categorie";

        return ConnexionDB::DbRun($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public static function GetCategoriesOfRecette($idRecette){
        $sql = "SELECT idCategorie FROM RecetteCategorie WHERE idRecette = ?";

        $param = [$idRecette];

        return ConnexionDB::DbRun($sql, $param)->fetchAll(PDO::FETCH_OBJ);
    }

    public static function AttributeCategorie($idRecette, $idCategorie){
       $sql = "INSERT INTO RecetteCategorie (idRecette, idCategorie) VALUES (?,?) ";
       $param = [$idRecette, $idCategorie];

       ConnexionDB::DbRun($sql, $param);
    } 

    public static function RemoveCategorieOfRecette($idRecette, $idCategorie){
        $sql = "DELETE FROM RecetteCategorie WHERE idRecette = :idRecette AND idCategorie = :idCategorie";
        $param = [":idRecette" => $idRecette, ":idCategorie" => $idCategorie];
 
        ConnexionDB::DbRun($sql, $param);
    }

    public static function RemoveAllCategoriesOfRecette($idRecette){
        $sql = "DELETE FROM RecetteCategorie WHERE idRecette = :idRecette";
        $param = [":idRecette" => $idRecette];
 
        ConnexionDB::DbRun($sql, $param);
    }
}
