<!-- <?php require_once('../database/db_credentials.php'); ?>
<?php
 // make connection to db
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

function get_city($con , $term){ 
 $query = "SELECT * FROM abonnes WHERE Nom_abonn LIKE '%".$term."%' ORDER BY Nom_abonn ASC";
 $result = mysqli_query($con, $query); 
 $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getCity = get_city($con, $_GET['term']);
 $cityList = array();
 foreach($getCity as $city){
 $cityList[] = $city['Nom_abonn'];
 }
 echo json_encode($cityList);
}
?> -->