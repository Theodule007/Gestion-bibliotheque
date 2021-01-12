<?php require_once('../database/db_credentials.php'); ?>
<?php
// check if the form was submitted
if(isset($_GET['updateItemSubmitButton'])){
// check if the user filled out sll the fields
if(isset($_GET['Id_livre']) && isset($_GET['Titre_livre']) && isset($_GET['Nom_auteur']) && isset($_GET['Prenom_auteur']) && isset($_GET['Maison_edition']) && isset($_GET['Date_de_sortie']) && isset($_GET['Pages_livre']) && isset($_GET['Code_rayon']) && isset($_GET['Categorie_livre']) && isset($_GET['Qte_livre'])
 ) {
// sanitize the input data and assign variables
$Id_livre= filter_var($_GET['Id_livre'], FILTER_SANITIZE_STRING);
$Titre_livre = filter_var($_GET['Titre_livre'], FILTER_SANITIZE_STRING);
$Nom_auteur = filter_var($_GET['Nom_auteur'], FILTER_SANITIZE_STRING);
$Prenom_auteur = filter_var($_GET['Prenom_auteur'], FILTER_SANITIZE_STRING);
$Maison_edition = filter_var($_GET['Maison_edition'], FILTER_SANITIZE_STRING);
$Date_de_sortie = filter_var($_GET['Date_de_sortie'], FILTER_SANITIZE_STRING);
$Pages_livre = filter_var($_GET['Pages_livre'], FILTER_SANITIZE_STRING);
$Code_rayon = filter_var($_GET['Code_rayon'], FILTER_SANITIZE_STRING);
$Categorie_livre = filter_var($_GET['Categorie_livre'], FILTER_SANITIZE_STRING);
$Qte_livre = filter_var($_GET['Qte_livre'], FILTER_SANITIZE_STRING);
// Etablir connexion a la base de donnees
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// check erreur de connexion
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}

// define the SQL query to update the item in the inventory_items table
$sql = "UPDATE livres SET Titre_livre='$Titre_livre', Nom_auteur='$Nom_auteur', Prenom_auteur='$Prenom_auteur', Maison_edition='$Maison_edition', Date_de_sortie='$Date_de_sortie',
 Pages_livre='$Pages_livre', Code_rayon='$Code_rayon', Categorie_livre='$Categorie_livre', Qte_livre='$Qte_livre' WHERE Id_livre=$Id_livre";
// if the record was successfully updated
if (mysqli_query($con, $sql)) {
$new_url = '../gestion_livre.php?update_success=true';
header('Location: '.$new_url);

} else {
// if the record failed to be updated
$new_url = '../gestion_livre.php?update_success=false';
header('Location: '.$new_url);

}
// close the db connection
mysqli_close($con);
}

}
?>