<?php
namespace App\Controllers;


use App\Core\AbstractController;
// Wir haben ein Controller der ein Parameter oder irgend ein Repository als Parameter benötigt damit wir ihn erstellen das der Container diesen entsprechent bauen kann das das wir es schaffen die Index Methode auszuführen
// Controller wird über den Container
class Controller extends AbstractController
{

    public function __construct($userRepository,$announcementsRepository)
    {
        $this->userRepository = $userRepository;
        $this->announcementsRepository = $announcementsRepository;
    }
    public function index()
    {
        // Variable der functions die in userRepository stehen
        $data = $this->userRepository->findAll();

        // Die Render-Funktion aufrufen
        $this->render("user/index", [
            'data' => $data,
        ]);

        echo "<h1>Post Controller index() wurde ausgeführt</h1>";
    }
    public function userDetails()
    {
        // userRepository laden
        $id = $_GET['id'];
        // Abfrage ob $_POST variable leer ist
        if(isset($_POST['content']))
        {
            // Inhalt aus $_POST Variable
            $content = $_POST['content'];
            $title = $_POST['title'];
            // insertForPost function um id, content und title in tabelle hinzuzufügen
            $this->announcementsRepository->insertForPost($id,$content,$title);
        }

        $dataId = $this->userRepository->findById($id);
        // diese function wurde in AnnouncementsRepository angelegt. 
        $announcements = $this->announcementsRepository->allByPost($id);

        //include __DIR__ . "/../../resources/views/user/user-details.php";

        // Die Render-Funktion aufrufen
        $this->render("user/user-details", [
            'dataId' => $dataId,
            'announcements' => $announcements
        ]);

        echo "<h1>Post Controller userDetails() wurde ausgeführt</h1>";
    }
    public function home()
    {
        echo "<h1>Post Controller home() wurde ausgeführt</h1>";
    }
    public function exception()
    {
        $data = $this->userRepository->exception();

        $this->render("user/exception",[
            'data' => $data
        ]);

        echo "<h1>Post Controller exception() wurde ausgeführt</h1>";
    }
}
?>