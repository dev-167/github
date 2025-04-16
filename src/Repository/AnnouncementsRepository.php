<?php
namespace App\Repository;

use PDO;

use App\Core\AbstractRepository;

class AnnouncementsRepository extends AbstractRepository
{

    public function getTableName(){
        return "announcements";
    }

    public function getModelName(){
        return "App\\Model\\AnnouncementsModel";
    }


    public function insertForPost($postId,$content,$title)
    {
        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("INSERT INTO `$table`  (`content`,`posted_by`,`title`) VALUE (:content,:posted_by,:title)");

        echo "</br>";
        $stmt->execute([
            'content' => $content,
            'posted_by' => $postId,
            'title' => $title
        ]);
        echo "</br>";
    }

    public function allByPost($id)
    {
        $table = $this->getTableName();
        $model = $this->getModelName();
        // Gegen sql injections absichern
        $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE posted_by = :id");
        $stmt->execute(['id' => $id]);
        
        $announcements = $stmt->fetchAll(PDO::FETCH_CLASS,$model);

        return $announcements;
    } 
}

?>