<?php
define('FIRSTDAY','2020-7-17');  //開始倒數第一天
define('ANNIVDATE','2020-8-16');  //週年當日
define('COUNTDAYS',31); //倒數天數（包括當天）

function datecompare($date,$rdate){
// true: after or same day reference
// false: before reference

$d = explode("-",$date);
$year = $d[0];
$month = $d[1];
$day = $d[2];

$rd = explode("-",$rdate);
$ryear = $rd[0];
$rmonth = $rd[1];
$rday = $rd[2];


if ($year < $ryear || ($year == $ryear && $month < $rmonth) || ($year == $year && $month == $rmonth && $day < $rday)){
    return false;
}
else if ($year > $ryear || ($year == $ryear && $month > $rmonth) || ($year == $year && $month == $rmonth && $day >= $rday)){
    return true;
}
else return false;

}