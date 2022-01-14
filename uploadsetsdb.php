<?php
echo 'HSBuy Success!';
$_clientId = 'aca57282242842f0b98856289a8aded3';
$_clientSecret = 't8Na86yUO8X0RVdyMVMj0aFva6pmUtkp';
$test_url = 'https://us.api.blizzard.com/hearthstone/metadata?locale=en_US&access_token=';
include 'functions.php';

//call OAUTH2 function and set it to $token var
$token = getToken();

if($_COOKIE['token']){
    $token=$_COOKIE['token'];
}else{
    $token=getToken();
    setcookie('token',$token);
}

$access_url = $test_url.$token;
echo $access_url;
$jsonReturn = json_decode(contentsGet($access_url));

echo '<br>';
for($i=0; $i<=sizeof($jsonReturn->sets); $i++){
    $base = $jsonReturn->sets[$i];
    $query = "INSERT INTO sets VALUES ({$base->id},'{$base->name}','{$base->slug}','{$base->type}',{$base->collectibleCount},{$base->collectibleRevealedCount},{$base->nonCollectibleCount},{$base->nonCollectibleRevealedCount});";
    executeQuery($query);
    print $query;
}
?>

