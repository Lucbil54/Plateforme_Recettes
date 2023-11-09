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

    public static function AddRecette($titre, $tempsCuisson, $image){
        $sql = "INSERT INTO Recette (titre, tempsCuisson, cheminPhoto) VALUES (?,?,?) ";
        $param = [$titre, $tempsCuisson, $image];
 
        ConnexionDB::DbRun($sql, $param);
    }

    public static function GetRecettesRecently(){
        $sql = "SELECT * FROM Recette ORDER BY idRecette DESC LIMIT 3";

        return ConnexionDB::DbRun($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function DeleteRecette($idRecette, $img){
        $sql = "DELETE FROM Recette WHERE idRecette = :idRecette";
        $param = [":idRecette" => $idRecette];
        
        if (unlink($img)) {
            ConnexionDB::DbRun($sql, $param);
        }
        
    }

    public static function UpdateRecette($idRecette, $titre, $tempsCuisson, $image){
        $sql = "UPDATE Recette SET titre = :titre, tempsCuisson = :tempsCuisson, cheminPhoto = :cheminPhoto WHERE idRecette = :idRecette";
        $param = [":titre" => $titre, ":tempsCuisson" => $tempsCuisson, ":cheminPhoto" => $image, ":idRecette" => $idRecette];
 
        ConnexionDB::DbRun($sql, $param);
    }

    
}
