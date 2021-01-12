<?php require_once('../database/db_credentials.php'); ?>
<?php
// check si la form dans gestion_livre a ete evoqué
if(isset($_GET['addItemSubmitButton'])){
// check si le bibliothecaire a tout rempli
if(isset($_GET['Nom_abonn']) && isset($_GET['Prenom_abonn']) && isset($_GET['E_mail_abonn']) && isset($_GET['Adresse_abonn']) && isset($_GET['Type_abonn']) && isset($_GET['Fin_abonn']))
{
// sanitize the input data and assign variables
$Nom_abonn = filter_var($_GET['Nom_abonn'], FILTER_SANITIZE_STRING);
$Prenom_abonn = filter_var($_GET['Prenom_abonn'], FILTER_SANITIZE_STRING);
$E_mail_abonn = filter_var($_GET['E_mail_abonn'], FILTER_SANITIZE_STRING);
$Adresse_abonn = filter_var($_GET['Adresse_abonn'], FILTER_SANITIZE_STRING);
$Type_abonn = filter_var($_GET['Type_abonn'], FILTER_SANITIZE_STRING);
$Fin_abonn = filter_var($_GET['Fin_abonn'], FILTER_SANITIZE_STRING);
// Etablir connexion a la base de donnees
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// check erreur de connexion
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
// definir la requete SQL
$sql = "INSERT INTO abonnes (Nom_abonn,Prenom_abonn,E_mail_abonn,Adresse_abonn,Type_abonn,Fin_abonn,Qte_livre_abonn,Forfait_abonn) VALUES ('$Nom_abonn','$Prenom_abonn','$E_mail_abonn','$Adresse_abonn','$Type_abonn','$Fin_abonn',0,1)";
$new_url = '../Page_gestionnaire.php?add_success=true';
// Si l'abonné a ete bien ajoute
if (mysqli_query($con, $sql)) { header('Location: '.$new_url);

} else {
// si l'ajout a echoué
$new_url = '../Page_gestionnaire.php?add_success=false';
header('Location: '.$new_url);
}
// close the db connection
mysqli_close($con);
}

}
?>