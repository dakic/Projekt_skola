<?php 

	include_once '../functions/general_function.php';
	$con = spajanje();

	if (isset($_POST['ispisCijenaId'])) {
		$cijenaId = $_POST['ispisCijenaId'];
		if(strlen($cijenaId) >0) {
			$sql = "SELECT * FROM grupa WHERE id_grupa = {$cijenaId}";
			$cijene = upit($con,$sql);
			if (count($cijene>0)) {

            	echo $cijene[0]['cijena'];
            	
			}
		}
	}

?>