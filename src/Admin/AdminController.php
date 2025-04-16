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
        // Benutzer-Daten abrufen
        $user = $this->adminService->showUser();


        // Debugging: Benutzer anzeigen
        if (!$user || empty($user->id)) {
            echo "<pre>";
            print_r($user);
            echo "</pre>";
            //$error("Fehler: Benutzer nicht gefunden oder nicht eingeloggt.");
            // Container-Instanz erhalten (abhängig davon, wie du deinen Container initialisierst)
            $container = new \App\Core\Container();  

            // LoginController über den Container holen
            $loginController = $container->make("loginController");  

            // Logout-Funktion aufrufen
            $loginController->logout();

            return;
        }

        $userId = $user->id;

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render("user/settings", ['user' => $user]);
            return;
        }

        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            die("Feher: Das Formular wurde nicht per POST gesendet.");
        }

        if(empty($_POST))
        {
            die("Fehler: Keine POST_Daten erhalten.");
        }

        // UserModel-Objekt erstellen
        $user = new UserModel();
        // Unsere Einträge werden aktuallisiert mit den eingegebenen Daten aus den input feldern aus der $_POST[]
        $user->id = $userId;
        $user->name = $_POST['name'] ?? '';
        $user->surname = $_POST['surname'] ?? '';
        $user->email = $_POST['email'] ?? '';
        $user->phone = $_POST['phone'] ?? '';
        //print_r($user);
        // if (!empty($_POST['password'])) {
        //     $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // } else {
        //     $user->password = $this->dashboardService->getUserPassword($userId);
        // }

        // Speichern der Benutzereinstellung
        $result = $this->adminService->saveSettings($user);

        if(!$result)
        {
            echo "Änderung erfolgreich gespeichert!";
        }
        else
        {
            echo "Fehler beim Speichern der Änderung.";
        }
        
        // Die Render-Funktion aufrufen;
        $this->render("user/settings",[
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