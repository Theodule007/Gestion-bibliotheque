<?php session_start(); ?>
<?php require_once('./database/db_credentials.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Gestionnaire</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="./assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="./assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="./assets/images/favicon.ico" />
  </head>
  <body>
  <?php
    $date = date("Y-m-d");
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }
//selectionner les abonnes
   $sql = "SELECT * FROM abonnes";
   $search_result = mysqli_query($con, $sql);
 //selectionner les infos dans la table Preter_livre
 $sql_pret = "SELECT * FROM preter_livres ORDER BY Date_pret DESC";
 $search_result_pret = mysqli_query($con, $sql_pret);
//selectionner l'ensemble des livres de la bibliotheque
$sql_livre="SELECT * FROM livres";
$search_result_livre=mysqli_query($con, $sql_livre);
//selectionner les biblithecaires
$sql_biblio = "SELECT * FROM utilisateus WHERE Type_user=0";
$search_result_biblio = mysqli_query($con, $sql_biblio);
?>

    <div class="container-scroller">
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
                  <img class="img-xs rounded-circle" src="./assets/images/faces-clipart/pic-2.png" alt="Profile image">       <?php } ?> </a>
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
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
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


        <?php
             // check et alerte d'un relancement d'un abonne
             if (isset($_GET['distribute_success'])) {
             if ($_GET['distribute_success'] == 'true') {?>
                     <div class="alert alert-success " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Succes!</strong> L'abonné a été relancé.
                 </div>
                    <?php } else {?>

                        <div class="alert alert-danger " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Erreur!</strong> L'abonné n'a pas été relancé.
                 </div>
                    <?php }}?>


        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body" style="height:300px;overflow:auto;">
                    <h4 class="card-title">Abonnés</h4>
                    <p class="card-description"> Info sur les abonnés </p>
                    <table class="table" >
                      <thead>
                        <tr>
                          <th>Profil</th>
                          <th>ID</th>
                          <th>Debut abonnement</th>
                          <th>Statut</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($search_result as $result ){ ?>
                        <tr>
                          <td> <?php echo($result['Nom_abonn']) ?> </td>
                          <td> <?php echo($result['Id_abonn']) ?> </td>
                          <td> <?php echo($result['Create_abonn']) ?> </td>
                          <td>
                            <?php if($date>=$result['Fin_abonn']){ ?>
                            <label class="badge badge-danger">Suspendu!</label>
                            <?php } else {?> <label class="badge badge-success">En cours...</label> <?php } ?>
                          </td>
                          <td> 
                          <?php if($date<$result['Fin_abonn']){?> <a class="btn btn-warning btn-small btn-rounded disabled" title="Il ne peut etre relancé">Renouveler <i class="fa fa-arrow-up"></i></a> <?php } else{ ?>
                          <a class="btn btn-warning btn-small btn-rounded" title="Renouvelle-le" href="./functions/rennouvler.php?abonn_id=<?php if (isset($result['Id_abonn'])){echo(($result['Id_abonn']));} ;?> ">Renouveler <i class="fa fa-arrow-up"></i></a> <?php } ?>
                          </td>
                        </tr>
                        <?php } ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body" style="height:100px;overflow:auto">
                    <h4 class="card-title">Bibliothecaires</h4>
                    <p class="card-description"> Info sur les bibliothecaires </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Nom</th>
                          <th>Prenom</th>
                          <th>Email</th>
                          <th>Sexe</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($search_result_biblio as $biblio){?>
                        <tr>
                          <td> <?php echo($biblio['Nom_user']) ?> </td>
                          <td> <?php echo($biblio['Prenom_user']) ?>  </td>
                          <td> <?php echo($biblio['E_mail_user']) ?>  </td>
                          <td> <?php if($biblio['Sexe_user']==0){echo('Feminin');}
                          else{echo('Masculin');}  ?> </td>
                        </tr>
                         <?php } ?>
                         </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Table Emprunt</h4>
                    <p class="card-description"> Les abonnés avec les livres qu'ils ont pretés</p>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Abonnés </th>
                          <th> livres </th>
                          <th> Progression du délai </th>
                          <th> Date du pret </th>
                          <th> Date remise </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($search_result_pret as $pret){ 
                        $Id_abonn=$pret['Id_abonn'];
                        $Id_livre=$pret['id_livre'];
                        $nom_prenom="SELECT * FROM Abonnes WHERE Id_abonn= $Id_abonn";
                        $execute_nom_prenom=mysqli_query($con, $nom_prenom);   
                        $livre="SELECT Titre_livre FROM livres WHERE Id_livre=$Id_livre";
                        $execute_livre=mysqli_query($con, $livre); ?> 
                        <tr>
                          <td class="py-1">
                          <?php foreach($execute_nom_prenom as $abonne) {?>
                          <?php 
                          echo($abonne['Nom_abonn'].' '.$abonne['Prenom_abonn']);
                          } ?>
                          </td>
                          <td> <?php foreach($execute_livre as $Titre_livre) {?>
                          <?php 
                          echo($Titre_livre['Titre_livre']);
                          } ?> </td>
                          <td>
                            <?php $diff_date=abs(strtotime($date)-strtotime($pret['Date_pret']));
                            $annees=floor($diff_date/(365*60*60*24));
                            $mois=floor(($diff_date-$annees*365*60*60*24)/(30*60*60*24));
                            $jour=floor(($diff_date-$annees*365*60*60*24-$mois*30*60*60*24)/(60*60*24)); 
                            $progress_percent=floor(($jour*100)/7);
                            ?>
                            <div class="progress">
                              <?php if ($progress_percent>75){?> 
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo($jour*100/7) ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo($progress_percent) ?>%</div>
                              <?php  } else if($progress_percent>50) {?>
                              <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo($jour*100/7) ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo($progress_percent) ?>%</div>
                            </div>
                            <?php }else {?> <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo($jour*100/7) ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo($progress_percent) ?>%</div> <?php } ?>
                          </td>
                          <td> <?php echo($pret['Date_pret']); ?> </td>
                          <td> <?php echo($pret['Date_remise']); ?> </td>
                          <td> 
                          <?php if($progress_percent<100){?> <a class="btn btn-warning btn-small disabled" title="Il ne peut etre relancé">Relancer <i class="fa fa-arrow-up"></i></a> <?php } else{ ?>
                          <a class="btn btn-warning btn-small" title="Relance-le" href="./functions/Relancer.php?details_email=<?php if (isset($abonne['E_mail_abonn'])) {echo ($abonne['E_mail_abonn']);}
                         ;?>&details_titre_livre=<?php if (isset($Titre_livre['Titre_livre'])){echo(($Titre_livre['Titre_livre']));} ;?> ">Relancer <i class="fa fa-arrow-up"></i></a> <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Livres</h4>
                    <p class="card-description">Les livres de la bibliotheque</p>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> Titre </th>
                          <th> Nom auteur </th>
                          <th> Maision d'edition </th>
                          <th> Date de sortie </th>
                          <th> Page </th>
                          <th> Code rayon </th>
                          <th> Categorie </th>
                          <th> Quantité </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($search_result_livre as $livre) { ?> 
                        <tr>
                          <td> <?php echo($livre['Titre_livre']) ?> </td>
                          <td> <?php echo($livre['Nom_auteur'].' '. $livre['Prenom_auteur']) ?> </td>
                          <td> <?php echo($livre['Maison_edition']) ?> </td>
                          <td> <?php echo($livre['Date_de_sortie']) ?> </td>
                          <td> <?php echo($livre['Pages_livre']) ?> </td>
                          <td> <?php echo($livre['Code_rayon']) ?> </td>
                          <td> <?php echo($livre['Categorie_livre']) ?> </td>
                          <td> <?php echo($livre['Qte_livre']) ?> </td>
                          
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


              
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="./assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="./assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="./assets/js/shared/off-canvas.js"></script>
    <script src="./assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="./assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <!-- End custom js for this page-->
  </body>
</html>
<?php //session_destroy(); ?>