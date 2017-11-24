<?php
    //require '../php-restclient/restclient.php';
    header("Content-type: application/json");
    $header = array();
    $header[] = "Content-type: application/json";
    $pass = "nlyon:*********";

    $textOptions = urlencode($_GET["text"]); // test in url :: *.php?text=some_username
   //$textOptions = urlencode($_POST["text"]); 
   if(!empty($textOptions)) {
    $output = explode("+", $textOptions); 
    $value = $output[0]; // option numéro 1 de la slash command

    if($value == "97")
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // empeche les erreurs ssl
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $tuleap_url = 'https://' .
                        'tuleap-campus.org/' .
                        'api/kanban/' . $value;
        curl_setopt($ch, CURLOPT_URL, $tuleap_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        $tuleap_array = json_decode($result, true);

        $todo = $tuleap_array["columns"][0]["label"];
        $IDtodo = $tuleap_array["columns"][0]["id"];

        $onGoing = $tuleap_array["columns"][1]["label"];
        $IDonGoing = $tuleap_array["columns"][1]["id"];

        $review =$tuleap_array["columns"][2]["label"];
        $IDreview = $tuleap_array["columns"][2]["id"];
            
        $payload = array("username" => "bot", 
                          "response_type" => "in_channel", 
                          "text" => "Dans votre kanban il y a 3 colones : \n'" . 
                          $todo . "' avec l'id : " . $IDtodo . "\n'" .
                          $onGoing . "' avec l'id : " . $IDonGoing . "\n'" .
                          $review . "' avec l'id : " . $IDreview);
        echo json_encode($payload); 
        //var_dump($tuleap_array["columns"][0]["label"]);
        curl_close($ch);
    }

    // COLONE TODO
    else if($value == "todo" || $value == "Todo" || $value == "TODO" || $value == 127112)
    {
        $value = 97;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // empeche les erreurs ssl
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $tuleap_url = 'https://' .
                        'tuleap-campus.org/' .
                        'api/kanban/' . $value;
        curl_setopt($ch, CURLOPT_URL, $tuleap_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        $tuleap_array = json_decode($result, true);
        $IDtodo = $tuleap_array["columns"][0]["id"];

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0); // empeche les erreurs ssl
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);

        $tuleap_url = 'https://' .
                        'tuleap-campus.org/' .
                        'api/kanban/97/items?column_id=' . $IDtodo;
        curl_setopt($ch2, CURLOPT_URL, $tuleap_url);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch2, CURLOPT_USERPWD, $pass);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch2);
        if (curl_errno($ch2)) {
            echo 'Error:' . curl_error($ch2);
        }
        $tuleap_array = json_decode($result, true);

        $art = $tuleap_array["collection"][1]["label"];
        $IDart = $tuleap_array["collection"][1]["id"];

        $payload = array("username" => "bot", 
                          "response_type" => "in_channel", 
                          "text" => "Dans la colone TODO il y a cet artefact : \n" . $art
                            . "\n avec l'id suivant : " . $IDart);
        echo json_encode($payload);
        curl_close($ch);
        curl_close($ch2);
    }
    
    // artefact !!
    else if($value == "19283")
    {
        $payload = array("username" => "bot", 
                          "response_type" => "in_channel", 
                          "text" => "voici le lien vers l'artefact : \n " . 
                          "<https://tuleap-campus.org/plugins/tracker/?aid=" . $value . ">");
        echo json_encode($payload);
        //var_dump($tuleap_array["columns"][0]["label"]);
    }

    // COLONE on going
    else if($value == "ongoing")
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // empeche les erreurs ssl
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $tuleap_url = 'https://' .
                        'tuleap-campus.org/' .
                        'api/kanban/' . $value;
        curl_setopt($ch, CURLOPT_URL, $tuleap_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        echo $result;
        curl_close($ch);
    }

    //colone review
    else if($value == "review")
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // empeche les erreurs ssl
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $tuleap_url = 'https://' .
                        'tuleap-campus.org/' .
                        'api/kanban/' . $value;
        curl_setopt($ch, CURLOPT_URL, $tuleap_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        echo $result;
        curl_close($ch);
    }



    else
    {
        $tuleap_url = 'https://' .
               'tuleap-campus.org/' .
            'api/users?query=' . $value;
        $tuleap_json = file_get_contents($tuleap_url);
        $tuleap_array = json_decode($tuleap_json, true);
        $id_user = $tuleap_array[0]["id"];
        $realName = $tuleap_array[0]['real_name'];
            
        $payload = array("username" => "bot", 
                          "response_type" => "in_channel", 
                          "text" => "Voici votre l'ID de l'user '" . $value . 
                                    "' : " . $id_user . 
                                    " :: et son nom complet : " . $realName);
       echo json_encode($payload);
    } //else {
        //$payload = array("username" => "bot", "response_type" => "in_channel", "text" => "Echec !");
    //}
    
    // "curl -XGET --header 'Content-type: application/json' -u nlyon:vbx364e2 https://tuleap-campus.org/api/kanban/97");
    //echo $jsonPass;
    
    //echo json_encode($payload);
    //echo json_encode($output[0]); // premiere options rentree
}
