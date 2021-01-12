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
                    <!-- page title header ends-->

                    <?php
// Verifier et alerte le gestionnaire qu'il a ajoute un bibliothecaire
if (isset($_GET['add_success'])) {
if ($_GET['add_success'] == 'true') {?>
                    <div class="alert alert-success " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Succes!</strong> Le bibliothecaire a été ajouté.
                 </div>
                     <?php } else {?>
 
                <div class="alert alert-danger " role="alert">
                     
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                     <strong>Erreur!</strong> Le bibliothecaire n'a pas été ajouté.
                  </div>
                    <?php }}?>

                    <?php

//Verfier et alerter le bibliothecaire de la suppression d'un element
if (isset($_GET['delete_success'])) {
if ($_GET['delete_success'] == 'true') {?>
                    <div class="alert alert-success " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Succes!</strong> Le bibliothecaire a été supprimé.
                 </div>
                     <?php } else {?>
 
                <div class="alert alert-danger " role="alert">
                     
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                     <strong>Erreur!</strong> Le bibliothecaire n'a pas été supprimé.
                  </div>
                    <?php }}?>

                    <?php
// check and alert the user if item was updated
if (isset($_GET['update_success'])) {
if ($_GET['update_success'] == 'true') {?>

                <div class="alert alert-success " role="alert">
                    
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                    <strong>Succes!</strong> Le bibliothecaire a été mis a jour.
                 </div>
                     <?php } else {?>
 
                <div class="alert alert-danger " role="alert">
                     
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                     <strong>Erreur!</strong> Le bibliothecaire n'a pas été mis a jour.
                  </div>
                    <?php }}?>

                    <?php
// check and alert the user if item was receive
if (isset($_GET['receive_success'])) {
if ($_GET['receive_success'] == 'true') {?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> The inventory item was received.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } else {?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> There was an error receiving the item.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php }}?>

                    <?php
// check and alert the user if item was distributed
if (isset($_GET['distribute_success'])) {
if ($_GET['distribute_success'] == 'true') {?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Succes!</strong> Un exemplaire a été preté.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } else {?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur!</strong> Le pret ne peut pas etre placé.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php }}?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 grid-margin">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h4 class="card-title">Rechercher Bibliothecaires</h4>
                                                <button data-toggle="modal" data-target="#addItemModal"
                                                    class="btn btn-primary btn-small"><i class="fa fa-plus"></i>Ajouter
                                                    Bibliothecaire</button>
                                            </div>
                                            <!-- <p>This table includes all the inventory items stored in your warehouse</p> -->

                                            <form class="ml-auto search-form d-none d-md-block">
                                                <div class="form-group">
                                                    <input type="text" name="term" class="auto form-control"
                                                        placeholder="Commencer a rechercher par titre du livre">
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
$sql = "SELECT * FROM utilisateus WHERE Nom_user LIKE '$term%' AND Type_user=0";
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
                                                            <th>Nom</th>
                                                            <th>Prenom</th>
                                                            <th>Sexe</th>
                                                            <th>E-mail</th>
                                                            <th>Adresse</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php while ($row = mysqli_fetch_assoc($search_result)) {?>
                                                        <tr>
                                                            
                                                            <td> <?php echo ($row['Nom_user']); ?> </td>
                                                            <td> <?php echo ($row['Prenom_user']); ?> </td>
                                                            <td> <?php echo ($row['Sexe_user']); ?> </td>
                                                            <td> <?php echo ($row['E_mail_user']); ?> </td>
                                                            <td> <?php echo ($row['Adresse_user']); ?> </td>
                                                            
                                                            <td>
                                                                <a class="btn btn-primary btn-small" href="details_bibliothecaire.php?details_id=<?php if (isset($row['Id_user'])) {echo ($row['Id_user']);}
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


                                            <h4 class="card-title">Iventaires des Bibliothecaires</h4>
                                            <p>Cette table contient tous les Bibliothecaires de la bibliotheque</p>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Nom</th>
                                                            <th>Prenom</th>
                                                            <th>Sexe</th>
                                                            <th>E-mail</th>
                                                            <th>Adresse</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
// get all the inventory items
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
$sql = "SELECT * FROM utilisateus WHERE Type_user=0";
$result = mysqli_query($con, $sql);
mysqli_close($con);

if (isset($result)) {
while ($row = mysqli_fetch_assoc($result)) {?>
                                                        <tr>
                                                        <td> <?php echo ($row['Nom_user']); ?> </td>
                                                            <td> <?php echo ($row['Prenom_user']); ?> </td>
                                                            <td> <?php  if(($row['Sexe_user']==0)){
                                                                echo('Feminin');
                                                            }else{echo('Masculin');} ?> </td>
                                                            <td> <?php echo ($row['E_mail_user']); ?> </td>
                                                            <td> <?php echo ($row['Adresse_user']); ?> </td>
                                                            <td>
                                                                <a class="btn btn-primary btn-small" href="details_bibliothecaire.php?details_id=<?php if (isset($row['Id_user'])) {echo ($row['Id_user']);}
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
                    <h5 class="modal-title" id="addItemModal">Ajouter Bibliothecaire</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--ajouter bibliothecaire dans la bibliotheque-->
                <div class="modal-body">
                    <form class="form-sample" method="GET" action="./functions/ajouter_bibliothecaire.php">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                        <input name="Nom_user" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Prenom</label>
                                    <div class="col-sm-9">
                                        <input name="Prenom_user" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input name="Username_user" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mot de passe</label>
                                    <div class="col-sm-9">
                                        <input name="Password_user" type="password" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Sexe</label>
                                    <div class="col-sm-9">
                                    <select name="Sexe_user" class="form-control" required>
                                            <option value="clothing">Masculin</option>
                                            <option value="household">Feminin</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">E-mail</label>
                                    <div class="col-sm-9">
                                        <input name="E_mail_user" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Adresse</label>
                                    <div class="col-sm-9">
                                        <input name="Adresse_user" type="text" class="form-control" required />
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