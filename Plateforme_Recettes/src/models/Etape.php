<?php

// Inclusions des fichiers
require_once __DIR__ . "/ConnexionDB.php";

class Etape
{
    public static function GetEtapesOfRecette($idRecette)
    {
        $sql = "SELECT description FROM Etape WHERE idRecette = :idRecette LIMIT 1";
        $param = [":idRecette" => $idRecette];
        return ConnexionDB::DbRun($sql, $param)->fetch(PDO::FETCH_OBJ);
    }

    public static function AttributeEtape($idRecette, $description)
    {
        $sql = "INSERT INTO Etape (description, idRecette) VALUES (?,?) ";
        $param = [$description, $idRecette];

        ConnexionDB::DbRun($sql, $param);
    }

    public static function UpdateEtapeOfRecette($idRecette, $newEtape)
    {
        $sql = "UPDATE Etape SET description = :description WHERE idRecette = :idRecette ";
        $param = [":description" => $newEtape, ":idRecette" => $idRecette];

        ConnexionDB::DbRun($sql, $param);
    }

    public static function DeleteEtapesOfRecette($idRecette)
    {
        $sql = "DELETE FROM Etape WHERE idRecette = :idRecette ";
        $param = [":idRecette" => $idRecette];

        ConnexionDB::DbRun($sql, $param);
    }
}
