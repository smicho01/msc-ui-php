<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-4">



        <?php if (UserService::isAdmin()): ?>
            <?php UserService::requireAdmin(); ?>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/admin/index.php">
                        <span data-feather="home"></span>
                        <i class="fa-solid fa-gauge"></i>
                        Admin Dashboard</a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Users</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                    <span data-feather="plus-circle"></span>
                </a>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/admin/index.php?v=users-list">
                        <span data-feather="home"></span>
                        User Accounts</a>
                </li>
            </ul>
        <?php endif; ?>


        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Doors</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column">
            <?php if (isUserLoggedIn()): ?>
                <li class="nav-item">
                    <a class="nav-link btnLogout" href="#">
                        <span data-feather="signout"></span>
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sign out
                    </a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?c=login">
                        <span data-feather="signin"></span>
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Sign in
                    </a>
                </li>
            <?php endif; ?>

        </ul>

        <div>
            <img src="/public/img/academi-chain-logo-inversed.webp" class="img-fluid" style="opacity: 0.5;"  />
        </div>
    </div>
</nav>