<?php
namespace App\Core;

use PDO;
use Exception;
use PDOException;
use App\User\UserRepository;
use App\Repository\AnnouncementsRepository;
use App\Controllers\Controller;
use App\User\LoginController;
use App\user\LoginService;
use App\user\DashboardController;
use App\user\DashboardService;
use App\admin\AdminController;
use App\admin\AdminService;

// Container soll eine Abfrage zu den Herrgestellten Klassen darrstellen, die schon benuzt werden. Ansonsten werden neue klassen erzeugt
// Unser Container sorgt dafür  dass wir nur ein Element bauen oder wenn eine Bauanleitung gefunden wurde aber wir diese instsnz noch nicht haben dann entsprechend diese Bauanleitung ausführt
// In Symphony benutzt man inidateien um das zu spezifizieren. In Laravel Service Provider
class Container
{

    private $receipts = [];
    private $instances = []; //Array

    public function __construct()
    {
        $this->receipts = [
            'adminService' => function()
            {
                return new AdminService(
                    $this->make("userRepository")
                );
            },
            'adminController' => function()
            {
                return new AdminController(
                    $this->make("adminService")
                );
            },
            'dashboardService' => function()
            {
                return new DashboardService(
                    $this->make("userRepository")
                );
            },
            'dashboardController' => function()
            {
                return new DashboardController(
                    $this->make("dashboardService")
                );
            },
            'loginService' => function()
            {
                return new LoginService(
                    $this->make("userRepository")
                );
            },
            'loginController' => function()
            {
                return new LoginController(
                    $this->make("loginService")
                );
            },
            'controller' => function()
            {
                // Neue instanz setze
                return new Controller(
                    $this->make('userRepository'),
                    $this->make('announcementsRepository')
                );
            },
            'userRepository' => function()
            {
                // var_dump("userRepository");
                return new UserRepository
                (
                    $this->make("pdo")
                );
            },
            'announcementsRepository' => function()
            {
                return new AnnouncementsRepository
                (
                    $this->make("pdo")
                );
            },
            'pdo' => function() 
            {
                $dsn = 'mysql:host=localhost;dbname=emplyee_db;charset=utf8mb4';
                $username = 'root';
                $password = 'mysql';
                // Datenbank Kontrollstruktur
                try 
                {
                    $pdo = new PDO($dsn, $username, $password);
                } catch (PDOException $e) 
                {
                    echo "Verbindung zur Datenbank fehlgeschlagen";
                    die();
                }
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }
        ];
    }

    public function make($name)
    {
            if(!empty($this->instances[$name]))
            {
                return $this->instances[$name];
            }

            if(isset($this->receipts[$name]))
            {
                return $this->instances[$name] = $this->receipts[$name](); // (); weil in dem Array sich eine function befindet
            }
        // ERZEUGE: return $this->instances[$name];

        return $this->instances[$name];
    }



    /*
    private $pdo;
    private $userRepository;

    public function getPdo()
    {
        if(!empty($this->pdo))
        {
            return $this->pdo;
        }

        $dsn = 'mysql:host=localhost;dbname=emplyee_db;charset=utf8mb4';
        $username = 'root';
        $password = 'mysql';
        // Debugging
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
        return $this->pdo;
    }
    public function getUserRepository()
    {
        if(!empty($this->userRepository))
        {
            return $this->userRepository;
        }
        $this->userRepository = new UserRepository(
            $this->getPdo()
        );
        return $this->userRepository;
    }
    */
}