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
                    <!-- page title header ends-->

                    <?php
// check and alert the user if item was added
if (isset($_GET['add_success'])) {
if ($_GET['add_success'] == 'true') {?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> The inventory item was created.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } else {?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> There was an error creating the item.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php }}?>

                    <?php
// check and alert the user if item was deleted
if (isset($_GET['delete_success'])) {
if ($_GET['delete_success'] == 'true') {?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> The inventory item was deleted.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } else {?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> There was an error deleting the item.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php }}?>

                    <?php
// check and alert the user if item was updated
if (isset($_GET['update_success'])) {
if ($_GET['update_success'] == 'true') {?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> The inventory item was updated.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } else {?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> There was an error updating the item.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                        <strong>Success!</strong> The inventory item was distributed.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } else {?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> There was an error distributing the item.
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
                                                <h4 class="card-title">Lookup Inventory Items</h4>
                                                <button data-toggle="modal" data-target="#addItemModal"
                                                    class="btn btn-primary btn-small"><i class="fa fa-plus"></i>Add
                                                    Item</button>
                                            </div>
                                            <!-- <p>This table includes all the inventory items stored in your warehouse</p> -->

                                            <form class="ml-auto search-form d-none d-md-block">
                                                <div class="form-group">
                                                    <input type="text" name="term" class="auto form-control"
                                                        placeholder="Start typing to lookup inventory item by name">
                                                    <button class="btn btn-primary btn-small mt-3" type="submit"
                                                        name="submitButton"><i class="fa fa-search"></i>Lookup</button>
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
$sql = "SELECT * FROM inventory_items WHERE item_name LIKE '$term%'";
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
                                                            <th>Item id</th>
                                                            <th>UPC</th>
                                                            <th>Item Name</th>
                                                            <th>Item Desc</th>
                                                            <th>Item Category</th>
                                                            <th>Item Quantity</th>
                                                            <th>Date Modified</th>
                                                            <th>Quick Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php while ($row = mysqli_fetch_assoc($search_result)) {?>
                                                        <tr>
                                                            <td> <?php echo ($row['id']); ?> </td>
                                                            <td> <?php echo ($row['upc']); ?> </td>
                                                            <td> <?php echo ($row['item_name']); ?> </td>
                                                            <td> <?php echo ($row['item_desc']); ?> </td>
                                                            <td> <?php echo ($row['category']); ?> </td>
                                                            <td> <?php echo ($row['quantity']); ?> </td>
                                                            <td> <?php echo ($row['last_modified']); ?> </td>
                                                            <td>
                                                                <a class="btn btn-primary btn-small"
                                                                    href="item_details.php?details_id=<?php echo ($row['id']); ?> ">Details
                                                                    <i class="fa fa-mail-forward"></i></a>

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

                                            <h4 class="card-title">Stored Inventory Items</h4>
                                            <p>This table includes all the inventory items stored in your warehouse</p>

                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Item id</th>
                                                            <th>UPC</th>
                                                            <th>Item Name</th>
                                                            <th>Item Desc</th>
                                                            <th>Item Category</th>
                                                            <th>Item Quantity</th>
                                                            <th>Date Modified</th>
                                                            <th>Quick Actions</th>
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
$sql = "SELECT * FROM inventory_items";
$result = mysqli_query($con, $sql);
mysqli_close($con);

if (isset($result)) {
while ($row = mysqli_fetch_assoc($result)) {?>
                                                        <tr>
                                                            <td> <?php echo ($row['id']); ?> </td>
                                                            <td> <?php echo ($row['upc']); ?> </td>
                                                            <td> <?php echo ($row['item_name']); ?> </td>
                                                            <td> <?php echo ($row['item_desc']); ?> </td>
                                                            <td> <?php echo ($row['category']); ?> </td>
                                                            <td> <?php echo ($row['quantity']); ?> </td>
                                                            <td> <?php echo ($row['last_modified']); ?> </td>
                                                            <td>
                                                                <a class="btn btn-primary btn-small" href="item_details.php?details_id=<?php if (isset($row['id'])) {echo ($row['id']);}
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
                    <h5 class="modal-title" id="addItemModal">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-sample" method="GET" action="./functions/add_item.php">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">UPC</label>
                                    <div class="col-sm-9">
                                        <input name="item_upc" type="number" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Item Name</label>
                                    <div class="col-sm-9">
                                        <input name="item_name" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Item Desc</label>
                                    <div class="col-sm-9">
                                        <input name="item_desc" type="text" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select name="item_category" class="form-control" required>
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
                                        <input name="item_quantity" type="number" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="addItemSubmitButton" class="btn btn-primary" value="Add Item">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_included_scripts.php";?>
</body>

</html>