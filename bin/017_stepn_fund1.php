#!/usr/bin/php
<?php
include "conf.php";

$rpc = "https://bsc-dataseed1.binance.org";

$prefix = "stepn_fund1_";
//$levels[1] = "lobster";
//$levels[2] = "shark";
//$levels[3] = "whale";
$sale = 1;

print date("Y-m-d H:i:s\n");

$time = time();

$t = __FILE__;
$t = basename($t);
$t = explode("_",$t);
$num = $t[0];
$f = "$num.address";
$a = file_get_contents($f);

//$contractAddress = "0xe9Ee76b9B66D8f3E540e49B7Ebf64D1Ca9e37Fd8";
$contractAddress = $a;
print "Contract address: ".$contractAddress."\n";
$o[glob][contract] = $contractAddress;

//die;
unset($t,$v);
$b = "0xc0a8d68d";
//$t2 = substr($w,2);
$t2 = $sale;
$t2 = view_number($t2,64,"0");
$b .= $t2;
$t[data] = $b;
$t[to] = $contractAddress;
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = "Sale";
$jss[] = $v;

unset($t,$v);
$b = "0x76809ce3";
//$t2 = substr($w,2);
//$t2 = $sale;
//$t2 = view_number($t2,64,"0");
//$b .= $t2;
$t[data] = $b;
$t[to] = $contractAddress;
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = "decimal";
$jss[] = $v;

unset($t,$v);
$b = "0x3dd0b70a";
//$t2 = substr($w,2);
$t2 = $sale;
$t2 = view_number($t2,64,"0");
$b .= $t2;
$t[data] = $b;
$t[to] = $contractAddress;
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = "all";
$jss[] = $v;




if(count($jss))
{
$mas = curl_mas($jss,$rpc,1);
}
//print_r($mas);die;

foreach($mas as $v2)
{
    $id = $v2[id];
    $v = $v2[result];
    $skip_o = 0;
    switch($id)
    {
	case "Sale":
	    unset($t4);
	    $t = substr($v,2);
	    $l = strlen($t)/64;
	    for($i=0;$i<$l;$i++)
	    {
		$t2 = substr($t,$i*64,64);
		$t3 = hexdec($t2);
		$t4[$i] = $t3;
	    }	    
	    //print_r($t4);
	    $o[glob][id] = $t4[0];
	    $o[glob][status] = $t4[1];
	    $o[glob][minimal]	= $t4[3];
	    $skip_o = 1;
	break;
	case "all":
	case "decimal":
	    $v = gmp_hexdec($v);
	    $v = gmp_strval($v);
//	    $v = "111";
	    //if()
	break;

    }
    if(!$skip_o)
    $o[glob][$id] = $v;
}
print_r($o);
//die;
$o2 = $o;
//print_r($o);die;

do
{
unset($o,$o3);
$o = $o2;
unset($q);
unset($jss);
unset($wal_mas);
$q[] = "SELECT * FROM address WHERE ymdhi = '".date("YmdHi",time())."'";
$q[] = "SELECT * FROM address WHERE ymdhi = '".date("YmdHi",time()-60)."'";
$query = "(".implode(")UNION(",$q).")";
//print $query."\n";
$res = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($res))
{
//    print_r($row);
    $w = $row[name];
    $w = strtolower($w);
    $wal_mas[] = $w;
}
print_r($wal_mas);

