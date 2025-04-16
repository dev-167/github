   <?php
   // Startet die PHP-Session. Info: if Abfrage stellt sicher, dass keine Session doppelt gestartet wird
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    // Standard-Rolle setzen, falls nicht vorhanden
    if (!isset($_SESSION['team'])) {
        $_SESSION['team'] = 'user';
    }
    // Globale Variable für Benutzerrolle setzen
    $userRole = $_SESSION['team'];
   // Lädt alle wichtigen Konfigurationsdateien
      require __DIR__ . '/../init.php';
   // Läudt die Routen  
     $routes = require __DIR__ . '/../config/routes.php';
   // Erstellt das Router Objekt
     $router = new \App\Core\Router($routes, $container);
   // Enthält die aktuelle URL Route
   // Holt den Pfadteil der aktuellen URL
    $pathInfo = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // Ermittelt den Basispfad
    $basePath = dirname($_SERVER['SCRIPT_NAME']);
    // Entfernt den Basispfad und ggf. "index.php" aus dem URL-Pfad,
    // damit nur noch der reine Routing-Teil übrig bleibt, z. B. "/user-management"
    $pathInfo = '/' . ltrim(str_replace([$basePath, 'index.php'], '', $pathInfo), '/');


    // Führt die richtige Route aus
    $router->dispatch($pathInfo, $_SERVER['REQUEST_METHOD']);


?>