<?php require(BASE_PATH . '/resources/views/layout/header.php'); ?>

     <!-- Hauptinhalt -->
     <div class="container-fluid p-4">
        <div id="DashboardHeader_Module_timestamp"></div>
        <h1 class="mt-4"> 
            <!-- Tagesabhängige Anrede -->
            <span id="greeting_clock"></span>
            <!-- User Name -->
            <?= htmlspecialchars($_SESSION['login'], ENT_QUOTES, 'UTF-8'); ?>
        </h1>
        <p>Willkommen im Mitarbeiterportal. Hier können Sie Ihre Daten einsehen und verwalten.</p>
    </div>
        
<?php require(BASE_PATH . '/resources/views/layout/footer.php'); ?>