reset($wal_mas);
foreach($wal_mas as $w)
{
//---------------------------------------------
unset($t,$v);
$b = "0x04c343fc";


$t2 = $sale;
$t2 = view_number($t2,64,"0");
$b .= $t2;

$t2 = $w; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;


//$t2 = $contractAddress; 
//$t2 = substr($t2,2);
//$t2 = view_number($t2,64,"0");
//$b .= $t2;

$t[data] = $b;
$t[to] = $contractAddress;
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = $w."-txs";
$jss[] = $v;
//---------------------------------------------
unset($t,$v);
$b = "0x6c32cdd9";


$t2 = $sale;
$t2 = view_number($t2,64,"0");
$b .= $t2;


$t2 = $w; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;

//$t2 = $contractAddress; 
//$t2 = substr($t2,2);
//$t2 = view_number($t2,64,"0");
//$b .= $t2;

$t[data] = $b;
$t[to] = $contractAddress;
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = $w."-amount";
$jss[] = $v;
//---------------------------------------------
unset($t,$v);

$t[data] = "";
//$t[to] = $o[TokenAddress];
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_getBalance";
//$v[params][0] = $row[wal];
$v[params][0] = $w;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = $w."-balance";
$jss[] = $v;



}
if(count($jss))
{
//print_r($jss);
$mas = curl_mas($jss,$rpc,1);
}
//print_r($mas);die;
foreach($mas as $v2)
{
    $t = $v2[id];
    $t = explode("-",$t);
    $w = $t[0];
    $id = $t[1];
    $v = $v2[result];
    switch($id)
    {
/*
	case "stake":
	    $t = substr($v,2);
	    $l = strlen($t)/64;
	    for($i=0;$i<$l;$i++)
	    {
		$t2 = substr($t,$i*64,64);
		$t3 = hexdec($t2);

	    switch($i)
	    {
		case "0":$i2 = "enable";break;
		case "1":$i2 = "amount";break;
		case "2":$i2 = "unlock";break;
		case "3":$i2 = "frozen";break;
		case "4":$i2 = "utime";break;

	    }
		$t4[$i2] = $t3;
	    }

		if($t4[utime])
		{
		$t4[time] = date("Y-m-d H:i:s",$t4[utime]);
		$t4[sec] = time()-$t4[utime];
		$t4[min] = floor($t4[sec]/60);
		$t4[hour] = floor($t4[min]/60);
		}

	    $o[wals][$w][$id] = $t4;
	break;
*/
	default:
	$v = hexdec($v);
	$o[wals][$w][$id] = $v;
    }
}
//print_r($o);die;
//-----------------------
foreach($o[wals] as $w=>$v2)
{
    $kk = $prefix."contract";
    $o3[$w][$kk] = $o[glob][contract];

    $kk = $prefix."decimal";
    $o3[$w][$kk] = $o[glob][decimal];

    $kk = $prefix."all";
    $t = $o[glob][all]/10**18;
    $t = round($t,2);
//    $o3[$w][$kk] = rand(0,10);
    $o3[$w][$kk] = $t;

    $kk = $prefix."minimal";
    $t = $o[glob][minimal];
    $tt = 18-$o[glob][decimal];
    if($tt < 0)
    $t2 = 10**$tt;
    else
    $t2 = 1/10**abs($tt);
    $o3[$w][$kk] = $t*$t2;
    $kk = $prefix."step";
    $o3[$w][$kk] = $t2;;

    $kk = $prefix."status";
    $t = $o[glob][minimal];
    if($t==1)
    $t = "live";
    else
    $t = "finished";    
    $o3[$w][$kk] = $t;;

    foreach($v2 as $k=>$v)
    {
	$kk = $prefix.$k;
	switch($k)
	{
	    case "amount":
	    case "balance":
		$v /= 10**18;
		$t = $v;
		$t *= 1000;
		$t = ceil($t);
		$t /= 1000;
		$v = $t;
	    
	    break;
	}
	$o3[$w][$kk] = $v; 
    }
}
//print_r($o);
//print_r($o3[$w]);die;

foreach($o3 as $w=>$v2)                                                                                                                                                                      
{                                                                                                                                                                                           
    $txt = json_encode($v2,192);                                                                                                                                                            
    $t = pathinfo(__FILE__);                                                                                                                                                                
    $f = $cache_dir."tmp/".$w.".".$t[filename].".json";                                                                                                                                     
    $a = @file_get_contents($f);                                                                                                                                                            
//    if(file_exists($f))                                                                                                                                                                   
//print $f."\n";                                                                                                                                                                            
//print "md5(a) = ".md5($a)."\n";                                                                                                                                                           
//print $a;                                                                                                                                                                                 
//print "\nmd5(t) = ".md5($txt)."\n";                                                                                                                                                       
//print $txt."\n";                                                                                                                                                                          
                                                                                                                                                                                            
    if(md5($a) != md5($txt))                                                                                                                                                                
    {                                                                                                                                                                                       
    file_put_contents($f,$txt);                                                                                                                                                             
    print "Save $w\n";                                                                                                                                                                      
    }                                                                                                                                                                                       
                                                                                                                                                                                            
}                        


//print ".";
//sleep(1);
for($i=0;$i<3;$i++)                                                                                                                                                                         
{                                                                                                                                                                                           
    print ".";                                                                                                                                                                              
    sleep(1);                                                                                                                                                                               
}      
}
//while(0);
while(time() < ($time+59));
//print_r($o);
//print_r($o3);