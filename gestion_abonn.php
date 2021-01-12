<?php session_start(); ?>
<?php require_once './database/db_credentials.php';?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_head.php";?>

<body>
    <div class="container-scroller">
        <!-- top navbar -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_top_navbar.php";?>
        <div class="container-fluid page-body-wrapper">
            <!-- sidebar nav -->
             <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_sidebar.php";?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- page title header Starts-->
                    <div class="row page-title-header">
                        <div class="col-md-12">
                            <div class="page-header-toolbar">
                                <div class="filter-wrapper">
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    


                    <?php
// check and alert the user if item was updated
if (isset($_GET['update_success'])) {
if ($_GET['update_success'] == 'true') {?>
                    <div class="alert alert-success " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Succes!</strong> L'element a ete mis ajou.
                 </div>
                     <?php } else {?>
 
                <div class="alert alert-danger " role="alert">
                     
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                     <strong>Erreur!</strong> L'element n'a pas été mis a jour.
                  </div>
                    <?php }}?>
<?php
                    //Verfier et alerter le bibliothecaire de la restitution d'un element
if (isset($_GET['receive_success'])) {
if ($_GET['receive_success'] == 'true') {?>
                    <div class="alert alert-success " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Succes!</strong> L'ouvrage a ete restitué.
                 </div>
                     <?php } else {?>
 
                <div class="alert alert-danger " role="alert">
                     
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                     <strong>Erreur!</strong> L'ouvrage n'a pas été restitué.
                  </div>
                    <?php }}?>

                    <?php
// check and alert the user if item was distributed
if (isset($_GET['distribute_success'])) {
if ($_GET['distribute_success'] == 'true') {?>
                    <div class="alert alert-success " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Succes!</strong> L'ouvrage a ete preté.
                 </div>
                     <?php } else {?>
 
                <div class="alert alert-danger " role="alert">
                     
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                     <strong>Erreur!</strong> L'ouvrage n'a pas été preté.
                  </div>
                    <?php }}?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 grid-margin">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h4 class="card-title">Rechercher Abonnés</h4>
                                            </div>
                                            <!-- <p>This table includes all the inventory items stored in your warehouse</p> -->

                                            <form class="ml-auto search-form d-none d-md-block">
                                                <div class="form-group">
                                                    <input type="text" name="term" class="auto form-control"
                                                        placeholder="Commencer a rechercher par nom abonné">
                                                    <button class="btn btn-primary btn-small mt-3" type="submit"
                                                        name="submitButton"><i
                                                            class="fa fa-search"></i>Recherche</button>
                                                </div>
                                            </form>

                                            <?php

