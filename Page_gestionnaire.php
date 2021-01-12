<?php session_start(); ?>
<?php require_once './database/db_credentials.php';?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_head.php";?>

<body>
    <div class="container-scroller">
        <!-- top navbar -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_top_navbar_gest.php";?>
        <div class="container-fluid page-body-wrapper">
            <!-- sidebar nav -->
            <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_sidebar_gest.php";?>
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
// check and alerte le gestionnaire de l'ajout d'un abonne
if (isset($_GET['add_success'])) {
if ($_GET['add_success'] == 'true') {?>
                <div class="alert alert-success " role="alert">
                    
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                   <strong>Succes!</strong> L'element a été ajouté.
                </div>
                    <?php } else {?>

                        <div class="alert alert-danger " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Erreur!</strong> L'element n'a pas été ajouté.
                 </div>
                    <?php }}?>

                    <?php
// check and alert the user if item was updated
if (isset($_GET['update_success'])) {
if ($_GET['update_success'] == 'true') {?>
                <div class="alert alert-success " role="alert">
                    
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                   <strong>Succes!</strong> L'element a ete mis a jour.
                </div>
                    <?php } else {?>

                        <div class="alert alert-danger " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Erreur!</strong> L'element n'a pas ete mis a jour.
                 </div>
                    <?php }}?>

                    <?php
                    // check et alerte d'un renouvellement d'un abonne
if (isset($_GET['renew_success'])) {
if ($_GET['renew_success'] == 'true') {?>
                     <div class="alert alert-success " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Succes!</strong> L'abonnement a été rennouvelé.
                 </div>
                    <?php } else {?>

                        <div class="alert alert-danger " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Erreur!</strong> L'abonnement n'a pas été rennnouvelé.
                 </div>
                    <?php }}?>

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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 grid-margin">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h4 class="card-title">Rechercher Abonnés</h4>
                                                <button data-toggle="modal" data-target="#addItemModal"
                                                    class="btn btn-primary btn-small"><i class="fa fa-plus"></i>Ajouter
                                                    Abonné</button>
                                            </div>
                                            <!-- <p>This table includes all the inventory items stored in your warehouse</p> -->

                                            <form class="ml-auto search-form d-none d-md-block" >
                                                <div class="form-group">
                                                    <input type="text" name="term" id="search_nom" class="form-control"
                                                        placeholder="Commencer a rechercher par nom abonné">
                                                    <button class="btn btn-primary btn-small mt-3" type="submit"
                                                        name="submitButton"><i
                                                            class="fa fa-search"></i>Recherche</button>
                                                </div>
                                                <script type="text/javascript">
                                                        $(function() {
                                                            $( "#search_nom" ).autocomplete({
                                                            source: './functions/auto_search_abonnes.php',
                                                            });
                                                        });
                                                        </script>
  
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
                                                            <td><?php if($row['Forfait_abonn']==1){?> <label class="badge badge-success">Payé</label><?php } else{ ?> <label class="badge badge-danger">Non-payé</label> <?php } ?></td>
                                                                 <td>
                                                                <a class="btn btn-primary btn-small" href="details_abonn_gest.php?details_id=<?php if (isset($row['Id_abonn'])) {echo ($row['Id_abonn']);}
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
                                                            <td><?php if($row['Forfait_abonn']==1){?> <label class="badge badge-success">Payé</label><?php } else{ ?> <label class="badge badge-danger">Non-payé</label> <?php } ?></td>
                                                                 <td>
                                                                <a class="btn btn-primary btn-small" href="details_abonn_gest.php?details_id=<?php if (isset($row['Id_abonn'])) {echo ($row['Id_abonn']);}
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
                    <h5 class="modal-title" id="addItemModal">Ajouter Abonné</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--ajouter Abonne dans la bibliotheque par le gestionnaire-->
                <div class="modal-body">
                    <form class="form-sample" method="GET" action="./functions/ajouter_abonne.php">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                        <input name="Nom_abonn" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Prenom</label>
                                    <div class="col-sm-9">
                                        <input name="Prenom_abonn" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">E-mail</label>
                                    <div class="col-sm-9">
                                        <input name="E_mail_abonn" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Adresse</label>
                                    <div class="col-sm-9">
                                        <input name="Adresse_abonn" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Type</label>
                                    <div class="col-sm-9">
                                            <select name="Type_abonn" class="form-control" required>
                                            <option value="1">Etudiant</option>
                                            <option value="0">Professeur</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>


                           
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Fin abonnement</label>
                                    <div class="col-sm-9">
                                        <input name="Fin_abonn" type="date" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <input type="submit" name="addItemSubmitButton" class="btn btn-primary"
                                value="Ajouter Abonné">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_included_scripts.php";?>
</body>

</html>