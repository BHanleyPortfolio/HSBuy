<?php require_once ('classes/mydatabase.php'); ?>
<?php include 'header.php'; ?>

<?php if(file_exists('html/header.html')){require 'html/header.html';} ?>

<main>
    <div id="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>Pack Breakdown</li>
            </ul>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="container margin_60">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <nav id="secondary_nav">
                    <div class="container">
                        <ul class="clearfix">
                            <li><a href="#section_1" class="active">General info</a></li>
                        </ul>
                    </div>
                </nav>
                <div id="section_1">
                    <div class="box_general_3">
                        <div class="indent_title_in">
                            <i class="pe-7s-user"></i>
                            <h3>Deck List</h3>
                        </div>
                        <div class="wrapper_indent">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="bullets"><?php
                                        //echo 'HSBuy Success!';
                                        $test_url = "https://us.api.blizzard.com/hearthstone/deck?locale=en_US&code={$_POST['code']}=&access_token=";
                                        include 'functions.php';

                                        //call OAUTH2 function and set it to $token var
                                        //$token = getToken();

                                        if($_COOKIE['token']){
                                            $token=$_COOKIE['token'];
                                        }else{
                                            $token=getToken();
                                            setcookie('token',$token);
                                        }

                                        $access_url = $test_url.$token;
                                        //echo $access_url;
                                        $jsonReturn = json_decode(contentsGet($access_url));

                                        //echo '<br>';
                                        $setCount = [];
                                        for($i=0; $i<sizeof($jsonReturn->cards); $i++){
                                            $base = $jsonReturn->cards[$i];
                                            //getSetName($token,$base->cardSetId);
                                            $db = new myDatabase();
                                            //$query = "SELECT name FROM sets WHERE id={$base->cardSetId};";
                                            $name = mysqli_fetch_assoc($db->retrieveData("SELECT name FROM sets WHERE id={$base->cardSetId};"));
                                            array_push($setCount,$name['name']);
                                            $cropImage = cropImgLocation($base->slug,$base->cropImage);
                                            if($base->name != $jsonReturn->cards[$i-1]->name){
                                                if($base->name == $jsonReturn->cards[$i+1]->name){
                                                    print "<li  style='background-image: url(".$cropImage.");' class='hscard col-12'>{$base->name} - {$name['name']} x2</li>";
                                                } else {
                                                    print "<li class='hscard col-12' style='background-image: url(".$cropImage.");'>{$base->name} - {$name['name']}</li>";
                                                }
                                            }

                                        }

                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- /row-->
                        </div>
                        <!-- /wrapper indent -->


                    </div>
                    <!-- /section_1 -->
                </div>
                <!-- /box_general -->
            </div>
            <!-- /col -->
            <aside class="col-xl-4 col-lg-4" id="sidebar">
                <div class="box_general_3 booking">
                    <form>
                        <div class="title">
                            <h3>Pack Breakdown</h3>
                            <small>Card count by set.</small>
                        </div>
                        <ul class="treatments clearfix">
                            <?php
                            $finalCount = array_count_values($setCount);
                            //Sort array by number of cards in each set in descending order
                            arsort($finalCount);
                            $setLi = 1;
                            foreach ($finalCount as $key => $value){if($key != 'Core'){?>
                                <li>
                                    <div class="checkbox">
                                        <input type="checkbox" class="css-checkbox" id="set<?php echo $setLi ?>" name="set<?php echo $setLi ?>">
                                        <label for="set<?php echo $setLi ?>" class="css-label"><?php echo "{$key} <strong>{$value}</strong>"; ?></label>
                                    </div>
                                </li>
                            <?php $setLi++; }}
                            ?>
                        </ul>
                    </form>
                </div>
                <!-- /box_general -->
            </aside>
            <!-- /asdide -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
<!-- /main -->

<?php include "footer.php"; ?>