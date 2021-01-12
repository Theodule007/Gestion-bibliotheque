<?php session_start(); ?>
<?php require_once('./database/db_credentials.php'); ?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include("{$_SERVER['DOCUMENT_ROOT']}/app/partials/_head.php");?>

<body>
    <div class="container-scroller">
        <!-- top navbar -->
        <?php include("{$_SERVER['DOCUMENT_ROOT']}/app/partials/_top_navbar_gest.php");?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- sidebar nav -->
            <?php include("{$_SERVER['DOCUMENT_ROOT']}/app/partials/_sidebar_gest.php");?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- page title header starts-->
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
if(isset($_GET['delete_success'])) {
if($_GET['delete_success'] == 'true') { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Succes!</strong> Le Bibliothecaire a été supprimé.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } else { ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Desolé le Bibliothecaire n'a pas été supprimé.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } } ?>

                    <?php
if(isset($_GET['details_id'])){
$id = $_GET['details_id'];
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
$sql = "SELECT * FROM utilisateus WHERE Id_user = '$id' LIMIT 1";
$search_result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($search_result);
$sql_abonn = "SELECT * FROM abonnes";
$search_result_abonn = mysqli_query($con, $sql_abonn);
$row_abonn = mysqli_fetch_assoc($search_result_abonn);
mysqli_close($con);
}
?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h4 class="card-title">Details sur le bibliothecaire</h4>
                                                <a href="./functions/delete_biblio.php?delete_id=<?php echo($id);?>"
                                                    class="btn btn-danger btn-small"><i
                                                        class="fa fa-trash-o float-right"></i>Effacer bibliothecaire</a>
                                              
                                            </div>

                                            <form class="form-sample" method="GET"
                                                action="./functions/modifier_bibliothecaire.php">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Nom</label>
                                                            <div class="col-sm-3">
                                                                <input name="Id_user" type="number"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Id_user'])){echo($row['Id_user']);} ?>"
                                                                    hidden />
                                                                <input name="Nom_user" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Nom_user'])){echo($row['Nom_user']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Prenom</label>
                                                            <div class="col-sm-3">
                                                                <input name="Prenom_user" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Prenom_user'])){echo($row['Prenom_user']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Sexe</label>
                                                            <div class="col-sm-3">
                                                                <input name="Sexe_user" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Sexe_user'])){
                                                                        if(($row['Sexe_user']==0)){echo"Feminin";}else{echo "Masculin";}} ?>"
                                                                    required />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">E-mail</label>
                                                            <div class="col-sm-3">
                                                                <input name="E_mail_user" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['E_mail_user'])){echo($row['E_mail_user']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Adresse</label>
                                                            <div class="col-sm-3">
                                                                <input name="Adresse_user" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Adresse_user'])){echo($row['Adresse_user']);} ?>"
                                                                    required />
                                                            </div>
                                                           

                                                        </div>

                                                    </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="gestion_bibliothecaire.php" type="button"
                                                        class="btn btn-secondary">Annuler</a>
                                                    <input type="submit" name="updateItemSubmitButton"
                                                        class="btn btn-primary" value="Modifier">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- footer -->
                <?php include("{$_SERVER['DOCUMENT_ROOT']}/app/partials/_footer.php");?>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- bootstrap modals -->

    <!-- receive item modal -->
    <div class="modal fade" id="receiveItemModal" tabindex="-1" role="dialog" aria-labelledby="receiveItemModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="receiveItemModal">Receive Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-sample" method="GET" action="./functions/receive_item.php">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Quantity Received</label>
                                    <div class="col-sm-8">
                                        <input name="item_id" type="number" class="form-control"
                                            value="<?php if(isset($row['id'])){echo($row['id']);} ?>" hidden />
                                        <input name="item_category" type="text" class="form-control"
                                            value="<?php if(isset($row['category'])){echo($row['category']);} ?>"
                                            hidden />
                                        <input name="item_quantity" type="number" class="form-control"
                                            value="<?php if(isset($row['quantity'])){echo($row['quantity']);} ?>"
                                            hidden />
                                        <input name="quantity_received" type="number" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="receiveItemSubmitButton" class="btn btn-primary"
                                value="Receive Item">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribute Item Modal -->
    <div class="modal fade" id="distributeItemModal" tabindex="-1" role="dialog" aria-labelledby="distributeItemModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="distributeItemModal">Pret de livre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-sample" method="GET" action="./functions/Emprunt.php">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Nom Abonné</label>
                                    <div class="col-sm-8">
                                        <select name="Id_abonn" class="form-control" required>
                                            <?php 
foreach($search_result_abonn as $un_abonne)
{
    ?>
                                            <option selected value="<?php echo($un_abonne['Id_abonn']);?>">
                                                <?php echo($un_abonne['Prenom_abonn'].'           ' .$un_abonne['Nom_abonn'].' ' .$un_abonne['Id_abonn']);?>
                                            </option>
                                                
                                            <?php
}
?>                                          
                                         
                                        
                                        <input name="Id_livre" type="number" class="form-control"
                                            value="<?php if(isset($row['Id_livre'])){echo($row['Id_livre']);} ?>"
                                            hidden />
                                        <input name="Titre_livre" type="text" class="form-control"
                                            value="<?php if(isset($row['Titre_livre'])){echo($row['Titre_livre']);} ?>"
                                            hidden />
                                        <input name="Qte_livre" type="number" class="form-control"
                                            value="<?php if(isset($row['Qte_livre'])){echo($row['Qte_livre']);} ?>"
                                            hidden />
                                      

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>



                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="distributeItemSubmitButton" class="btn btn-primary"
                                value="Distribute Item">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Item Modal -->
    <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemModal">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Update Item</button>
                </div>
            </div>
        </div>
    </div>
    <?php include("{$_SERVER['DOCUMENT_ROOT']}/app/partials/_included_scripts.php");?>
</body>

</html>