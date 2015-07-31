<?php
	session_start();

	//given coin array
	$coin_combo = array(1,5,10,25,50);

	//use input to calculate combination of coins
	$_SESSION['user_input'] = 100;

	$coin_combo = array_reverse($coin_combo);	

	$_SESSION['date'] = array();

	foreach($coin_combo as $coin_key => $coin_value){
		$current_coin = $coin_key;
		$current_coin_max_itr = floor($_SESSION['user_input']/$coin_value);
		// $current_coin_max_itr = $_SESSION['coin_combo_max_int'][$coin_combo[$coin_key]];
		$data = "";
		getCoinCombo($_SESSION['user_input'],$coin_combo,$current_coin,$current_coin_max_itr, $data);
	}


	function getCoinCombo($amount, $all_coin_combo, $current_coin, $current_coin_max_itr, $data){

		for($i=$current_coin_max_itr; $i>=1; $i--){

			$check_for_zero = $amount - $all_coin_combo[$current_coin] * $i;

			if($check_for_zero==0){
				$cell_data = $data.'  '.$all_coin_combo[$current_coin].'x'.$i;				
				$_SESSION['date'][] = $cell_data;

			}elseif($check_for_zero > 0){

				$cell_data = $data.'  '.$all_coin_combo[$current_coin].'x'.$i;

				$next_coin_index = $current_coin+1;

				$next_coin_max_itr = floor($check_for_zero/$all_coin_combo[$next_coin_index]);

				getCoinCombo($check_for_zero, $all_coin_combo,$next_coin_index,$next_coin_max_itr,$cell_data);

			}else{				

				//kuch mat kar bus chill mar :)
			}
		
		}

		

	}
	


	echo "Total ".count($_SESSION['date'])." iterations for ".$_SESSION['user_input']. " using given coin of ".implode(",", $coin_combo)."<br>";
	foreach($_SESSION['date'] as $opt){
		echo $opt." = ".$_SESSION['user_input']."<br>";
	}
	// echo '<pre>';
	// print_r($_SESSION['date']);


	
?>