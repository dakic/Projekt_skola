<?php
include_once '../functions/general_function.php';
$con = spajanje();
if(isset($_POST['selectSmjerId'])) {
    $selectSmjerId = $_POST['selectSmjerId'];
    if(strlen($selectSmjerId) >0) {
        $tablica = 'grupa';
        $polje = 'id_smjer_fk';
        $sql = "SELECT * FROM $tablica WHERE $polje = {$selectSmjerId}";
        $grupe=upit($con,$sql);
        if(count($grupe) > 0){
            echo '<option>Izaberite grupu</option>';
            foreach ($grupe as $grupa){
            echo '<option value="'.$grupa['id_grupa'].'">'.$grupa['oznaka'].'</option>';
            }
        }else echo '<option>Nema aktivnih grupa</option>';
            
    }
}
?>