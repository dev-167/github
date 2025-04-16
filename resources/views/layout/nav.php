        <!-- Navigationsleiste -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard">T-REX Templates</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="settings">Einstellungen</a></li>
                    <li class="nav-item"><a class="nav-link" href="search">Suchen</a></li>
                    
                    <?php if($userRole === 'Administration'): ?>
                        <!-- Admin-spezifische Links -->
                        <li class="nav-item"><a class="nav-link" href="dashboardAdmin">Admin Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="user-management">User Management</a></li>
                    <?php endif; ?>

                </ul>
            </div>
            <div class="d-flex">

                <a href="profil" class="btn btn-outline-primary me-2">Profil</a>

                <a href="logout" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
    </nav>