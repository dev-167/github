<?php
// Basispfad definieren:
define('BASE_PATH', __DIR__);

// Asset-Funktion für sicheres Laden von Dateien aus dem /App-Verzeichnis
    function asset($path) {
        return dirname($_SERVER['SCRIPT_NAME']) . '/' . ltrim($path, '/');
    }

// e ist escaping "XSS lücken schliessen
function e($str)
{
    return htmlentities($str, ENT_QUOTES,'UTF-8');
}

//Header
    //composer Autoload
    require_once __DIR__ . '/vendor/autoload.php';
    // Database
    require BASE_PATH . '/src/Database/Database.php';
    // Container for calling Repository and more
    $container = new App\Core\Container();

    // Sicherstellen, dass session_start() nur einmal aufgerufen wird
    // if (session_status() === PHP_SESSION_NONE) {
    //     session_start();
        // Token generieren und speichern 
        // if (empty($_SESSION['csrf_token'])) {
        //     $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        // }
    //}

//Footer
// require_once(BASE_PATH . '/resources/views/layout/footer.php');
?>