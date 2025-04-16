<?php require(BASE_PATH . '/resources/views/layout/header.php'); ?>

     <!-- Hauptinhalt -->
     <div class="container-fluid p-4">
        <h1 class="mt-4">User Management</h1>
        <!-- Suchformular -->
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="query" class="form-control" 
            placeholder="Suche nach Name oder E-Mail" 
            value="<?= htmlspecialchars($query ?? '') ?>">
            <button class="btn btn-primary" type="submit">Suchen</button>
        </div>
    </form>
        <!-- Benutzerliste -->
    <?php if (isset($users) && count($users) > 0): ?>
        <h4>Benutzerliste</h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Nachname</th>
                    <th>E-Mail</th>
                    <th>Telefonnummer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user->name) ?></td>
                        <td><?= htmlspecialchars($user->surname) ?></td>
                        <td><?= htmlspecialchars($user->email) ?></td>
                        <td><?= htmlspecialchars($user->phone) ?></td>
                        <td>
                            <!-- Bearbeitungs Form in Kürze! -->
                            <button
                                type="button"
                                class="btn btn-warning btn-sm edit-btn"
                                data-id="<?= $user->id ?>"
                                data-name="<?= htmlspecialchars($user->name) ?>"
                                data-surname="<?= htmlspecialchars($user->surname) ?>"
                                data-email="<?= htmlspecialchars($user->email) ?>"
                                data-phone="<?= htmlspecialchars($user->phone) ?>"
                            >
                            Bearbeiten
                            </button>

                            <!-- Löschen-Button -->
                            <form method="POST" class="delete-form d-inline">
                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Löschen</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php elseif(isset($_GET['query']) && isset($query) && empty($results)): ?>
            <p>Keine Benutzer gefunden.</p>
    <?php endif; ?>
    </div>

    <!-- Bearbeiten-Formular -->
    <div id="edit-user-form" class="d-none mb-3 card p-4 shadow-sm">
        <h4>Benutzer bearbeiten</h4>
                            <form method="POST" class="form">
                            <input type="hidden" name="id" id="edit-id" />
                            <div class="mb-3">
                                <label class="form-label">Vorname:</label>
                                <input type="text" name="name" id="edit-name" class="form-control" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nachname:</label>
                                <input type="text" name="surname" id="edit-surname" class="form-control" required />
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="text" name="email" id="edit-email" class="form-control" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Telefonnummer:</label>
                                <input type="text" name="phone" id="edit-phone" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <a href="password" class="form-label">Passwort ändern</a>
                            </div>
                            <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-100">Änderungen speichern</button>
                            <a href="" class="btn btn-secondary cancel-edit">Abbrechen</a>
                        </div>
                    </form>
    </div>
<?php require(BASE_PATH . '/resources/views/layout/footer.php'); ?>