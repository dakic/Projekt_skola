<?php
include_once '../functions/general_function.php';
$con = spajanje();
if(isset($_POST['prezime'])) {
    $prezime = $_POST['prezime'];
    if(strlen($prezime) >0) {
        $tablica = 'polaznik';
        $polje = 'prezime';
        $sql = "SELECT * FROM $tablica WHERE $polje LIKE '{$prezime}%'";
        $polaznici=upit($con,$sql);
        echo "<ul>";
            foreach ($polaznici as $polaznik){
            echo '<li><a href="polaznik.php?id='.$polaznik['ID_polaznik'].'">'.$polaznik['prezime'].' '.$polaznik['ime'].'</a></li>';
            }
        echo "</ul>";
    }
}
?>