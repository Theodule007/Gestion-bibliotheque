<?php session_start(); ?>
<?php require_once('../database/db_credentials.php'); ?>
<?php
if (isset($_POST['connectbutton']))
{
    if (isset($_POST['email']) && isset($_POST['psw']))
{
    //utiliser filtre pour nettoyer l'entrer de l'utillisateur
    $Username_user=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $Password_user=filter_var($_POST['psw'], FILTER_SANITIZE_STRING);
    
    //etablir une connexion a la base de donnees 
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    // check erreur de connexion
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }
    //pour faire verification sur le paiement des abonnes
    $sql = "SELECT * FROM abonnes WHERE 1";
    $search_result = mysqli_query($con, $sql); 
    //initialiser $date a la date du jour
    $date = date("Y-m-d");
    //verifier si c'est un email valide d'abord
   if (filter_var($Username_user,FILTER_VALIDATE_EMAIL)){
    $sql = "SELECT *  FROM utilisateus WHERE E_mail_user='$Username_user' AND Password_user='$Password_user'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
    if(!empty($row)){
        $_SESSION['id']=$row['Id_user'];
        $_SESSION['Nom_user']=$row['Nom_user'];
        $_SESSION['Prenom_user']=$row['Prenom_user'];
        $_SESSION['E_mail_user']=$row['E_mail_user'];
        $_SESSION['Sexe_user']=$row['Sexe_user'];
        if($row['Type_user']==1){
            $url1 = '../dashboard_gestionnaire.php';
        }
        else{
            $url1 = '../dashboard_bibliothecaire.php';
        }
        foreach($search_result as $result){
            $id_abonn=$result['Id_abonn'];
            if($date>$result['Fin_abonn']){
                $suspendre_abonnement="UPDATE abonnes SET Forfait_abonn=0 where Id_abonn=$id_abonn";
                $result_suspension=mysqli_query($con,$suspendre_abonnement);
                 }
        }
        header('Location: '.$url1);
    } else{
        $url1 = '../login.php';
            header('Location: '.$url1);
    }


   } else { 
    $sql = "SELECT * FROM utilisateus WHERE Username_user='$Username_user' AND Password_user='$Password_user'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
    if(!empty($row)){
        $_SESSION['id']=$row['Id_user'];
        $_SESSION['Nom_user']= $row['Nom_user'];
        $_SESSION['Prenom_user']=$row['Prenom_user'];
        $_SESSION['E_mail_user']=$row['E_mail_user'];
        if($row['Type_user']==1){
            $url1 = '../dashboard_gestionnaire.php';
        }
        else{
            $url1 = '../dashboard_bibliothecaire.php';
        }
        foreach($search_result as $result){
            $id_abonn=$result['Id_abonn'];
            if($date>$result['Fin_abonn']){
                $suspendre_abonnement="UPDATE abonnes SET Forfait_abonn=0 where Id_abonn=$id_abonn";
                $result_suspension=mysqli_query($con,$suspendre_abonnement);
                 }
        }
        header('Location: '.$url1);

    } else{
        $url1 = '../login.php';
            header('Location: '.$url1);
    }

    
}
// close the db connection
mysqli_close($con);           
}
}

?>