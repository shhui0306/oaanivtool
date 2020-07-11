<?php
include __DIR__."/datecompare.php";
include __DIR__."/countdown.php";

// find date of today
date_default_timezone_set('Asia/Tokyo');
$today = date("Y-n-j");
//$today = "2021-8-17"; //debug only 除錯用，發佈時請註釋此行

?>
<html>
<head>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Noto+Sans+TC&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">
</head>
<body>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link nav-today active" id="nav-today-tab" data-toggle="tab" href="#nav-today" role="tab" aria-controls="nav-today">今日倒數</a>
    <?php 
    foreach( $unitnames as $unit => $uName){?>
    <a class="nav-item nav-link nav-<?php echo $unit?>" id="nav-<?php echo $unit?>-tab" data-toggle="tab" href="#nav-<?php echo $unit?>" role="tab" aria-controls="nav-<?php echo $unit?>"><?php echo $uName?></a>
    <?php $active = false;}?>
    <a class="nav-item nav-link nav-cel" id="nav-cel-tab" data-toggle="tab" href="#nav-cel" role="tab" aria-controls="nav-cel">當日慶祝</a>
    <div>
</nav>
<div class="tab-content main" id="nav-tabContent">
<div class="tab-pane fade show active" id="nav-today" role="tabpanel" aria-labelledby="nav-today-tab">
<h3>今日倒數</h3>
<div class="card text-center todaychara"></div>
</div>
<?php
    foreach( $unitnames as $unit => $uName){?>
    <div class="tab-pane fade show" id="nav-<?php echo $unit?>" role="tabpanel" aria-labelledby="nav-<?php echo $unit?>-tab">
    <h3><?php echo $uName?></h3>
    <img class="unitimage" src="<?php echo $unitimages[$unit]; ?>">
    <?php 
    if (datecompare($today,$unitdates[$unit])){
    foreach ($countdownlist as $chara){
        if ($chara["unit"] == $unit){?>
    <h4><?php echo $chara["date"]?></h4>
    <div class="card text-center unit-<?php echo $unit?>">
    <div class="chara-<?php echo $chara["id"]?>"></div>
    </div>
    <?php }
    }}else{?>
    <h4>即將推出！</h4>
    <?php }?>
    
    </div>
    <?php $active = false;}?>
    <div class="tab-pane fade show" id="nav-cel" role="tabpanel" aria-labelledby="nav-cel-tab">
        <?php if (datecompare($today,$unitdates["all"])){?>
        <h3>當日慶祝</h3>
        <div class="card text-center celstory"></div>
        <?php }else{?>
          <h4>即將推出！</h4>
          <img class="csimage" src="<?php echo $unitimages["cs"]; ?>">
        <?php }?>
    </div>
</div>
<script type="text/javascript">
        <?php foreach($countdownlist as $chara){?>
            if($(".chara-<?php echo $chara["id"]?>").length){
            $(".chara-<?php echo $chara["id"]?>").load("index.php/?mode=r&reviewday=<?php echo $chara["date"]?>");
            }
        <?php }?>
        $(".todaychara").load("index.php");
        $(".celstory").load("index.php/?mode=r&reviewday=<?php echo ANNIVDATE;?>");
</script>
</body>
</html>