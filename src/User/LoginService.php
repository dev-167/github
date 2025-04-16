<?php
namespace App\User;

class LoginService
{
    private $userRepository;

    // Der login service hat zugriff auf unsere Datenbank mit dem Parameter userRepository
    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;

    }

    public function check()
    {
        if(isset($_SESSION['login']))
        {
            return true;
        }
        else
        {
            // Wenn du nicht eingeloggt bist, dann log dich bitte ein   
            header("Location: login"); // zur login seite verweisen
            die(); // Später exception einstellen. 
            // Wenn kein nutzer eingeloggt ist diese exception geworfen wird und ein Dumm weiterleitet
        }
    }
    // die funktion kümmert sich, log diesen benutzer ein
    // Abfrage von Benutzer Mail und Password
    public function attempt($email,$password)
    {
        $user = $this->userRepository->findByEmail($email);
        if(!$user || empty($user->password))
        {
            return false; // Kein User gefunden oder kein Passwort gespeichert
        }

        if(password_verify($password,$user->password))
        {
            $_SESSION['login'] = $user->name;
            $_SESSION['team'] = $user->team; // Speichert die Rolle `team`des Users 
            session_regenerate_id(true); // Erzeugt eine neue Session-ID und löscht die alte
            return true; // password ist abgeschlossen, login erfolgreich
        }
        else
        {
            return false;
        }
    }

    public function logout()
    {
        session_unset(); // Löscht alle Session-Variablen 
        // Alle Session-Variablen löschen
        $_SESSION = [];

        // Die Session vollständig zerstören
        session_destroy();

        // Die Session-Cookies löschen (falls verwendet)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        // Session-ID regenerieren
        session_regenerate_id(true);

        // Einfacher Redirect mit echo zur Überprüfung
        header("Location: login"); // Passe dies an die tatsächliche Login-URL an.
        exit(); // Verhindere weitere Ausführung
    }
}

?>