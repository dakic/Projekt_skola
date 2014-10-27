<?php
include_once '../functions/general_function.php';
$con = spajanje();
if(isset($_POST['naziv'])) {
    $naziv = $_POST['naziv'];
    if(strlen($naziv) >0) {
        $tablica = 'smjer';
        $polje = 'naziv';
        $sql = "SELECT * FROM $tablica WHERE $polje LIKE '{$naziv}%'";
        $smjerovi=upit($con,$sql);
        echo "<ul>";
            foreach ($smjerovi as $smjer){
            echo '<li><a href="smjer.php?id='.$smjer['id_smjer'].'">'.$smjer['naziv'].' '.$smjer['ur_broj'].'</a></li>';
            }
        echo "</ul>";
    }
}
?>