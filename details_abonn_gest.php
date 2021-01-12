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
if(isset($_GET['details_id'])){
$id = $_GET['details_id'];
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
$sql = "SELECT * FROM abonnes WHERE Id_abonn = '$id' LIMIT 1";
$search_result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($search_result);

$sql_abonn = "SELECT * FROM abonnes";
$search_result_abonn = mysqli_query($con, $sql_abonn);
$row_abonn = mysqli_fetch_assoc($search_result_abonn);

}
?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h4 class="card-title">Details sur l'abonné</h4>
                                                        <a href="./functions/rennouvler.php?abonn_id=<?php echo($id);?>"
                                                    class="btn btn-secondary btn-small"><i
                                                        class="fa fa-level-up"></i>Renouveler</a>
                                                <button data-toggle="modal" data-target="#distributeItemModal"
                                                    class="btn btn-warning btn-small"><i class="fa fa-arrow-up"></i>Relancer</button>
                                            </div>

                                            <form class="form-sample" method="GET" action="./functions/modifier_abonn.php">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Nom</label>
                                                            <div class="col-sm-3">
                                                                <input name="Id_abonn" type="number"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Id_abonn'])){echo($row['Id_abonn']);} ?>"
                                                                    hidden />
                                                                <input name="Nom_abonn" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Nom_abonn'])){echo($row['Nom_abonn']);} ?>"
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
                                                                <input name="Prenom_abonn" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Prenom_abonn'])){echo($row['Prenom_abonn']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Type</label>
                                                            <div class="col-sm-3">
                                                                <input name="Type_abonn" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Type_abonn'])){echo($row['Type_abonn']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Commencement abonnement</label>
                                                            <div class="col-sm-3">
                                                                <input name="Create_abonn" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Create_abonn'])){echo($row['Create_abonn']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Fin abonnement</label>
                                                            <div class="col-sm-3">
                                                                <input name="Fin_abonn" type="text"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['Fin_abonn'])){echo($row['Fin_abonn']);} ?>"
                                                                    required />
                                                            </div>
                                                          

                                                        </div>

                                                    </div>

                                    <?php if($row['Forfait_abonn']==1) 
                                    {?>

                                       <label class="col-sm-3 col-form-label">Forfait</label>
                                            <div class="col-sm-3">
                                                <input name="Forfait_abonn" type="text" class="form-control" value="Payé" required />
                                             </div>
                                   <?php }    else{ ?>  
                                    
                                        <label class="col-sm-3 col-form-label">Forfait</label>
                                            <div class="col-sm-3">
                                                <input name="Forfait_abonn" type="text" class="form-control" value="Non Payé" required />
                                             </div>
                                                    <?php }?>  
                                                           
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="Page_gestionnaire.php" type="button"
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
    <!-- Distribute Item Modal -->
    <div class="modal fade" id="distributeItemModal" tabindex="-1" role="dialog" aria-labelledby="distributeItemModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="distributeItemModal">Relancer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-sample" method="POST" action="./functions/Relancer.php">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
  
                                            <input name="E_mail_abonn" type="text" class="form-control"
                                            value="<?php if(isset($row['E_mail_abonn'])){echo($row['E_mail_abonn']);} ?>"
                                            require />
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="distributeItemSubmitButton1" class="btn btn-primary"
                                value="Relancer">
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