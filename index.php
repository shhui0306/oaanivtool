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
//$today = '2021-8-17'; //debug only 除錯用，發佈時請註釋此行

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
    if (!datecompare($rdate, FIRSTDAY)){ //倒數前
        $before = true;
    }
    else if (datecompare($rdate, ANNIVDATE)){ //週年後
        $after = true;
        $countday = 31;
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
<h4>每日倒數即將推出！</h4>
<img class="csimage" src="<?php echo $unitimages["cs"]; ?>">
<?php }else {?>
即將推出！
<?php } }
else if ($after){
// show celebration story if over
include __DIR__."/story.php";
}else{
// show everyday countdown
$id = $cdata["id"];
$remainingday = 31-$id;
$havegoods = $cdata ["goodscreator"] != null;
$haveillust = $cdata ["illustcreator"] != null;
?>
<h4>倒數<?php echo 31-$cdata["id"]?>天！</h4>

<?php if ($remainingday == 1){?>
明天就是《オンエア！》兩週年的日子了！
<?php }else if ($remainingday <=10){?>
離《オンエア！》兩週年只剩<?php echo $remainingday?>天！
<?php }else{?>
離《オンエア！》兩週年還有<?php echo $remainingday?>天！
<?php } ?>

今天一起倒數的是<?php if ($cdata["unit"]== "ar") {?>荒木冴老師<?php }
else { echo $unitnames[$cdata["unit"]];?>的<?php echo $cdata["charaName"]; }?>！<br>
<?php echo $cdata["message"];?><br>

<div class="row">
<?php if ($havegoods){?>
<div class="col-lg-<?php echo $haveillust?"6":"12"; ?>">
<a href="#" class="pop-<?php echo $id;?>-goods"  data-toggle="modal" data-target="#imagemodal-<?php echo $id;?>"><img class="celimage" src="<?php echo $cdata["goodslink"] ?>"></a><br>
祭壇： <?php echo $cdata ["goodscreator"];?>
</div>
<?php }?>

<?php if ($haveillust){?>
<div class="col-lg-<?php echo $havegoods?"6":"12"; ?>">
<a href="#" class="pop-<?php echo $id;?>-illust" data-toggle="modal" data-target="#imagemodal-<?php echo $id;?>" ><img class="celimage" src="<?php echo $cdata["illustlink"]; ?>"></a><br>
賀圖：<?php echo $cdata ["illustcreator"];?>
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
即將推出！
<?php }?>
</div>
</body>
</html>