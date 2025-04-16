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
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 400px;">
        <h3 class="text-center mb-3">Mitarbeiter Portal</h3>

        <!-- Fehlernachricht -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center">
                <?php echo htmlspecialchars("Benutzername oder Passwort falsch", ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
        <!-- Fehlernachricht -->
        
        <form method="POST" class="form">
            <div class="mb-3">
                <label class="form-label">Benutzername:</label>
                <input type="text" name="email" class="form-control" value="" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Passwort:</label>
                <input type="password" name="password" class="form-control" value="" autocomplete="new-password" required />
            </div>

            <button type="submit" class="btn btn-primary w-100">Einloggen</button>
        </form>
    </div>
</div>

<?php require(BASE_PATH . '/resources/views/layout/footer.php'); ?>
