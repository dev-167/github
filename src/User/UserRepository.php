<?php
// Repository = Ansteuern von Daten
namespace App\User;

use App\Core\AbstractRepository;
use App\Model\UserModel;
use PDO;
use Exception;

// Debugging AbsractRepository 
if (!class_exists(\App\Core\AbstractRepository::class)) {
    die("AbstractRepository konnte nicht gefunden werden.");
}

class UserRepository extends AbstractRepository
{
    /**
     * Alle Benutzer aus der Datenbank abrufen.
     * @return User[] Gibt ein Array von User-Objekten zurück.
     */
    // Tabelle ist variabel
    public function getTableName()
    {
        return "users";
    }
    // Model ist variabel
    public function getModelName()
    {
        return "App\\User\\UserModel";
    }

    public function findByUsername($username)
    {
        try{
            $model = $this->getModelName();
            $table = $this->getTableName();
            $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE name = :name");
            $stmt->execute(['name' => $username]);
            $stmt->setFetchMode(PDO::FETCH_CLASS,$model); // Model aufrufen
            // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $results = $stmt->fetch(PDO::FETCH_CLASS);

            // if(!results){
            //     return null; // Oder werfen Sie eine Ausnahme
            // }

        return $results;
        }catch(PDOException $e){
            // Loggen Sie den Fehler oder werfen Sie eine benutzerdefinierte Ausnahme
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    
    
 
    ////////////////////////////TEST////////////////////////////
    public function exception()
    {
        $data = throw new Exception("Dies ist eine Testausnahme aus UserRepository->exception()");
    }
    ////////////////////////////TEST////////////////////////////
}