<?php
$w = $item2;
$tbl = "address";

//$debug_file = "/tmp/api_debug.txt";
//$debug = @file_get_contents($debug_file);


//print_r($_SERVER);
$ref = $_SERVER[HTTP_REFERER];

if(strlen($w)==42 && substr($w,0,2)=="0x")
{



    $query = "SELECT * FROM $tbl WHERE name = '$w'";
    $res = mysqli_query($con,$query);
//print_r($res);
//print "kolvo: $kolvo\n";
    $q[time_update] = date("Y-m-d H:i:s");
    $q[ymdhi] 	= date("YmdHi");
    $q[ymdh] 	= date("YmdH");
    $q[ymd] 	= date("Ymd");

    $kolvo = mysqli_num_rows($res);
    if($kolvo)
    {

        $q_add = mas2sqlmas($q);
	$query = "UPDATE $tbl SET ".implode(",",$q_add)." WHERE name = '$w'";
	$q_log[] = $query;
	$res = mysqli_query($con,$query);
    }
    else
    {
	$q[name] = $w;
        $q_add = mas2sqlmas($q);
	$query = "INSERT INTO $tbl SET ".implode(",",$q_add)."";
	$q_log[] = $query;
	$res = mysqli_query($con,$query);
    }

//    $o[result] = $w;

    $f = $cache_dir.$w.".json";
    $ftime = filemtime($f);
    $a = file_get_contents($f);
    $a = json_decode($a,1);
    $o[result] = $a;
    $o[result][app_address] = $w;
    $o[updated] = date("Y-m-d H:i:s",$ftime);
    

//    if($debug)    $o[log] = $q_log;
}
else
{
    $o[error] = "Wallet error";
}

if($debug)
{
}

?>