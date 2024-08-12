  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-4">
          <ul class="nav flex-column">
              <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="/">
                      <span data-feather="home"></span>
                      <i class="fa-solid fa-gauge"></i>
                      Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/index.php?c=questions">
                      <span data-feather="questions"></span>
                      <i class="fa-solid fa-clipboard-question"></i>
                      Questions
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link" href="#">
                      <span data-feather="recentitems"></span>
                      <i class="fa-solid fa-file-contract"></i>
                      Recent items
                  </a>
              </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Your Links</span>
          </h6>


          <ul class="nav flex-column mb-2">
              <li class="nav-item">
                  <a class="nav-link" href="index.php?c=user&v=questions">
                      <span data-feather="yquestions"></span>
                      <i class="fa-solid fa-clipboard-question"></i>
                      Questions
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?c=user&v=messages">
                      <span data-feather="yquestions"></span>
                      <i class="fa-solid fa-envelope-open-text"></i>
                      Messages
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?c=user&v=friends">
                      <span data-feather="yquestions"></span>
                      <i class="fa-solid fa-user"></i>
                      Connections
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?c=user&v=transactions">
                      <span data-feather="yquestions"></span>
                      <i class="fa-solid fa-money-bill-transfer"></i>
                      Transactions
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link" href="index.php?c=user&v=account">
                      <span data-feather="yaccount"></span>
                      <i class="fa-solid fa-gears"></i>
                      Account
                  </a>
              </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Related Apps</span>
          </h6>


          <ul class="nav flex-column mb-2">
              <li class="nav-item">
                  <a class="nav-link" href="http://sever3d.synology.me:90">
                      <span data-feather="yquestions"></span>
                      <i class="fa-solid fa-wallet"></i>
                      Wallet transactions
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="http://sever3d.synology.me:4001">
                      <span data-feather="yquestions"></span>
                      <i class="fa-solid fa-right-left"></i>
                      Item Exchange
                  </a>
              </li>


          </ul>

          <?php if (UserService::isAdmin()): ?>
                <?php UserService::requireAdmin(); ?>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                  <span>Admin</span>
                  <a class="link-secondary" href="#" aria-label="Add a new report">
                      <span data-feather="plus-circle"></span>
                  </a>
              </h6>
              <ul class="nav flex-column">
                  <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="/admin/index.php">
                          <span data-feather="home"></span>
                          <i class="fa-solid fa-gauge"></i>
                          Admin Dashboard</a>
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
              <img src="public/img/academi-chain-logo-inversed.webp" class="img-fluid" style="opacity: 0.5;"  />
          </div>
      </div>
  </nav>