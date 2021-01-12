
<!-- partial:../../partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                <?php if($_SESSION['Sexe_user']==1) {?>  <img class="img-xs rounded-circle" src="./assets/images/faces-clipart/pic-4.png" alt="Profile image">  <?php } else { ?>
                  <img class="img-xs rounded-circle" src="./assets/images/faces-clipart/pic-2.png" alt="Profile image">       <?php } ?>
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?php echo($_SESSION['Nom_user'].' '.$_SESSION['Prenom_user'])?></p>
                  <p class="designation">Gestionnaire</p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="./dashboard_gestionnaire.php">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Tableau de bord</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Page_gestionnaire.php">
                <i class="menu-icon typcn typcn-th-large-outline"></i>
                <span class="menu-title">Abonnés</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="./gestion_bibliothecaire.php">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Bibliothecaires</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        