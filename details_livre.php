<?php session_start(); ?>
<?php require_once('./database/db_credentials.php'); ?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include("{$_SERVER['DOCUMENT_ROOT']}/app/partials/_head.php");?>

<body>
    <div class="container-scroller">
        <!-- top navbar -->
        <?php include("{$_SERVER['DOCUMENT_ROOT']}/app/partials/_top_navbar.php");?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- sidebar nav -->
            <?php include("{$_SERVER['DOCUMENT_ROOT']}/app/partials/_sidebar.php");?>
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
                        <strong>Succes!</strong> Le livre a été supprimé.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } else { ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Desolé le livre n'a pas été supprimé.
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
$sql = "SELECT * FROM livres WHERE Id_livre = '$id' LIMIT 1";
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
                                                <h4 class="card-title">Details sur le livre</h4>
                                          
                                                <?php if($row['Qte_livre']==0) { ?>
                                                    <button data-toggle="modal" data-target="#distributeItemModal"
                                                    class="btn btn-info btn-small addMore" title="Il n'y a plus ce livre" disabled ><i class="fa fa-arrow-up"></i>Preter
                                                    Livre</button>
                                               <?php } else{?>
                                                <button data-toggle="modal" data-target="#distributeItemModal"
                                                    class="btn btn-info btn-small"><i class="fa fa-arrow-up"></i>Preter
                                                    Livre</button>
                                                    <?php } ?>
                                                
                                            </div>

                                            <form class="form-sample" method="GET"
                                                action="./functions/modifier_livre.php">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Titre Livre</label>
                                                            <div class="col-sm-9">
                                                                <input name="Id_livre" type="number"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Id_livre'])){echo($row['Id_livre']);} ?>"
                                                                    hidden />
                                                                <input name="Titre_livre" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Titre_livre'])){echo($row['Titre_livre']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Nom auteur</label>
                                                            <div class="col-sm-3">
                                                                <input name="Nom_auteur" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Nom_auteur'])){echo($row['Nom_auteur']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Prenom auteur</label>
                                                            <div class="col-sm-3">
                                                                <input name="Prenom_auteur" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Prenom_auteur'])){echo($row['Prenom_auteur']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Pages</label>
                                                            <div class="col-sm-3">
                                                                <input name="Pages_livre" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Pages_livre'])){echo($row['Pages_livre']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Date de
                                                                sortie</label>
                                                            <div class="col-sm-3">
                                                                <input name="Date_de_sortie" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Date_de_sortie'])){echo($row['Date_de_sortie']);} ?>"
                                                                    required />
                                                            </div>
                                                            <label class="col-sm-3 col-form-label">Code rayon</label>
                                                            <div class="col-sm-3">
                                                                <input name="Code_rayon" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Code_rayon'])){echo($row['Code_rayon']);} ?>"
                                                                    required />
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Masion
                                                                d'Edition</label>
                                                            <div class="col-sm-9">
                                                                <input name="Maison_edition" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Maison_edition'])){echo($row['Maison_edition']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Categorie</label>
                                                            <div class="col-sm-3">
                                                                <select name="Categorie_livre" class="form-control"
                                                                    required>
                                                                    <option selected
                                                                        value="<?php if(isset($row['Categorie_livre'])){echo($row['Categorie_livre']);}?>">
                                                                        <?php if(isset($row['Categorie_livre'])){echo($row['Categorie_livre']);}?>
                                                                    </option>
                                                                    <option value="Roman">Roman</option>
                                                                    <option value="Sciences">Sciences</option>
                                                                    <option value="Mode">Mode</option>
                                                                    <option value="Art">Arts</option>
                                                                    <option value="sports">Sports</option>
                                                                </select>
                                                            </div>

                                                            <label class="col-sm-3 col-form-label">Quantite</label>
                                                            <div class="col-sm-3">
                                                                <input name="Qte_livre" type="number"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Qte_livre'])){echo($row['Qte_livre']);} ?>"
                                                                    required />
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="gestion_livre.php" type="button"
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