<?php
echo 'HSBuy Success!';
$_clientId = 'aca57282242842f0b98856289a8aded3';
$_clientSecret = 't8Na86yUO8X0RVdyMVMj0aFva6pmUtkp';
$test_url = 'https://us.api.blizzard.com/hearthstone/deck?locale=en_US&code=AAECAQcEju8DxvUDmPYDv4AEDbXeA/7nA5LoA9XxA5X2A5b2A5f2A8/7A5uBBJyBBKaKBK2gBK+gBAA=&access_token=';
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
$setCount = [];
for($i=0; $i<sizeof($jsonReturn->cards); $i++){
    $base = $jsonReturn->cards[$i];
    //getSetName($token,$base->cardSetId);
    $query = "SELECT name FROM sets WHERE id={$base->cardSetId};";
    $name = mysqli_fetch_assoc(retrieveData($query));
    array_push($setCount,$name['name']);
    if($base->name != $jsonReturn->cards[$i-1]->name && $i>0){
        if($base->name == $jsonReturn->cards[$i+1]->name){
            print "{$base->name}: {$base->cardSetId} - {$name['name']} x2<br>";
        } else {
            print "{$base->name}: {$base->cardSetId} - {$name['name']} <br>";
        }
    }

}

?>
<br><br>
<?php
$finalCount = array_count_values($setCount);
foreach ($finalCount as $key => $value){
    echo "{$key} - {$value}<br>";
}
?>

