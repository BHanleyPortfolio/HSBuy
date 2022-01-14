<?php
if(file_exists('config/private-config.php')) { include 'config/private-config.php'; }else{ include 'config/config.php';}
// OAUTH2 Log in
function getToken() {
    //curl -u {client_id}:{client_secret} -d grant_type=client_credentials https://us.battle.net/oauth/token
    $client_id = CLIENT_ID;
    $client_secret = SECRET_ID;
    $url = "https://us.battle.net/oauth/token";
    $params = ['grant_type'=>'client_credentials'];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
    curl_setopt($curl, CURLOPT_USERPWD, $client_id.':'.$client_secret);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($curl));
    curl_close($curl);
    return $result->access_token;
}

//Show Page Contents
function contentsGet($url){
    $c= curl_init($url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $page= curl_exec($c);
    return $page;
    curl_close($c);
}
/*function getSetName($token,$id){
    $url = "https://us.api.blizzard.com/hearthstone/metadata?locale=en_US&access_token={$token}";
    $jsonName = json_decode(contentsGet($url));
    $keys = array_keys($jsonName->sets);
    $needle = array("{$id}");
    print_r($jsonName->sets);
    var_dump((bool)array_intersect($keys,$needle));
    return $jsonName->sets->name;
}*/
function executeQuery($query){
    $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    mysqli_query($mysqli,$query);
    mysqli_close();
}
function retrieveData($query){
    $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    return mysqli_query($mysqli,$query);
}

// Check to see if we have the card image. If we don't grab it
function imgLocation($slug,$img){
    $imagePath = "img/cards/image/{$slug}.png";
    if(!file_exists($imagePath)){
         file_put_contents($imagePath,file_get_contents($img));
    }
    return $imagePath;
}

// Check to see if we have the cropped image. If we don't grab it
function cropImgLocation($slug,$img){
    $imagePath = "img/cards/cropImage/{$slug}.png";
    if(!file_exists($imagePath)){
        file_put_contents($imagePath,file_get_contents($img));
    }
        return $imagePath;
}
?>