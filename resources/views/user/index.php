<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <!-- Bootstrap CSS Lokal -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <!-- Bootstrap CSS Link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Bootstrap JS Lokal -->
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap JS Link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </head>
<body>

<?php 

echo "</br>";
echo date("d.m.Y",time() + (60 * 60 *24));

?>
<h2>List of Employees</h2>
<?php if(!empty($data)): ?>
        <!-- Start einer HTML-Liste -->
         <ul class='list-group list-group-numbered'>
            <!-- Jede Zeile der Tabelle als Listenelement anzeigen -->
            <?php foreach ($data as $user): ?>
                <li class="list-group-item">
                <strong>Name:</strong><a href="user-details?id=<?php echo e($user->id); ?>">
                    <!-- <strong>Name:</strong><a href="user-details.php"> -->
                    <?php echo e($user->name); ?>
                    </a>
                </li>
            <?php endforeach;?>
            
         </ul>
         <!-- Ende der HTML-Liste -->
        <?php else: ?>
            <p>Kein Benutzer gefunden</p>
<?php endif; ?>
<?php require(BASE_PATH . '/resources/views/layout/footer.php'); ?>