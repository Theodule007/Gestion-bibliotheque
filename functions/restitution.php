<?php require_once('../database/db_credentials.php'); ?>
<?php
// cehck if the form was submitted
if(isset($_GET['receiveItemSubmitButton'])){
// check if the user filled out all the fields
if(isset($_GET['Id_livre']) && isset($_GET['Id_abonn'])) {
// sanitize the input data and assign variables
$Id_abonn = filter_var($_GET['Id_abonn'], FILTER_SANITIZE_STRING);
$Id_livre = filter_var($_GET['Id_livre'], FILTER_SANITIZE_STRING);
$quantity_received = 1;
// make connection to db
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// check for db connection errors //
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}

$sql_check = "DELETE FROM preter_livres WHERE Id_abonn='$Id_abonn' AND id_livre='$Id_livre'";
$result = mysqli_query($con, $sql_check);

$sql_update_receive_quantity = "UPDATE livres SET Qte_livre=Qte_livre+'$quantity_received' WHERE Id_livre='$Id_livre'";
mysqli_query($con, $sql_update_receive_quantity);

$sql_remise_abonn = "UPDATE abonnes SET Qte_livre_abonn=Qte_livre_abonn-'$quantity_received' WHERE Id_abonn='$Id_abonn'";


// if the record was successfully updated
if (mysqli_query($con, $sql_remise_abonn) ) {
$new_url = '../gestion_abonn.php?receive_success=true';
header('Location: '.$new_url);

} else {
// if the record failed to be added
$new_url = '../gestion_abonn.php?receive_success=false';
header('Location: '.$new_url);

}
// close the db connection
mysqli_close($con);
}

}
?>