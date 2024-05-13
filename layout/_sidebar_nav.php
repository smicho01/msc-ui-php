  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
          <ul class="nav flex-column">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/">
                      <span data-feather="home"></span>Dashboard</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="/?c=questions">
                      <span data-feather="github"></span>
                      Questions
                  </a>
              </li>

              <?php if (isUserLoggedIn()): ?>
                  <li class="nav-item">
                      <a class="nav-link btnLogout" href="#">
                          <span data-feather="layers"></span>
                          Sign out
                      </a>
                  </li>
              <?php else: ?>
                  <li class="nav-item">
                      <a class="nav-link" href="index.php?c=login">
                          <span data-feather="layers"></span>
                          Sign in
                      </a>
                  </li>
              <?php endif; ?>

          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Quick View</span>
              <a class="link-secondary" href="#" aria-label="Add a new report">
                  <span data-feather="plus-circle"></span>
              </a>
          </h6>
          <ul class="nav flex-column mb-2">
              <li class="nav-item">
                  <a class="nav-link" href="index.php?c=user&v=account">
                      <span data-feather="file-text"></span>
                      Your Account
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">
                      <span data-feather="file-text"></span>
                      Recent items
                  </a>
              </li>

          </ul>
      </div>
  </nav>