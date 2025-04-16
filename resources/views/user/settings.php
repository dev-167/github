<?php require(BASE_PATH . '/resources/views/layout/header.php'); ?>
<h2 class="m-3">Profil Einstellungen</h2>
      <!-- Start einer HTML-Liste -->
      <div class="container mt-5 d-flex justify-content-center"><!-- Container für Abstand und Zentrierung -->
            <ul class="col-md-6 col-lg-4 bg-light p-4 rounded-5"><!-- Hellblauer Hintergrund und zentrierter Text -->

                        <!-- Fehlernachricht -->
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                        <?php endif; ?>
                        <!-- Fehlernachricht -->

                <form method="POST" class="form">
                        <div class="mb-3">
                            <label class="form-label">Vorname:</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $user->name; ?>" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nachname:</label>
                            <input type="text" name="surname" class="form-control" value="<?php echo $user->surname; ?>" required />
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $user->email; ?>" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefonnummer:</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $user->phone; ?>" required />
                        </div>

                        <div class="mb-3">
                            <a href="password" class="form-label">Passwort ändern</label>
                            <!-- <input type="password" name="password" class="form-control" value="" autocomplete="new-password"/> -->
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Änderungen speichern</button>
                    </form>
            </ul>
        </div>
        </br>
        </br>
        </br>
<?php require(BASE_PATH . '/resources/views/layout/footer.php'); ?>