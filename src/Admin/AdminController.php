<?php

namespace App\Admin;

use App\Core\AbstractController;
use App\User\DashboardController;
use App\User\DashboardService;
use App\User\LoginController;
use App\User\LoginService;
use App\Admin\AdminService;
use App\User\UserModel;

class AdminController extends AbstractController
{
    // Konstruktor für Dependency Injection
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    // Überprüft Login Anfrage anhand der Sessions auf User mit der team Kennzeichnung "Administrator". Anschließend wird zur /admin/dashboard.php Page verwiesen
    public function dashboard()
    {
        if (!isset($_SESSION['login']) || $_SESSION['team'] !== 'Administration') {
            header("Location: /login");
            exit;
        }

        // Admin Dashboard anzeigen
        echo $this->render('admin/dashboardAdmin',[
            'title' => 'Admin Dashboard',
        ]);
    }

    public function saveUserSettings()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Fehler: Das Formular wurde nicht per POST gesendet.");
        }
    
        if (empty($_POST)) {
            die("Fehler: Keine POST-Daten erhalten.");
        }

         // Erstelle den User aus den Formular-Daten
        $user = new UserModel([
            'id' => (int)($_POST['id'] ?? 0),
            'name' => $_POST['name'] ?? '',
            'surname' => $_POST['surname'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? ''
        ]);

        // Sicherheitscheck – ist ID vorhanden?
        if (empty($user->id)) {
            die("Fehler: Benutzer-ID fehlt.");
        }

        // Jetzt speichern
        try {
            $this->adminService->saveSettings($user);
            echo "Änderung erfolgreich gespeichert!";
        } catch (\Exception $e) {
            echo "Fehler beim Speichern der Änderung: " . $e->getMessage();
        }

        // Benutzer nochmal laden für Anzeige
        $this->render("user/settings", [
            'user' => $user,
        ]);
        }

    public function addNewUser()
    {
        $this->render("admin/user-management",[]);
    }

        // Search
    public function search()
    {
        // Ergebnis aus dem DashboardService werden abgerufen, nur wenn ein Suchbegriff existiert
        $result = isset($_GET['query']) ? $this->adminService->adminSearchUsers() : [];


        // Überprüfen, ob ein Fehler-String zurückgegeben wurde
        if(is_string($result))
        {
            $message = $result; // Falls ein Fehler-String (z. B. "Kein Suchbegriff vorhanden") zurückkommt
            $users = []; // // Leere Benutzerliste
        }
        else
        {
            $message = ''; // Keine Fehlermeldung
            $users = $result; // Ergebnis der Benutzer-Suche
        }

        // Ergebnise an die View übergeben
        return $this->render('admin/user-management', [
            'users' => $users,  // Benutzer
            'message' => $message,
            'query' => $_GET['query'] ?? '',
        ]);
    }

    public function userDelete()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']))
        {
            $userId = (int) $_POST['id']; // ID absichern
            $delete = $this->adminService->userDelete($userId);

            // JSON-Antwort für AJAX. Sorgt dafür, dass der Browser weiß, dass es sich um JSON handelt.
            header('Content-Type: application/json');
            echo json_encode(['success' => $delete]);
            exit;
        }

        // Falls keine POST-Anfrage oder keine ID übergeben wurde
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(['success' => false, 'error' => 'Ungültige Anfrage']);
        exit;
    }

}


?>