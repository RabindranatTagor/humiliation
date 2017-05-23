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
$qcyear = array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0);
$scyear = array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0);
foreach($cbars as $item){
    $month_s = date('m', strtotime($item[2]));
    $month = intval($month_s, 10);
    $qcyear[$month]++;
    $scyear[$month] += $item[4];
}

$qlyear = array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0);
$slyear = array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0);
foreach($lbars as $item){
    $month_s = date('m', strtotime($item[2]));
    $month = intval($month_s, 10);
    $qlyear[$month]++;
    $slyear[$month] += $item[4];
}

?>
