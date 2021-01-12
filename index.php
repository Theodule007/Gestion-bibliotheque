<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_head.php";?>

<body>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <div class="container-scroller">
        <!-- top navbar -->
        
        <div class="container-fluid page-body-wrapper">

            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Page title header starts -->
                    <div class="row page-title-header">
                        <div class="col-md-12">
                            <div class="page-header-toolbar">
                                <div class="filter-wrapper">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page title header Ends-->

                    <!-- Doughnut chart starts -->
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="p-4 border-bottom bg-light">
                                    <i class='fas fa-group float-left' style='font-size:360px;color:blue'></i>
                                    <i class="fa fa-book float-right" style="font-size:360px;color:blue"></i>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                                        <div class="d-flex pt-3 border-top mt-5">
                                            <div id="doughnut-chart-legend"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Doughnut chart ends -->

                   
                <!-- footer -->
                <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_footer.php";?>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <?php include "{$_SERVER['DOCUMENT_ROOT']}/app/partials/_included_scripts.php";?>
</body>

</html>