// check and return the search results from the lookup form
if (isset($_GET['submitButton'])) {
$term = $_GET['term'];
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
$sql = "SELECT * FROM abonnes WHERE Nom_abonn LIKE '$term%'";
$search_result = mysqli_query($con, $sql);
mysqli_close($con);
}
?>

                                            <?php if (!empty($search_result)) {?>

                                            <!-- place the lookup search results in a table -->

                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Nom abonné</th>
                                                            <th>Prenom abonné</th>
                                                            <th>Type</th>
                                                            <th>Commencement abonnement</th>
                                                            <th>Fin abonnement</th>
                                                            <th>Quantite livres</th>
                                                            <th>Forfait</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php while ($row = mysqli_fetch_assoc($search_result)) {?>
                                                        <tr>
                                                            <td> <?php echo ($row['Nom_abonn']); ?> </td>
                                                            <td> <?php echo ($row['Prenom_abonn']); ?> </td>
                                                            <td> <?php if($row['Type_abonn']==1) { ?> <label class="badge badge-warning">étudiant</label> <?php
                                                            }else{ ?> <label class="badge badge-info">Professeur</label> <?php } ?> </td>
                                                            <td> <?php echo ($row['Create_abonn']); ?> </td>
                                                            <td> <?php echo ($row['Fin_abonn']); ?> </td>
                                                            <td> <?php echo ($row['Qte_livre_abonn']); ?> </td>
                                                            <td><?php if($row['Forfait_abonn']==1){?> <label class="badge badge-success">Payé</label><?php } else{ ?> <label class="badge badge-danger">Non-payé</label> <?php } ?></td>
                                                                 <td>
                                                                <a class="btn btn-primary btn-small" href="details_abonn.php?details_id=<?php if (isset($row['Id_abonn'])) {echo ($row['Id_abonn']);}
                                                                 ;?> ">Details <i class="fa fa-mail-forward"></i></a>
                                                                 </td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>


                                    <div class="card mt-4">
                                        <div class="card-body">
                                           <h4 class="card-title">Abonnés de la bibliotheque</h4>
                                            <p>Cette table contient tous les abonnés de la bibliotheque</p>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Nom abonné</th>
                                                            <th>Prenom abonné</th>
                                                            <th>Type</th>
                                                            <th>Commencement abonnement</th>
                                                            <th>Fin abonnement</th>
                                                            <th>Quantite livres</th>
                                                            <th>Forfait</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
// get all the abonn items
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
$sql = "SELECT * FROM abonnes";
$result = mysqli_query($con, $sql);
mysqli_close($con);

if (isset($result)) {
while ($row = mysqli_fetch_assoc($result)) {?>
                                                        <tr>
                                                        <td> <?php echo ($row['Nom_abonn']); ?> </td>
                                                            <td> <?php echo ($row['Prenom_abonn']); ?> </td>
                                                            <td> <?php if($row['Type_abonn']==1) { ?> <label class="badge badge-warning">étudiant</label> <?php
                                                            }else{ ?> <label class="badge badge-info">Professeur</label> <?php } ?> </td>
                                                            <td> <?php echo ($row['Create_abonn']); ?> </td>
                                                            <td> <?php echo($row['Fin_abonn']); ?> </td>
                                                            <td> <?php echo ($row['Qte_livre_abonn']); ?> </td>
                                                            <td><?php if($row['Forfait_abonn']==1){?> <label class="badge badge-success">Payé</label><?php } else{ ?> <label class="badge badge-danger">Non-payé</label> <?php } ?></td>
                                                                 <td>
                                                                <a class="btn btn-primary btn-small" href="details_abonn.php?details_id=<?php if (isset($row['Id_abonn'])) {echo ($row['Id_abonn']);}
                                                                 ;?> ">Details <i class="fa fa-mail-forward"></i></a>

                                                            </td>
                                                        </tr>
                                                        <?php }}?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- footer -->
                <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_footer.php";?>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- Bootstrap modals -->

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModal">Ajouter element</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--ajouter livre dans la bibliotheque-->
                <div class="modal-body">
                    <form class="form-sample" method="GET" action="./functions/ajouter_livre.php">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Titre livre</label>
                                    <div class="col-sm-9">
                                        <input name="Titre_livre" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom auteur</label>
                                    <div class="col-sm-9">
                                        <input name="Nom_auteur" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Prenom auteur</label>
                                    <div class="col-sm-9">
                                        <input name="Prenom_auteur" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Maison edition</label>
                                    <div class="col-sm-9">
                                        <input name="Maison_edition" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date de sortie</label>
                                    <div class="col-sm-9">
                                        <input name="Date_de_sortie" type="date" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Pages livre</label>
                                    <div class="col-sm-9">
                                        <input name="Pages_livre" type="number" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Code rayon</label>
                                    <div class="col-sm-9">
                                        <input name="Code_rayon" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Categorie</label>
                                    <div class="col-sm-9">
                                        <select name="Categorie_livre" class="form-control" required>
                                            <option value="Roman">Roman</option>
                                            <option value="Sciences">Sciences</option>
                                            <option value="Mode">Mode</option>
                                            <option value="Art">Arts</option>
                                            <option value="sports">Sports</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Quantite</label>
                                    <div class="col-sm-9">
                                        <input name="Qte_livre" type="number" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="addItemSubmitButton" class="btn btn-primary"
                                value="Ajouter element">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_included_scripts.php";?>
</body>

</html>