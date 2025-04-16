<?php require(BASE_PATH . '/resources/views/layout/header.php'); ?>
<h2>Employee</h2>
      <!-- Start einer HTML-Liste -->
      <ul class='list-group list-group-numbered'>
         <!-- Jede Zeile der Tabelle als Listenelement anzeigen -->
         <ul class='list-group list-group-numbered'>
         <?php //foreach ($dataId as $user): ?>
             <li class="list-group-item">
                 <strong>ID:</strong><?php echo e($dataId->id); ?> <br>
                 <strong>Name:</strong><?php echo e($dataId->name) ?> <br>
                 <strong>Email:</strong><?php echo e($dataId->email) ?>
             </li>
         <?php //endforeach;?>
            </ul>
            <a href="index">Home</a>
        </ul>
        <ul class="list-group">
        <strong>ID:</strong><?php echo e($dataId->id) ?> <br>
            <?php foreach($announcements AS $announcement):?>
                <li class="list-group-item">
                <hr>
                    <p><?php echo nl2br(e($announcement->content));?></p>
                    <p><?php echo nl2br(e($announcement->title,));?></p>
                </hr>
                </li>
            <?php endforeach;?>
        </ul>

        <form method="post" action="user-details?id=<?php echo $dataId['id'];?>">
                <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
            </br>
                <textarea name="title" id=""class="form-control"></textarea>
            </br>
            <input type="submit" value="Kommentar hinzufügen" class="btn btn-primary">

        </form>

        </br>
        </br>
        </br>
<?php require(BASE_PATH . '/resources/views/layout/footer.php'); ?>