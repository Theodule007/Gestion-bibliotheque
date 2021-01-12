<?php require_once('../database/db_credentials.php'); ?>
<?php
// check if the form was submitted
if(isset($_GET['updateItemSubmitButton'])){
// check if the user filled out sll the fields
if(isset($_GET['Id_user']) && isset($_GET['Nom_user']) && isset($_GET['Prenom_user']) && isset($_GET['Sexe_user']) && isset($_GET['E_mail_user']) && isset($_GET['Adresse_user'])) {
// sanitize the input data and assign variables
$Id_user= filter_var($_GET['Id_user'], FILTER_SANITIZE_STRING);
$Nom_user = filter_var($_GET['Nom_user'], FILTER_SANITIZE_STRING);
$Prenom_user = filter_var($_GET['Prenom_user'], FILTER_SANITIZE_STRING);
$Sexe_user = filter_var($_GET['Sexe_user'], FILTER_SANITIZE_STRING);
$E_mail_user = filter_var($_GET['E_mail_user'], FILTER_SANITIZE_STRING);
$Adresse_user = filter_var($_GET['Adresse_user'], FILTER_SANITIZE_STRING);
if ($Sexe_user=="Masculin"){$sexe=1;}else{$sexe=0;}
// Etablir connexion a la base de donnees
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// check erreur de connexion
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}

// define the SQL query to update the item in the inventory_items table
$sql = "UPDATE utilisateus SET Nom_user='$Nom_user', Prenom_user='$Prenom_user', Sexe_user='$sexe', E_mail_user='$E_mail_user',Adresse_user='$Adresse_user' WHERE Id_user=$Id_user";
// if the record was successfully updated
if (mysqli_query($con, $sql)) {
$new_url = '../gestion_bibliothecaire.php?update_success=true';
header('Location: '.$new_url);

} else {
// if the record failed to be updated
$new_url = '../gestion_bibliothecaire.php?update_success=false';
header('Location: '.$new_url);

}
// close the db connection
mysqli_close($con);
}

}
?>