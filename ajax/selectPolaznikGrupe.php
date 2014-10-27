<?php
include_once '../functions/general_function.php';
$con = spajanje();
if(isset($_POST['selectPolaznikId'])) {
    $selectPolaznikId = $_POST['selectPolaznikId'];
    if(strlen($selectPolaznikId) >0) {
        $tablica = 'upis';
        $polje1 = 'id_polaznik_fk';
		$polje2 = 'id_grupa';
        $polje3 = 'id_smjer';
        $sql = "SELECT * FROM upis WHERE $polje1 = {$selectPolaznikId}";
        $grupe=upit($con,$sql);

        if(count($grupe) > 0){

            $tpl="<thead>";
            $tpl.="<tr><th>Naziv smjera</th>";
            $tpl.="<th>Naziv grupe</th>";
            $tpl.="<th>Obriši</th></tr>";
            $tpl.="</thead><tbody>";

            echo $tpl;

            foreach($grupe as $grupa_fk){

                $sql2 = "SELECT * FROM grupa WHERE $polje2 = {$grupa_fk['id_grupa_fk']}";

                $grupa=upit($con,$sql2);

                $sql3 = "SELECT * FROM smjer WHERE $polje3 = {$grupa[0]['id_smjer_fk']}";
                $smjer=upit($con,$sql3);


                $tpl="<tr>";
                $tpl.="<td>".$smjer[0]['naziv']."</td>";
                $tpl.="<td>".$grupa[0]['oznaka']."</td>";
                $tpl.='<td><a href="ispis.php?id='.$grupe[0]["id_polaznik_fk"].'&grupa='.$grupa_fk["id_grupa_fk"].'&obrisi=da" onclick="return confirm(\'Jeste li sigurni\')">Obriši</a></td>';

                echo $tpl;

            };

            echo "</tr></tbody>";

            }else {echo '<p>Nema aktivnih grupa!</p>';}
            
    }
}
?>