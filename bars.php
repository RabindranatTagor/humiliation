<?php
//bar charts data
$cyear = date("Y");
$lyear = date("Y", strtotime("-1 year"));


$query = "SELECT * FROM zakaz WHERE YEAR(date)='$cyear'"; //curr year data
    if ($result = mysqli_query($link, $query)) {
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $cbars[] = $row;
        }
        mysqli_free_result($result);
    } else echo '<br>MySQLi error: '.mysqli_error($link);

$query = "SELECT * FROM zakaz WHERE YEAR(date)='$lyear'"; //last year data
    if ($result = mysqli_query($link, $query)) {
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $lbars[] = $row;
        }
        mysqli_free_result($result);
    } else echo '<br>MySQLi error: '.mysqli_error($link);

//data group by qnty and by sum
$qcyear = array();
$scyear = array();
foreach($cbars as $item){
    $month = date('m', strtotime($item[2]));
    $qcyear[$month]++;
    if(isset($scyear[$month])){
        $scyear[$month] += $item[4];
    } else $scyear[$month] = $item[4];
}

$qlyear = array();
$slyear = array();
foreach($lbars as $item){
    $month = date('m', strtotime($item[2]));
    $qlyear[$month]++;
    if(isset($slyear[$month])){
        $slyear[$month] += $item[4];
    } else $slyear[$month] = $item[4];
}

?>
