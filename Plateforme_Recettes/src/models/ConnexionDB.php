<?php
/**
 * Class pour la connexion à la base de données
 *
 * Billegas Lucas
 * 02.11.2023
 */

require_once __DIR__ . "/../config.php";

class ConnexionDB 
{
    /**
     * Connexion à la base de données 
     */
    public static function Db()
    {

        static $pdo = null;

        if ($pdo == null) {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";

            $pdo = new PDO($dsn, DB_USER, DB_PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        return $pdo;
    }
    
    /**
     * Execute la requête
     * 
     * @param string $sql Requete sql
     * @param string $param Les différents paramètres de la requete 
     */
    public static function DbRun($sql, $param = null)
    {
        $statement = self::Db()->prepare($sql);

        $result = $statement->execute($param);

        return $statement;
    }
}
