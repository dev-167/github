<?php require(BASE_PATH . '/resources/views/layout/header.php'); ?>

     <!-- Search -->
     <div class="container mt-4">
    <h2>🔍  Benutzer-Suche</h2>
        <!-- Suchformular -->
        <form method="GET action="">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="Suchbegriff eingeben..." 
                    value="<?= htmlspecialchars($query ?? '') ?>" required>
                <button class="btn btn-primary" type="submit">Suchen</button>
            </div>
        </form>

            <!-- Nachricht anzeigen, wenn ein Fehler oder leere Ergebnisse vorhanden sind -->
            <?php if (!empty($message)): ?>
                <p><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>


            <!-- Suchergebnisse -->
            <?php if (isset($users) && count($users) > 0): ?>
                <h3>Gefundene Benutzer</h3>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Nachname</th>
                            <th>E-Mail</th>
                            <th>Telefon</th>
                            <th>Team</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user->name) ?></td>
                                <td><?= htmlspecialchars($user->surname) ?></td>
                                <td><?= htmlspecialchars($user->email) ?></td>
                                <td><?= htmlspecialchars($user->phone) ?></td>
                                <td><?= htmlspecialchars($user->team) ?></td>
                                <td><?= htmlspecialchars($user->position) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php elseif(isset($_GET['search']) && isset($query) && empty($results)): ?>
                <p>Keine Benutzer gefunden.</p>
            <?php endif; ?>
        </div>

    </div>
    

        
<?php require(BASE_PATH . '/resources/views/layout/footer.php'); ?>