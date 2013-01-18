<?php

    /*** SETUP ***************************************************/

    $key        = "YOUR_APP_KEY";         //GET FROM APP MANAGEMENT (ACS)
    $username   = "YOUR_LOGIN";
    $password   = "YOUR_PASSWORD";
    $channel    = "PUSH_CHANNEL";
    $message    = "YOUR_MESSAGE";
    $title      = "YOUR_ANDROID_TITLE";
    $tmp_fname  = 'cookie.txt';
    $json       = '{"alert":"'. $message .'","title":"'. $title .'","vibrate":true,"sound":"default"}';
 
    /*** PUSH NOTIFICATION ***********************************/
 
    $post_array = array('login' => $username, 'password' => $password);
 
    /*** INIT CURL *******************************************/
    $curlObj    = curl_init();
    $c_opt      = array(CURLOPT_URL => 'https://api.cloud.appcelerator.com/v1/users/login.json?key='.$key,
                        CURLOPT_COOKIEJAR => $tmp_fname, 
                        CURLOPT_COOKIEFILE => $tmp_fname, 
                        CURLOPT_RETURNTRANSFER => true, 
                        CURLOPT_POST => 1,
                        CURLOPT_POSTFIELDS  =>  "login=".$username."&password=".$password,
                        CURLOPT_FOLLOWLOCATION  =>  1,
                        CURLOPT_TIMEOUT => 60);
 
    /*** LOGIN **********************************************/
    curl_setopt_array($curlObj, $c_opt); 
    $session = curl_exec($curlObj);     
 
    /*** SEND PUSH ******************************************/
    $c_opt[CURLOPT_URL]         = "https://api.cloud.appcelerator.com/v1/push_notification/notify.json?key=".$key; 
    $c_opt[CURLOPT_POSTFIELDS]  = "channel=".$channel."&payload=".$json; 
 
    curl_setopt_array($curlObj, $c_opt); 
    $session = curl_exec($curlObj);     
 
    /*** THE END ********************************************/
    curl_close($curlObj);


    echo $session;

?>
