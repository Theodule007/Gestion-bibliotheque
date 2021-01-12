<?php require_once('../database/db_credentials.php'); ?>
<?php

// check if the form was submitted
if(isset($_GET['distributeItemSubmitButton'])){
    //Verifier les info du preteur
if(isset($_GET['Id_abonn'])){
    // check if the user filled out all the fields
if(isset($_GET['Id_livre']) && isset($_GET['Titre_livre']) && isset($_GET['Qte_livre'])) {
    // sanitize the input data and assign variables
    $Id_abonn = filter_var($_GET['Id_abonn'], FILTER_SANITIZE_STRING);
    $Id_livre = filter_var($_GET['Id_livre'], FILTER_SANITIZE_STRING);
    $Titre_livre = filter_var($_GET['Titre_livre'], FILTER_SANITIZE_STRING);
    $Qte_livre = filter_var($_GET['Qte_livre'], FILTER_SANITIZE_STRING);
    $quantite_prete = 1;
    //Definir la date de remise
    $date = date("Y-m-d H:i:s");
    $date = strtotime($date);
    $date = strtotime("+22 day", $date);
    $date_remise=date('Y-m-d H:i:s', $date);
    // make connection to db
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    // check for db connection errors
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }
    
    //information sur qte livres de l'abonne
    $select_qte_livre_abonn="SELECT Qte_livre_abonn FROM abonnes WHERE Id_abonn=$Id_abonn";
    $result_qte_livre=mysqli_query($con,$select_qte_livre_abonn);
    $catch_qte_livre=mysqli_fetch_assoc($result_qte_livre);
    //information sur forfait de l'abonne
    $select_forfait_abonn="SELECT Forfait_abonn FROM abonnes WHERE Id_abonn=$Id_abonn";
    $result_forfait_abonn=mysqli_query($con,$select_forfait_abonn);
    $catch_forfait_abonn=mysqli_fetch_assoc($result_forfait_abonn);


    if($catch_qte_livre['Qte_livre_abonn']<3 && $catch_forfait_abonn['Forfait_abonn']==1){
        // adjust (subtract the distributed amount) the quantity from the inventory_items table
    $sql_update_quantity = "UPDATE livres SET Qte_livre=Qte_livre-'$quantite_prete' WHERE Id_livre=$Id_livre";
    $sql_abonn_pret ="UPDATE abonnes SET Qte_livre_abonn=Qte_livre_abonn+'$quantite_prete' WHERE Id_abonn=$Id_abonn";
    mysqli_query($con, $sql_abonn_pret);
    $sql_prete_livre = "INSERT INTO preter_livres (Id_abonn, id_livre, Date_remise, Etat_pret) VALUES ('$Id_abonn','$Id_livre','$date_remise',1)";
    mysqli_query($con, $sql_prete_livre);
    // if the record was successfully updated
    if (mysqli_query($con, $sql_update_quantity)) {
    $url = '../gestion_livre.php?distribute_success=true';
    header('Location: '.$url);
    
    } else {
    // if the record failed to be updated
    $url = '../gestion_livre.php?distribute_success=false';
    header('Location: '.$url);
    
    }
    }else{    // si l'abonn a plus de trois livres et s'il n'a pas paye le forfait
        $url = '../gestion_livre.php?distribute_success=false';
        header('Location: '.$url);}
    // close the db connection
    mysqli_close($con);
    }
}


}
else if(isset($_GET['distributeItemSubmitButton1'])){
      //Verifier les info du livre
if(isset($_GET['Id_livre'])){
    // check if the user filled out all the fields
if(isset($_GET['Id_abonn'])) {
    // sanitize the input data and assign variables
    $Id_abonn = filter_var($_GET['Id_abonn'], FILTER_SANITIZE_STRING);
    $Id_livre = filter_var($_GET['Id_livre'], FILTER_SANITIZE_STRING);
    $quantite_prete = 1;
   //Definir la date de remise
$date = date("Y-m-d H:i:s");
$date = strtotime($date);
$date = strtotime("+22 day", $date);
$date_remise=date('Y-m-d H:i:s', $date);
    // make connection to db
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    // check for db connection errors
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }
    
    //information sur qte livres de l'abonne
    $select_qte_livre_abonn="SELECT Qte_livre_abonn FROM abonnes WHERE Id_abonn=$Id_abonn";
    $result_qte_livre=mysqli_query($con,$select_qte_livre_abonn);
    $catch_qte_livre=mysqli_fetch_assoc($result_qte_livre);
    //information sur forfait de l'abonne
    $select_forfait_abonn="SELECT Forfait_abonn FROM abonnes WHERE Id_abonn=$Id_abonn";
    $result_forfait_abonn=mysqli_query($con,$select_forfait_abonn);
    $catch_forfait_abonn=mysqli_fetch_assoc($result_forfait_abonn);

    if($catch_qte_livre['Qte_livre_abonn']<3 && $catch_forfait_abonn['Forfait_abonn']==1){
        // adjust (subtract the distributed amount) the quantity from the inventory_items table
    $sql_update_quantity = "UPDATE livres SET Qte_livre=Qte_livre-'$quantite_prete' WHERE Id_livre=$Id_livre";
    $sql_abonn_pret ="UPDATE abonnes SET Qte_livre_abonn=Qte_livre_abonn+'$quantite_prete' WHERE Id_abonn=$Id_abonn";
    mysqli_query($con, $sql_abonn_pret);
    $sql_prete_livre = "INSERT INTO preter_livres (Id_abonn, id_livre, Date_remise, Etat_pret) VALUES ('$Id_abonn','$Id_livre','$date_remise',1)";
    mysqli_query($con, $sql_prete_livre);
    // if the record was successfully updated
    if (mysqli_query($con, $sql_update_quantity)) {
    $url = '../gestion_abonn.php?distribute_success=true';
    header('Location: '.$url);
    
    } else {
    // if the record failed to be updated
    $url = '../gestion_abonn.php?distribute_success=false';
    header('Location: '.$url);
    
    }
    }else{    // si l'abonn a plus de trois livres et s'il n'a pas paye le forfait
        $url = '../gestion_abonn.php?distribute_success=false';
        header('Location: '.$url);}
    
    // close the db connection
    mysqli_close($con);
    }
}


}


?>