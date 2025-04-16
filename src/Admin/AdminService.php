<?php

namespace App\Admin;

use App\User\UserRepository;
use App\User\UserModel;

class AdminService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function saveSettings(UserModel $user)
    {

        var_dump($user->id, $user->email);
        die();

        // Sicher stellen, dass $user->id den Wert des Benutzers hat
        if (!$user->id) {
            throw new \Exception("Fehler: Benutzer-ID fehlt.");
        }

        // Originaldaten laden
        $existingUser = $this->userRepository->findById($user->id);

        if (!$existingUser) {
            throw new \Exception("Fehler: Benutzer konnte nicht gefunden werden.");
        }

        // Überprüfen, ob die E-Mail-Adresse bereits von einem anderen Benutzer verwendet wird (außer dem aktuellen Benutzer)
        // Wenn sich die E-Mail geändert hat -> prüfen, ob sie schon existiert
        if ($user->email !== $existingUser->email) {
            if ($this->userRepository->emailExists($user->email, $user->id)) {
                throw new \Exception("E-Mail-Adresse wird bereits von einem anderen Benutzer verwendet.");
            }
        }

        // Daten speichern
        $this->userRepository->saveSettings($user);
    }

    public function getAllUsers()
    {
        return $this->userRepository->findAll();
    }

    public function adminSearchUsers()
    {
        // Prüfen, ob ein Suchbegriff vorhanden ist
        $query = $_GET['query'] ?? '';

        // Benutzer anhand des Suchbegriffs suchen
        $user = $this->userRepository->adminSearch($query);

        return $user;
    }

    public function showUser()
    {
        // Variable der functions die in userRepository stehen
        $username = $_SESSION['login'];
        // den username benutzen um damit eine Anfrage zu stellen um die daten von dem username zu benutzen um seine anderen daten aus der datenbank zu bekomme
        $user = $this->userRepository->findByUsername($username);

        return $user;
    }

    public function userDelete($id)
    {
        $userId = $this->userRepository->delete($id);

        return $userId;
    }

    // public function userProfil()
    // {
    //     $userData = $this->userRepository->findByUsername($_SESSION['username']);
    // }
}