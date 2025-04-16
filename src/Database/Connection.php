<?php
// Fehlerreporting
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
#####################################
// Wichtiger Hinweis:
// In einer produktiven Umgebung solltest du die Fehleranzeige deaktivieren (ini_set('display_errors', 0);), da sensible Informationen wie Datenbankanmeldeinformationen in Fehlermeldungen enthalten sein könnten.
#####################################

namespace app\Database;

class Connection
{
    protected static $pdo;
    //PHPDoc-Kommentar  :  
        /**
     * Stellt eine Verbindung zur Datenbank her und gibt eine PDO-Instanz zurück.
     *
     * @return \PDO
     * @throws \PDOException Wenn die Verbindung fehlschlägt.
     */

    // Es gibt nur eine Kopie dieser Eigenschaft oder Methode, egal wie viele Objekte (Instanzen) der Klasse erstellt werden.
    public static function connect()
    {
        // Das Schlüsselwort self:: in PHP wird verwendet, um auf statische Eigenschaften oder statische Methoden einer Klasse innerhalb derselben Klasse zuzugreifen. Es ist vergleichbar mit this, aber für die Klasse anstelle von einer Instanz.
        if(!self::$pdo)
        {
            $config = require __DIR__ . '/../../config/database.php';
            try
            {
                self::$pdo = new \PDO(
                    "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}",
                        $config['username'],
                        $config['password'],
                        [
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION // Fehler als Exception werfen
                        ]
                    );
            }catch(\PDOException $e){
                throw new \RuntimeException("Database connection failed: " . $e->getMessage(), 0, $e);
            }
        }
        return self::$pdo;
    }
}

?>