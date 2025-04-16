<?php
namespace App\User;

use App\Core\AbstractController;

class LoginController extends AbstractController
{

     // Konstruktor für Dependency Injection
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function dashboard()
    {
        // Login Check
        $this->loginService->check();
        // keine Parameter daher das leere array
        // Wenn eingeloggt, dann gehts zum Dashboard

        // Überprüfen, ob der Benutzer eingeloggt ist und die Rolle in der Session gespeichert wurde
        //$userRole = 'guest'; // Standardwert für nicht eingeloggte Benutzer
        $userName = $_SESSION['login'];
        $userRole = $_SESSION['team'] ?? 'user'; // Admin oder normaler User
 
            $this->render("user/dashboard", [
                'title' => 'Dashboard',
                'userRole' => $userRole,
                'user' => $userName
            ]);
    }

    public function logout()
    {
        $this->loginService->logout();
        session_unset();
        session_destroy();
        header("Location: /login"); // zur login seite verweisen
        exit(); // Wichtig, um sicherzustellen, dass kein weiterer Code ausgeführt wird
    }

    public function login()
    {
        // Errror am anfang auf nichts
        $error = null; // error inizialsiert
        if(!empty($_POST['email']) || !empty($_POST['password']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Einloggen durchführen, attempt fragt ob username und password richtig sind und fragt bei der Datenbank nach
            
            // Einloggen durchführen und Besitzer authentifizieren
            $user = $this->loginService->attempt($email,$password);

            if($user)
            {
                    header("Location: dashboard"); // Weiterleitung. Letzter schrägstrich wird ausgetauscht
                    exit;
            }
            else
            {
                $error = true;
            }   
        }

        // Überprüfen, ob der Benutzer eingeloggt ist und die Rolle in der Session gespeichert wurde
            // if (isset($_SESSION['team'])) {
            //     $userRole = $_SESSION['team'];  // Die Rolle wird in der Session gespeichert, z. B. 'Administrator'
            // } else {
            //     $userRole = 'user';  // Wenn keine Rolle vorhanden, gehe davon aus, dass der Benutzer ein Gast ist
            // }

        // Einloggen durchführen
        $this->render("user/login",[
            'error' => $error,
            //'userRole' => $userRole
        ]);
    }
}
?>