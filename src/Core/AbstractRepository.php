<?php
namespace App\Core;

use PDO;
use App\User\UserModel;

abstract class AbstractRepository
{
    protected PDO $pdo;

    /**
     * Konstruktor
     * @param PDO $pdo Die PDO-Instanz für die Datenbankverbindung.
     */
    // Dependence injection
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    abstract public function getTableName();
    abstract public function getModelName();

    // Protected kann ich nur dann aufrufen wenn die klasse AbstractRepository implementiert wird
    // executeQuery in der AbstractRepository-Klasse dient als Hilfsfunktion, um SQL-Abfragen auf der Datenbank auszuführen. 
    //$sql: Hier wird der SQL-Befehl (z. B. "SELECT * FROM users WHERE id = :id") als String übergeben.
    //$params: Dies ist ein optionales Array, das Platzhalterwerte für den SQL-Befehl enthält. Beispiel: ['id' => 1].
    protected function executeQuery($sql,$params = [])
    {
        //prepare erstellt ein vorbereitetes Statement und schützen vor SQL-Injections
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params); //vorbereitete Abfrage 
        return $stmt;
    }

    public function findAll()
    {
        $model = $this->getModelName();
        $table = $this->getTableName();
        $stmt = $this->pdo->query("SELECT * FROM `$table`");
        // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, $model); // Model aufrufen

        return $results;
    }

    // /**
    //  * Einen Benutzer anhand seiner ID abrufen.
    //  * @param int $id Die ID des Benutzers.
    //  * @return User|null Gibt das User-Objekt zurück oder null, wenn kein Benutzer gefunden wird.
    //  */
    public function findById(int $id) //: ?User "Objekt"
    {
        $model = $this->getModelName();
        $table = $this->getTableName();

        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, $model); // Model aufrufen
        $data = $stmt->fetch(); // Klasse erzeugen aber fetch braucht kein Parameter mehr. 

        if (!$data) {
            throw new Exception("Benutzer mit ID $id nicht gefunden");
        }

        return $data;
    }

    public function findByUsername($username)
    {
        $model = $this->getModelName();
        $table = $this->getTableName();
        $stmt = $this->pdo->query("SELECT * FROM $table WHERE name = :name");
        $stmt->execute(['name' => $username]);
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, $model); // Model aufrufen

        return $results;
    }

    // /**
    //  * Einen Benutzer anhand seiner E-Mail abrufen.
    //  * @param string $email Die E-Mail-Adresse des Benutzers.
    //  * @return User|null Gibt das User-Objekt zurück oder null, wenn kein Benutzer gefunden wird.
    //  */
    public function findByEmail(string $email) //: ?UserModel
    {
        $model = $this->getModelName();
        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE email = :email");
        $stmt->execute(['email' => $email]);
        // Info FETCH_ASSOC ist als Array, FETCH_CLASS ist als Model
        $stmt->setFetchMode(PDO::FETCH_CLASS, $model); // Daten als Objekt holen
        $data = $stmt->fetch(); // Gibt ein Objekt zurück oder false

        return $data ?: null; // Falls kein User gefunden, return null
    }

    // /**
    //  * Einen Benutzer speichern oder aktualisieren.
    //  * Wenn das User-Objekt eine ID hat, wird ein Update durchgeführt.
    //  * Ansonsten wird ein neuer Datensatz eingefügt.
    //  * @param User $user Das User-Objekt, das gespeichert werden soll.
    //  * @return bool Gibt true zurück, wenn der Vorgang erfolgreich war, andernfalls false.
    //  */

    // Email exist Methode. Gibt es schon einen anderen Benutzer mit dieser E-Mail?
    public function emailExists($email, $excludeUserId = null): bool
    {
        // SQL-Abfrage überprüft, ob eine andere Benutzer-ID die E-Mail-Adresse hat (außer der aktuellen Benutzer-ID):
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        
        // Wenn eine Benutzer-ID zum Ausschließen übergeben wurde, schließe diesen Benutzer aus der Suche aus.
        if ($excludeUserId) {
            $sql .= " AND id != :excludeUserId";
        }
    
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':email', $email);

        if ($excludeUserId) {
            $stmt->bindValue(':excludeUserId', $excludeUserId);
        }
    
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function save(UserModel $user): bool
    {
        $table = $this->getTableName();
        try
        {
            if ($user->id) {
                // Benutzer aktualisieren
                $stmt = $this->pdo->prepare("
                    UPDATE $table 
                    SET name = :name, , surname = :surname,email = :email,position = :position, 
                        team = :team, phone = :phone, avatar = :avatar, updated_at = CURRENT_TIMESTAMP
                    WHERE id = :id
                ");
                return $stmt->execute([
                    'id' => $user->id,
                    'name' => $user->name,
                    'surname' => $user->surname,
                    'email' => $user->email,
                    // 'role_id' => $user->role_id,
                    'position' => $user->position,
                    'team' => $user->team,
                    'phone' => $user->phone,
                    'avatar' => $user->avatar,
                ]);
            } else {
                // Neuen Benutzer einfügen
                $stmt = $this->pdo->prepare("
                INSERT INTO $table (name, email, password, position, team, phone, avatar, created_at) 
                VALUES (:name, :email, :password, :position, :team, :phone, :avatar, CURRENT_TIMESTAMP)
                ");
                return $stmt->execute([
                    'name' => $user->name,
                    'surname' => $user->surname,
                    'email' => $user->email,
                    'password' => $user->password, // Hashwert speichern
                    'position' => $user->position,
                    'team' => $user->team,
                    'phone' => $user->phone,
                    'avatar' => $user->avatar,
                ]);
            }
        }
        catch (Exception $e) {
            echo "Fehler: " . $e->getMessage();
            return false;
        }
    }

    public function saveSettings(UserModel $user)
    {
        // Überprüfen, ob eine gültige Benutzer-ID vorhanden ist
        if (!$user->id) {
            throw new \Exception("Benutzer-ID nicht vorhanden. Update fehlgeschlagen.");
        }
        // Erstellung der SQL-Query
        $sql = "UPDATE users SET name = :name, surname = :surname, email = :email, phone = :phone WHERE id = :id";
        // SQL-Abfrage vorbereitet, Schutz vor SQL-Injection, weil die Werte später sicher über bindValue() eingefügt werden.
        $stmt = $this->pdo->prepare($sql);
        // Werte an die Platzhalter binden
        $stmt->bindValue(":name",$user->name);
        $stmt->bindValue(":surname",$user->surname);
        $stmt->bindValue(":email",$user->email);
        $stmt->bindValue(":phone",$user->phone);
        $stmt->bindValue(":id",$user->id);
        //Statement ausführen
        return $stmt->execute();
    }
        // /**
    //  * Einen Benutzer aus der Datenbank löschen.
    //  * @param int $id Die ID des Benutzers, der gelöscht werden soll.
    //  * @return bool Gibt true zurück, wenn der Benutzer erfolgreich gelöscht wurde.
    //  */
    public function delete(int $id): bool
    {
        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Suchmethode
    public function search($query)
    {
        $table = $this->getTableName();

        $sql = "SELECT * FROM  $table
                WHERE name LIKE :query
                OR surname LIKE :query
                OR email LIKE :query
                OR phone LIKE :query
                OR team LIKE :query
                OR position LIKE :query";

        $stmt = $this->pdo->prepare($sql);

         $stmt->execute(['query' => "%$query%"]); // % = Teilstringsuche

        return $stmt->fetchALL(\PDO::FETCH_CLASS,$this-> getModelName());
    }

    public function adminSearch($query)
    {
        $table = $this->getTableName();

        $sql = "SELECT * FROM  $table
                WHERE name LIKE :query
                OR surname LIKE :query
                OR email LIKE :query
                OR password LIKE :query
                OR phone LIKE :query
                OR team LIKE :query
                OR position LIKE :query";

        $stmt = $this->pdo->prepare($sql);

         $stmt->execute(['query' => "%$query%"]); // % = Teilstringsuche

        return $stmt->fetchALL(\PDO::FETCH_CLASS,$this-> getModelName());
    }
    
}