<?php

return [
    '/index' => ['controller' => 'controller', 'method' => 'index'],
    '/user-details' => ['controller' => 'controller', 'method' => 'userDetails'],
    '/login' => ['controller' => 'loginController', 'method' => 'login'],
    '/dashboard' => ['controller' => 'loginController', 'method' => 'dashboard'],
    '/home' => ['controller' => 'controller', 'method' => 'home'],
    '/settings' => ['controller' => 'dashboardController', 'method' => 'saveUserSettings'],
    '/profil' => ['controller' => 'dashboardController', 'method' => 'userProfil'],
    '/logout' => ['controller' => 'loginController', 'method' => 'logout'],
    '/search' => ['controller' => 'dashboardController', 'method' => 'search'],
    '/user-management' => ['controller' => 'adminController', 'methods' => ['GET' => 'search', 'POST' => 'saveUserSettings'],],
    '/delete-user' => ['controller' => 'adminController', 'method' => 'userDelete']
];