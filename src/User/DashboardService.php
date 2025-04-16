<?php

namespace App\User;


class DashboardService
{

    private $userRepository;

    // Der login service hat zugriff auf unsere Datenbank mit dem Parameter userRepository
    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;

    }
    
    public function saveSettings(UserModel $user)
    {
        // Sicherstellen, dass die Benutzer-ID vorhanden ist
        if (!$user->id) {
            throw new \Exception("Fehler: Benutzer-ID fehlt.");
        }
        $this->userRepository->saveSettings($user);
    }

    public function showUser()
    {
        // Variable der functions die in userRepository stehen
        $username = $_SESSION['login'];
        // den username benutzen um damit eine Anfrage zu stellen um die daten von dem username zu benutzen um seine anderen daten aus der datenbank zu bekomme
        $user = $this->userRepository->findByUsername($username);

        return $user;
    }

    // Methode zum Abrufen des Passworts eines Benutzers
    public function getUserPassword(int $userId): ?string
    {
        // Rufe das Benutzerobjekt aus der Datenbank ab
        $user = $this->userRepository->findById($userId);

        // Überprüfe, ob der Benutzer existiert und das Passwort zurückgegeben werden kann
        if ($user) {
            return $user->password; // Das Passwort des Benutzers wird zurückgegeben
        }

        // Falls der Benutzer nicht existiert, gibt null zurück
        return null;
    }

    public function searchUsers()
    {
        // Prüfen, ob ein Suchbegriff vorhanden ist
        $query = $_GET['query'] ?? '';

        // Benutzer anhand des Suchbegriffs suchen
        $user = $this->userRepository->search($query);

        return $user;
    }

    // public function userProfil()
    // {
    //     $userData = $this->userRepository->findByUsername($_SESSION['username']);
    // }
}


?>