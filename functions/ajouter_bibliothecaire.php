<?php require_once('../database/db_credentials.php'); ?>
<?php
// check si la form dans gestion_livre a ete evoqué
if(isset($_GET['addItemSubmitButton'])){
// check si le bibliothecaire a tout rempli
if(isset($_GET['Nom_user']) && isset($_GET['Prenom_user']) && isset($_GET['Username_user']) && isset($_GET['Password_user']) && isset($_GET['Sexe_user']) && isset($_GET['E_mail_user']) && isset($_GET['Adresse_user']))
{
// sanitize the input data and assign variables
$Nom_user = filter_var($_GET['Nom_user'], FILTER_SANITIZE_STRING);
$Prenom_user = filter_var($_GET['Prenom_user'], FILTER_SANITIZE_STRING);
$Username_user = filter_var($_GET['Username_user'], FILTER_SANITIZE_STRING);
$Password_user = filter_var($_GET['Password_user'], FILTER_SANITIZE_STRING);
$Sexe_user = filter_var($_GET['Sexe_user'], FILTER_SANITIZE_STRING);
$E_mail_user = filter_var($_GET['E_mail_user'], FILTER_SANITIZE_STRING);
$Adresse_user = filter_var($_GET['Adresse_user'], FILTER_SANITIZE_STRING);
if($Sexe_user=='feminin'){
    $sexe=0;
}else{$sexe=1;}
// Etablir connexion a la base de donnees
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// check erreur de connexion
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
// definir la requete SQL
$sql = "INSERT INTO utilisateus (Nom_user,Prenom_user,Username_user,Password_user,Type_user,Sexe_user,E_mail_user,Adresse_user) VALUES ('$Nom_user','$Prenom_user','$Username_user','$Password_user',0,'$sexe','$E_mail_user','$Adresse_user')";
$new_url = '../gestion_bibliothecaire.php?add_success=true';
// Si le livre a ete bien ajoute
if (mysqli_query($con, $sql)) { header('Location: '.$new_url);

} else {
// si l'ajout a echoue
$new_url = '../gestion_bibliothecaire.php?add_success=false';
header('Location: '.$new_url);
}
// close the db connection
mysqli_close($con);
}

}
?>