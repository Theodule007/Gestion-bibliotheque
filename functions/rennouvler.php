<?php require_once('../database/db_credentials.php'); ?>
<?php
//definir les dates de debut et de fin d'abonnement
$date = date("Y-m-d H:i:s");
$date_fin = strtotime($date);
$date_fin = strtotime("+ 1 year", $date_fin);
$date_fin=date('Y-m-d H:i:s', $date_fin);

if(isset($_GET['abonn_id'])){
    $id=filter_var($_GET['abonn_id'], FILTER_SANITIZE_STRING);

    // make connection to db
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    // check for db connection errors
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }

    $sql="UPDATE abonnes SET Create_abonn='$date', Fin_abonn='$date_fin', Forfait_abonn=1 WHERE Id_abonn=$id";
    
    if (mysqli_query($con, $sql)) {
        $url = '../Page_gestionnaire.php?renew_success=true';
        header('Location: '.$url);
        
        } else {
        // if the record failed to be updated
        $url = '../Page_gestionnaire.php?renew_success=false';
        header('Location: '.$url);
        
        }
}



?>