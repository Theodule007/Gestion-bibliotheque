<?php require_once './database/db_credentials.php'; ?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_head.php";?>

<body>
    <div class="container-scroller">
        <!-- top navbar -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_top_navbar.php";?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- sidebar nav -->
            <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_sidebar.php";?>
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
                        <strong>Success!</strong> The inventory item was deleted.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } else { ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> There was an error deleting the item.
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
$sql = "SELECT * FROM inventory_items WHERE id = '$id' LIMIT 1";
$search_result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($search_result);
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
                                                <h4 class="card-title">Inventory Item Details</h4>
                                                <a href="./functions/delete_item.php?delete_id=<?php echo($id);?>"
                                                    class="btn btn-danger btn-small"><i class="fa fa-trash-o"></i>Delete
                                                    Item</a>
                                                <button data-toggle="modal" data-target="#receiveItemModal"
                                                    class="btn btn-info btn-small"><i
                                                        class="fa fa-arrow-down"></i>Receive Item</button>
                                                <button data-toggle="modal" data-target="#distributeItemModal"
                                                    class="btn btn-info btn-small"><i
                                                        class="fa fa-arrow-up"></i>Distribute Item</button>
                                            </div>

                                            <!--faire une mise a jour-->
                                            <form class="form-sample" method="GET" action="./functions/update_item.php">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">UPC</label>
                                                            <div class="col-sm-9">
                                                                <input name="item_id" type="number" class="form-control"
                                                                    value="<?php if(isset($row['id'])){echo($row['id']);} ?>"
                                                                    hidden />
                                                                <input name="item_upc" type="number"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['upc'])){echo($row['upc']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Item Name</label>
                                                            <div class="col-sm-9">
                                                                <input name="item_name" type="text" class="form-control"
                                                                    value="<?php if(isset($row['item_name'])){echo($row['item_name']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Item Desc</label>
                                                            <div class="col-sm-9">
                                                                <input name="item_desc" type="text" class="form-control"
                                                                    value="<?php if(isset($row['item_desc'])){echo($row['item_desc']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Category</label>
                                                            <div class="col-sm-9">
                                                                <select name="item_category" class="form-control"
                                                                    required>
                                                                    <option selected
                                                                        value="<?php if(isset($row['category'])){echo($row['category']);}?>">
                                                                        <?php if(isset($row['category'])){echo($row['category']);}?>
                                                                    </option>
                                                                    <option value="clothing">Clothing</option>
                                                                    <option value="household">Household</option>
                                                                    <option value="stationery">Stationery</option>
                                                                    <option value="electronics">Electronics</option>
                                                                    <option value="sports">Sports</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Quantity</label>
                                                            <div class="col-sm-9">
                                                                <input name="item_quantity" type="number"
                                                                    class="form-control"
                                                                    value="<?php if(isset($row['quantity'])){echo($row['quantity']);} ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="manage_inventory.php" type="button"
                                                        class="btn btn-secondary">Cancel</a>
                                                    <input type="submit" name="updateItemSubmitButton"
                                                        class="btn btn-primary" value="Update Item">
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
                    <h5 class="modal-title" id="distributeItemModal">Distribute Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-sample" method="GET" action="./functions/distribute_item.php">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Quantity to Distribute</label>
                                    <div class="col-sm-8">
                                        <input name="item_id" type="number" class="form-control"
                                            value="<?php if(isset($row['id'])){echo($row['id']);} ?>" hidden />
                                        <input name="item_category" type="text" class="form-control"
                                            value="<?php if(isset($row['category'])){echo($row['category']);} ?>"
                                            hidden />
                                        <input name="item_quantity" type="number" class="form-control"
                                            value="<?php if(isset($row['quantity'])){echo($row['quantity']);} ?>"
                                            hidden />
                                        <input name="quantity_distributed" type="number" class="form-control"
                                            required />
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