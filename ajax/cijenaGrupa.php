<!--  --!>

<?php
include_once '../functions/general_function.php';

//Spajanje na bazu

$con = spajanje();

//Ispis cijene određene grupe

if(isset($_POST['selectSmjerId'])) {
    $selectSmjerId = $_POST['selectSmjerId'];
    if(strlen($selectSmjerId) >0) {
        $tablica = 'grupa';
        $polje = 'id_grupa';
        $sql = "SELECT * FROM $tablica WHERE $polje = {$selectSmjerId}";
        $grupa=upit($con,$sql);
        if(count($grupa) > 0){
            
            echo $grupa['cijena'];
            
        }else echo '<option>Nema aktivnih grupa</option>';
            
    }
}
?>