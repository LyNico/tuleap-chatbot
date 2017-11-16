<?php 

	header("Content-type: application/json");

    //$textOptions = urlencode($_GET["text"]); // test in url :: *.php?text=some_username
   $textOptions = urlencode($_POST["text"]); 
   if(!empty($textOptions)) {
   	$output = explode("+", $textOptions); 
	   $user_id = $output[0]; // option numéro 1 de la slash command
	 //$user_id = $textOptions;
   	$tuleap_url = 'https://' .
	       'tuleap.net/' .
   	    'api/users?query=' . $user_id;
	   $tuleap_json = file_get_contents($tuleap_url);
	   $tuleap_array = json_decode($tuleap_json, true);
	   $id_user = $tuleap_array[0]["id"];
		$realName = $tuleap_array[0]['real_name'];
		
	   $payload = array("username" => "bot", 
	   					  "response_type" => "in_channel", 
	   					  "text" => "Voici votre l'ID de l'user '" . $user_id . 
	   						"' : " . $id_user . 
	   						" :: et son nom complet : " . $realName);
   
    } else {
    	$payload = array("username" => "bot", "response_type" => "in_channel", "text" => "Echec !");
    }
    
    echo json_encode($payload);
    //echo json_encode($output[0]); // premiere options rentree
