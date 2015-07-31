<?php
	/**
	 *	Find maximum iteration of given coin
	 *	@author  Rakesh Salunke <rakesh.salunke29@gmail.com>
	 *	@lastmodify 31 July 2015
	 *	
	 */
	
	 
	session_start();

	//given coin array
	$coin_combo = array(1,10,25);

	//user input to calculate the combination of coins
	$user_input = 100;

	$coin_combo = array_reverse($coin_combo);	

	$_SESSION['data'] = array();

	foreach($coin_combo as $coin_key => $coin_value){
		$current_coin = $coin_key;
		$current_coin_max_itr = floor($user_input/$coin_value);
		// $current_coin_max_itr = $_SESSION['coin_combo_max_int'][$coin_combo[$coin_key]];
		$data = "";
		getCoinCombo($user_input,$coin_combo,$current_coin,$current_coin_max_itr, $data);
	}


	function getCoinCombo($amount, $all_coin_combo, $current_coin, $current_coin_max_itr, $data){

		for($i=$current_coin_max_itr; $i>=1; $i--){

			$check_for_zero = $amount - $all_coin_combo[$current_coin] * $i;

			if($check_for_zero==0){
				$cell_data = $data.'  '.$all_coin_combo[$current_coin].'x'.$i;				
				$_SESSION['data'][] = $cell_data;

			}elseif($check_for_zero > 0){

				$cell_data = $data.'  '.$all_coin_combo[$current_coin].'x'.$i;

				for($forAllCount=$current_coin+1; $forAllCount<=count($all_coin_combo); $forAllCount++){


					$next_coin_index = $forAllCount;

					$next_coin_max_itr = floor($check_for_zero/$all_coin_combo[$next_coin_index]);

					getCoinCombo($check_for_zero, $all_coin_combo,$next_coin_index,$next_coin_max_itr,$cell_data);


				}
				



			}else{
				//kuch mat kar bus chill mar :)
			}	
		}	
	}

	echo "Total ".count($_SESSION['data'])." iterations for ".$user_input. " using given coin of ".implode(",", $coin_combo)."<br>";
	foreach($_SESSION['data'] as $opt){
		echo $opt." = ".$user_input."<br>";
	}
?>