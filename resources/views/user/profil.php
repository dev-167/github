<?php require(BASE_PATH . '/resources/views/layout/header.php'); ?>
<h2 class="m-3">Mein Profil</h2>
      <!-- Start einer HTML-Liste -->
      
      <div class="container mt-5"><!-- Container für Abstand und Zentrierung -->
            <ul class="list-group bg-opacity-25"><!-- Hellblauer Hintergrund und zentrierter Text -->
                  <p>Name: <?php echo $user->name; ?></p>
                  <p>Name: <?php echo $user->surname; ?></p>
                  <p>Email: <?php echo $user->email; ?></p>
                  <p>Position: <?php echo $user->position; ?></p>
                  <p>Abteilung: <?php echo $user->team; ?></p>
                  <p>Telefonnummer: <?php echo $user->phone; ?></p>
                  <p>Avatar: <?php echo $user->avatar; ?></p></>
                  <p>Seit <?php echo $user->created_at; ?> in unserer Firma</p>
            </ul>
      </div>

        </br>
        </br>
        </br>
<?php require(BASE_PATH . '/resources/views/layout/footer.php'); ?>