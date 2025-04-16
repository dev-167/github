<?php
namespace App\Core;
abstract class AbstractController
{
    public function __construct()
    {
        // login Time Check
        session_start();

        // Timeout in Sekunden (z. B. 15 Minuten)
        $timeout = 900; 

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout) {
            // Session ist abgelaufen
            session_unset();     // alle Session-Variablen löschen
            session_destroy();   // Session selbst zerstören
            header("Location: /login"); // Zur Login-Seite
            exit;
        }

        // Aktivitätszeitpunkt aktualisieren
        $_SESSION['LAST_ACTIVITY'] = time();

    }
        // Render-Funktion zum Laden einer View und Übergeben von Daten
        protected function render($view,$params)
        {
            // Immer die aktuelle Rolle mit übergeben
            $params['userRole'] = $_SESSION['team'] ?? 'user';
            // Daten als Variablen verfügbar machen
            extract($params);
            // Den Pfad zur View-Datei definieren
            $viewPath = __DIR__ . "/../../resources/views/{$view}.php";
            // Überprüfen, ob die View existiert
            if (file_exists($viewPath)) {
                include $viewPath;
            } else {
                var_dump($viewPath);
                var_dump("<br>");
                var_dump("<br>");
                var_dump("<br>");
                var_dump($view);
                die("View {$view} not found!");
            }
        }
}

?>