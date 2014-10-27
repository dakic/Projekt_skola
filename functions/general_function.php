<?php

	function spajanje(){

		//db connect
    	$con=mysqli_connect("localhost","root","","skola_db");

		// Check connection
		if (mysqli_connect_errno()) {
			return "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		else{
			return $con;
		}
	}

	function upit($con, $sql){

		mysqli_set_charset($con,'utf8');
		$rez = mysqli_query($con, $sql);
		$items = array();
		while($item = mysqli_fetch_array($rez)){
			$items[]=$item;
		}
		return $items;
	}

	function zapis($con, $sql){

		mysqli_set_charset($con,'utf8');
		if(mysqli_query($con, $sql)){
			return true;
		}
		else{
			return false;
		}
	}

	function is_login(){
		if(!isset($_COOKIE['remember'])){
			if(!isset($_SESSION['logiran'])){
				header('location: index.php');
			}		
		
		
		}

	}

?>