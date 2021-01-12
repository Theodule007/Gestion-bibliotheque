<?php require_once('../database/db_credentials.php'); ?>
<?php
// check if the form was submitted
if(isset($_GET['updateItemSubmitButton'])){
// check if the user filled out sll the fields
if(isset($_GET['Id_abonn']) && isset($_GET['Nom_abonn']) && isset($_GET['Prenom_abonn']) && isset($_GET['Type_abonn']) && isset($_GET['Create_abonn']) && isset($_GET['Fin_abonn']) && isset($_GET['Forfait_abonn'])) {
// sanitize the input data and assign variables
$Id_abonn= filter_var($_GET['Id_abonn'], FILTER_SANITIZE_STRING);
$Nom_abonn = filter_var($_GET['Nom_abonn'], FILTER_SANITIZE_STRING);
$Prenom_abonn = filter_var($_GET['Prenom_abonn'], FILTER_SANITIZE_STRING);
$Type_abonn = filter_var($_GET['Type_abonn'], FILTER_SANITIZE_STRING);
$Create_abonn = filter_var($_GET['Create_abonn'], FILTER_SANITIZE_STRING);
$Fin_abonn = filter_var($_GET['Fin_abonn'], FILTER_SANITIZE_STRING);
$Forfait_abonn = filter_var($_GET['Forfait_abonn'], FILTER_SANITIZE_STRING);
if ($Forfait_abonn=="Payé"){$forfait=1;}else{$forfait=0;}
// Etablir connexion a la base de donnees
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// check erreur de connexion
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}

// define the SQL query to update the item in the inventory_items table
$sql = "UPDATE abonnes SET Nom_abonn='$Nom_abonn', Prenom_abonn='$Prenom_abonn', Type_abonn='$Type_abonn', Create_abonn='$Create_abonn', Fin_abonn='$Fin_abonn', Forfait_abonn='$forfait' WHERE Id_abonn=$Id_abonn";
// if the record was successfully updated
if (mysqli_query($con, $sql)) {
$new_url = '../Page_gestionnaire.php?update_success=true';
header('Location: '.$new_url);

} else {
// if the record failed to be updated
$new_url = '../Page_gestionnaire.php?update_success=false';
header('Location: '.$new_url);

}
// close the db connection
mysqli_close($con);
}

}
?>