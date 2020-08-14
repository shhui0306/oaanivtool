<?php
include __DIR__."/datecompare.php";
include __DIR__."/countdown.php";
$mode = "c"; // countdown mode

if (isset($_GET["mode"])){
    $mode = $_GET["mode"];
}
if ($mode == "r"){
    // review mode
    $reviewday = $_GET["reviewday"];
}

// find date of today
date_default_timezone_set('Asia/Tokyo');
$today = date("Y-n-j");
$today = "2020-8-17";

// compare date to find day and data
$before = false;
$after = false;
$dayava = false; //review avaliable
$countday = 0;
$cdata = array();

if ($mode == "r"){
     // check if today is after or on date to be reviewed
    if (datecompare($today,$reviewday)){
        $dayava = true;
        $rdate = $reviewday;
    }
}
else if ($mode == "c"){
    $dayava = true;
    $rdate = $today;
}

if ($dayava){
    if (!datecompare($rdate,FIRSTDAY)){
        $before = true;
    }
    else if (datecompare($rdate,ANNIVDATE)){
        $after = true;
        $countday = COUNTDAYS;
    }
    else {
    foreach ($countdownlist as $key => $val){
        if ($val["date"] == $rdate){
            $cdata = $val;
            $countday = $val["id"];
        }
        }
}
}

?>

<html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Noto+Sans+TC&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="main">
<?php

if ($mode == "c" || ($mode == "r" && $dayava)){
if ($before){
if ($mode == "c"){
// show comming soon message if countdown not yet start?>
<h4>カウントダウン近日公開予定</h4>
<img class="csimage" src="<?php echo $unitimages["cs"]; ?>">
<?php }else {?>
近日公開予定
<?php } }
else if ($after){
// show celebration story if over
include __DIR__."/story.php";
}else{
// show everyday countdown
$date = $cdata["date"];
$id = $cdata["id"];
$remainingday = COUNTDAYS-$id;
$havegoods = $cdata ["goodscreator"] != null;
$haveillust = $cdata ["illustcreator"] != null;
?>
<h4>【<?php echo $date;?>： あと<?php echo COUNTDAYS-$cdata["id"]?>日！】</h4>

<?php if ($remainingday == 1){?>
明日はいよいよ「オンエア！」二周年！
<?php }else if ($remainingday <=10){?>
オンエア！二周年までわずか<?php echo $remainingday?>日！
<?php }else{?>
オンエア！二周年まであと<?php echo $remainingday?>日！
<?php } ?>

今日のカウントダウン担当は<?php if ($cdata["unit"]== "ar") {?>荒木冴先生<?php }
else { echo $unitnames[$cdata["unit"]];?>の<?php echo $cdata["charaName"];?><?php echo $cdata["isSenpai"]?"先輩":"くん";}?>です！<br>
<?php echo $cdata["message_jp"];?><br>

<div class="row">
<?php if ($havegoods){?>
<div class="col-lg-<?php echo $haveillust?"6":"12"; ?>">
<a href="#" class="pop-<?php echo $id;?>-goods"  data-toggle="modal" data-target="#imagemodal-<?php echo $id;?>"><img class="celimage" src="<?php echo $cdata["goodslink"] ?>"></a><br>
グッズ写真： <?php echo $cdata ["goodscreator"];?>様
</div>
<?php }?>

<?php if ($haveillust){?>
<div class="col-lg-<?php echo $havegoods?"6":"12"; ?>">
<a href="#" class="pop-<?php echo $id;?>-illust" data-toggle="modal" data-target="#imagemodal-<?php echo $id;?>" ><img class="celimage" src="<?php echo $cdata["illustlink"]; ?>"></a><br>
イラスト：<?php echo $cdata ["illustcreator"];?>様
</div>
<?php }?>
</div>



<div class="modal fade" id="imagemodal-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-<?php echo $id;?>" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">              
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview-<?php echo $id;?>" style="width: 100%; max-width: 90vh;" >
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(function() {
		$('.pop-<?php echo $id;?>-goods').on('click', function() {
			$('.imagepreview-<?php echo $id;?>').attr('src', $(this).children('img').attr('src'));
        });		
        $('.pop-<?php echo $id;?>-illust').on('click', function() {
			$('.imagepreview-<?php echo $id;?>').attr('src', $(this).children('img').attr('src'));
		});	
});
</script>

<?php }}else{?>
近日公開予定
<?php }?>

<?php if ($mode == "c"){    // countdown mode?>
    <div class="row">
        <div class="col-12">
        <a href="index.php">中文 / 中国語</a>
        </div>
    </div>
<?php }?>
</div>
</body>
</html>