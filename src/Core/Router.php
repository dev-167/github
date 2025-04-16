<?php

namespace App\Core;

class Router
{
    // Speichert alle definierten Routen
    private array $routes;
    // Verwaltet die Controller-Instanz 
    private Container $container;

    // Error 404 Seite aufrufen, wenn keine passende Route gefunden wird
    private function handleNotFound()
    {
        http_response_code(404);
        require BASE_PATH . '/resources/views/errors/404.php';
        exit;
    }
    // Konstruktor speichert die übergebenen Routen und den Container
    public function __construct(array $routes, Container $container)
    {
        $this->routes = $routes;
        $this->container = $container;
    }

     /**
     * Hauptmethode des Routers. Ruft anhand der URL und HTTP-Methode
     * die passende Controller-Methode auf.
     */
    public function dispatch(string $path, string $method = 'GET')
    {

        $httpMethod = strtoupper($method); // <- ❗ Wichtig: Methode wie "GET" oder "POST"

        // Prüft, ob die aktuelle URL in den definierten Routen existiert
        if(isset($this->routes[$path])) {

            // Holt den passenden Eintrag aus dem Array
            $route = $this->routes[$path];

            // Controller erstellen
            $controller = $this->container->make($route['controller']);


            // Die Methode, die aufgerufen werden soll, z. B. "dashboard". -> Unterstützt Route mehrere HTTP-Methoden?
            // Prüfen ob HTTP-spezifische Methoden definiert sind
            if (isset($route['methods']) && is_array($route['methods'])) {
                $methodName = $route['methods'][$httpMethod] ?? null;
            } elseif (isset($route['method']) && is_string($route['method'])) {
                // Fallback für Routen mit nur einer Methode
                $methodName = $route['method'];
            } else {
                $methodName = null;
            }

            // if ($methodName) {
            //     // Controller Name
            //     // $controller = $this->container->make($route['controller']);
            //     if (method_exists($controller, $methodName)) {
            //         $controller->$methodName();
            //         return;
            //     }
            // }

            // Nur ausführen, wenn Methode existiert und gültig ist
            if (is_string($methodName) && method_exists($controller, $methodName)) {
                $controller->$methodName(); // Methode ausführen
                return;
            }
            else
            {
                // Fehlerausgabe zu Debug-Zwecken
                echo "Fehler – ungültige Methode";
                var_dump($methodName);
            }
    }
    // Falls Route oder Methode nicht gefunden
    $this->handleNotFound();
}

// session_start();
      
// require __DIR__ . '/../init.php';
// $pathInfo = $_SERVER['PATH_INFO'];
// //Routes Array
// // PATH_INFO wird nur gesetzt, wenn die URL eine Struktur wie folgt hat http://localhost/Apps/employee-portal/public/index.php/index


// if(isset($routes[$pathInfo]))
// {
//    $route = $routes[$pathInfo];
//    $controller = $container->make($route['controller']);
//    $method = $route['method'];
//    $controller->$method();
// }
// else
// {
//    http_response_code(404);
//    echo "<center><h1>404 - Seite nicht gefunden</h1></center>";
// }

// // Damit werden POST-Anfragen an /logout verarbeitet.
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pathInfo === '/logout') {
//    $controller = $container->make('loginController');
//    $controller->logout();
//    exit;
// }
}