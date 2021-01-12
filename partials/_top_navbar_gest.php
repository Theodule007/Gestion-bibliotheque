
<!-- partial:../../partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="../../index.html">
            <img src="./assets/images/logo.svg" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="../../index.html">
            <img src="./assets/images/logo-mini.svg" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block">Help : +509 4065 3718</li>
            </li>
          </ul>
          <form class="ml-auto search-form d-none d-md-block" action="#">
            <div class="form-group">
              <input type="search" class="form-control" placeholder="Search Here">
            </div>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count">7</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-email-outline"></i>
                <span class="count bg-success">3</span>
              </a>
              
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <?php if($_SESSION['Sexe_user']==1) {?>  <img class="img-xs rounded-circle" src="./assets/images/faces-clipart/pic-4.png" alt="Profile image">  <?php } else { ?>
                  <img class="img-xs rounded-circle" src="./assets/images/faces-clipart/pic-2.png" alt="Profile image">       <?php } ?>
                 </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                <?php if($_SESSION['Sexe_user']==1) {?>  <img class="img-md rounded-circle" src="./assets/images/faces-clipart/pic-4.png" alt="Profile image">  <?php } else { ?>
                  <img class="img-md rounded-circle" src="./assets/images/faces-clipart/pic-2.png" alt="Profile image">       <?php } ?>
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo($_SESSION['Nom_user'].' '.$_SESSION['Prenom_user'])?></p>
                  <p class="font-weight-light text-muted mb-0"><?php echo($_SESSION['E_mail_user'])?></p>
                </div>
                <a class="dropdown-item">Mon Profil <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
                <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
                <a class="dropdown-item">Activité<i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a>
                <a class="dropdown-item">Deconnecter<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>