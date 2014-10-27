<?php
include_once '../functions/general_function.php';
$con = spajanje();
if(isset($_POST['oznaka'])) {
    $oznaka = $_POST['oznaka'];
    if(strlen($oznaka) >0) {
        $tablica = 'grupa';
        $polje = 'oznaka';
        $sql = "SELECT * FROM $tablica WHERE $polje LIKE '{$oznaka}%'";
        $grupe=upit($con,$sql);
        echo "<ul>";
            foreach ($grupe as $grupa){
            echo '<li><a href="grupa.php?id='.$grupa['id_grupa'].'">'.$grupa['oznaka'].' '.$grupa['cijena'].'</a></li>';
            }
        echo "</ul>";
    }
}
?>