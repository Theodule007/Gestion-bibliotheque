<?php
if(isset($_POST['E_mail_abonn'])){    
$to       = filter_var($_POST['E_mail_abonn'], FILTER_SANITIZE_STRING);
$subject  = 'Testing sendmail.exe';
$message  = 'Alo  Authentique bibliotheque ap enfome w ke ou dwe pote liv la remet!';
$headers  = 'From: theodulesaintil@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
if(mail($to, $subject, $message, $headers))
   {echo "Email sent";
    $new_url = '../Page_gestionnaire.php?distribute_success=true';
   } 
else
{
    echo "Email sending failed";
    $new_url = '../Page_gestionnaire.php?distribute_success=false';
}

header('Location: '.$new_url);
}

else if(isset($_GET['details_email'])){
    
$titre    = filter_var($_GET['details_titre_livre'], FILTER_SANITIZE_STRING);
$to       = filter_var($_GET['details_email'], FILTER_SANITIZE_STRING);
$subject  = 'Depassement de delai';
$message  = 'Alo  Authentique bibliotheque ap enfome w ke ou dwe pote liv ' .$titre. ' la remet!';
$headers  = 'From: theodulesaintil@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';

            if(mail($to, $subject, $message, $headers)){
                $new_url = '../dashboard_gestionnaire.php?distribute_success=true';
               } 
                 else
                   {
                     $new_url = '../dashboard_gestionnaire.php?distribute_success=false';
                   }

header('Location: '.$new_url);
    
    
}

?>