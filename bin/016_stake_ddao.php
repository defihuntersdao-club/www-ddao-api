#!/usr/bin/php
<?php
include "conf.php";

$prefix = "stake_ddao_lock_";
$levels[1] = "lobster";
$levels[2] = "shark";
$levels[3] = "whale";

print date("Y-m-d H:i:s\n");

$time = time();

$f = "016.address";
$a = file_get_contents($f);


//$contractAddress = "0xe9Ee76b9B66D8f3E540e49B7Ebf64D1Ca9e37Fd8";
$contractAddress = $a;
print "Contract address: ".$contractAddress."\n";

//$o3[$w
$cache_file = __FILE__.".cache";
$mtime = filemtime($cache_file);

if(time() < $mtime+259)
{
    $a = file_get_contents($cache_file);
    $o2 = json_decode($a,1);
}
else
{
unset($t,$v);
$b = "0xc2cba306";
//$t2 = substr($w,2);
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
$v[id] = "TokenAddress";
$jss[] = $v;

unset($t,$v);
$b = "0xac253f95";
//$t2 = substr($w,2);
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
$v[id] = "StakeTime";
$jss[] = $v;




if(count($jss))
{
$mas = curl_mas($jss,$rpc,1);
//print_r($mas);
$log2[] = $jss;
$log2[] = $mas;
}
//print_r($mas);
foreach($mas as $v2)
{
    $id = $v2[id];
    $v = $v2[result];
    switch($id)
    {
	case "TokenAddress":
	    $v = "0x".substr($v,26);
	    
	break;
	case "StakeTime":
	    $v = hexdec($v);
//	    $v = "111";
	    //if()
	break;

    }
    $o[$id] = $v;
}
unset($jss);
//print_r($o);
//die;
unset($t,$v);
$b = "0x06fdde03";
//$t2 = substr($w,2);
//$t2 = view_number($t2,64,"0");
//$b .= $t2;
$t[data] = $b;
$t[to] = $o[TokenAddress];
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = "TokenName";
$jss[] = $v;


unset($t,$v);
$b = "0x313ce567";
//$t2 = substr($w,2);
//$t2 = view_number($t2,64,"0");
//$b .= $t2;
$t[data] = $b;
$t[to] = $o[TokenAddress];
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = "TokenDecimals";
$jss[] = $v;
if(count($jss))
{
$mas = curl_mas($jss,$rpc,1);
}
//print_r($mas);
foreach($mas as $v2)
{
    $id = $v2[id];
    $v = $v2[result];
    switch($id)
    {
	case "TokenName":
	    //$v = "0x".substr($v,26);
	    $t = substr($v,64*2+2);
	    $l = strlen($t);
	    $s = "";
	    for($i=0;$i<$l;$i=$i+2)
	    {
		$t2 = substr($t,$i,2);
		if($t2 != "00")
		{
		$t3 = hexdec($t2);
		$s .= chr($t3);
		}
	    }
	    $v = $s;
	break;
	case "TokenDecimals":
	    $v = hexdec($v);
	break;
    }
    $o[$id] = $v;
}
$o2 = $o;
$t = json_encode($o2,192);
file_put_contents($cache_file,$t);
}

$log2[] = $o2;
//print_r($o);die;
$t = date("Y-m-d-H-i-s");
$log_prefix = __DIR__."/logs/016.$t";
do
{
unset($log);
$log = $log2;
$log_file = $log_prefix.".log";

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
$b = "0x70a08231";
$t2 = $w; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;

//$t2 = $contractAddress; 
//$t2 = substr($t2,2);
//$t2 = view_number($t2,64,"0");
//$b .= $t2;

$t[data] = $b;
$t[to] = $o[TokenAddress];
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = $w."-balanceOf";
$jss[] = $v;
//---------------------------------------------
unset($t,$v);
$b = "0x70a08231";
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
$b = "0xdd62ed3e";
$t2 = $w; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;

$t2 = $contractAddress; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;

$t[data] = $b;
$t[to] = $o[TokenAddress];
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = $w."-allowance";
$jss[] = $v;

//---------------------------------------------
unset($t,$v);
$b = "0xe8ed845d";
$t2 = $w; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;

/*
$t2 = $contractAddress; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;
*/
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
$v[id] = $w."-stake";
$jss[] = $v;
//---------------------------------------------
unset($t,$v);
$b = "0x4b945c84";
$t2 = $w; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;

/*
$t2 = $contractAddress; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;
*/
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
$v[id] = $w."-BalanceCheck";
$jss[] = $v;
//---------------------------------------------
unset($t,$v);
$b = "0x62d8660b";
$t2 = $w; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;


//$t2 = $contractAddress; 
//$t2 = substr($t2,2);
$t2 = "0";
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
$v[id] = $w."-StakeUnlockCalc";
$jss[] = $v;

for($i=1;$i<4;$i++)
{
//---------------------------------------------
unset($t,$v);
$b = "0x85b65a17";
$t2 = $w; 
$t2 = substr($t2,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;


$t2 = $i;
$t2 = view_number($t2,64,"0");
$b .= $t2;

//$t2 = $contractAddress; 
//$t2 = substr($t2,2);
$t2 = "0";
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
$v[id] = $w."-balanceOfLevel$i";
$jss[] = $v;

}

}
if(count($jss))
{
//$log[] = $jss;
$mas = curl_mas($jss,$rpc,1);
//$log[] = $mas;
}
//print_r($mas);
foreach($mas as $v2)
{
    $t = $v2[id];
    $t = explode("-",$t);
    $w = $t[0];
    $id = $t[1];
    $v = $v2[result];
    switch($id)
    {
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
		$t41[$i] = $t3;
	    }
$log[t4] = $t4;
$log[t41] = $t41;

		if($t4[utime]*1)
		{
//		$t4[time] = date("Y-m-d H:i:s",$t4[utime]);
		//$t4[sec] = time()-$t4[utime];
		//$t4[min] = floor($t4[sec]/60);
		//$t4[hour] = floor($t4[min]/60);
		}

	    $o[wals][$w][$id] = $t4;
	break;
	default:
	$v = hexdec($v);
	$o[wals][$w][$id] = $v;
    }
}
//-----------------------
//$o3[$prefix."token"] = $o[TokenName];
$decimals = $o[TokenDecimals];
foreach($o[wals] as $w=>$v3)
{
                    $k3 = $prefix."levels";                                                                                                                                                 
                    $o3[$w][$k3] = " ";      
		    $o3[$w][$prefix."contract"] = $contractAddress;
		    $o3[$w][$prefix."address"] = $w;

    foreach($v3 as $k2=>$v)
    {
	$k = "";
	switch($k2)
	{
	    case "balanceOf":
		$k = $pefix."balance";

		$v /= 10**$decimals;
		$v = floor($v);
		if(!$v)$v = "-";
	    break;
	    case "StakeUnlockCalc":
		$k = "unlock";
		$v /= 10**$decimals;
		$v = floor($v);
		if(!$v)$v = "-";
		else
		$v = number_format($v,0,"."," ");

	    break;
	    case "amount":
		$k = $k2;
		$v /= 10**$decimals;
		$v = floor($v);
		if(!$v)$v = "-";
		//$v = "aaaaaaaaaaa";
		//$v = number_format($v,2,"."," ");
	    break;
	    case "allowance":
		$k = $k2;
		$v /= 10**$decimals;
		$v = floor($v);
		if($v > 50000)
		$v = "&#8734;";		
	    break;
	    case "balanceOfLevel1":
	    case "balanceOfLevel2":
	    case "balanceOfLevel3":
		$ii = str_replace("balanceOfLevel","",$k2);
	    	    $k3 = $prefix."levels";
		    if($v)
		    $o3[$w][$k3] .= "<img src=/images/".$levels[$ii].".png class=stake_levels>";

		    if(!trim($o3[$w][$k3]))
		    $o3[$w][$k3] = "-";
	    break;
	
	    case "stake":
		foreach($v as $kk=>$vv)
		{
	    	    $k3 = $prefix.$kk;

		    switch($kk)
		    {
			case "frozen":
			case "amount":
	    		$vv /= 10**$decimals;
			$vv = floor($vv);
			$vv = number_format($vv,0,"."," ");
			break;

			case "utime":
			    $t = $o[StakeTime] + $vv;
			    if(time()>=$t)$t = "Already";
//			    else $t = ($t - time())." sec";
			    else 
			    {
			    $t = floor(($t - time())/60);
			    $tn = "min";
			    if($t>60){$t = ceil($t/60);$tn = "hour(s)";}
//			    if($t>24){$t = ceil($t/24);$tn = "days(s)";}

			    $t = "~".$t." ".$tn;
			    }
			    $o3[$w][$prefix."wait"] = $t;
			    $t = $o[StakeTime];
			    $t /= 60;
			    $t /= 60;
			    $tt = "hours";
			    if($t>24)
			    {
				$tt = "day(s)";
				$t2 = floor($t/24);
				$t = "more $t2";
			    }
			    $o3[$w][$prefix."interval"] = $t." ".$tt;

			break;

			case "":
			break;
			case "":
			break;
		    }

		    $o3[$w][$k3] = $vv;
		}
	    break;
/*
	    case "":
	    break;
	    case "":
	    break;
	    case "":
	    break;
	    case "":
	    break;
*/
	}
	if($k)
	{
	    $k3 = $prefix.$k;
	    $o3[$w][$k3] = $v;
	}
	
    }
    $o3[$w][$prefix."token"] = $o[TokenName];

}
//print_r($o3);die;
foreach($o3 as $w=>$v2)                                                                                                                                                                      
{             
$logs[] = $o3;                                                                                                                                                                              
    $txt = json_encode($v2,192);                                                                                                                                                            
    $t = pathinfo(__FILE__);                                                                                                                                                                
    $f = $cache_dir."tmp/".$w.".".$t[filename].".json";                                                                                                                                     
    $a = @file_get_contents($f);                                                                                                                                                            
//    if(file_exists($f))    print "File exists: $f\n";
//print $f."\n";                                                                                                                                                                            
if(0)
{
print "md5(a) = ".md5($a)."\n";                                                                                                                                                           
print $a;                                                                                                                                                                                 
print "\nmd5(t) = ".md5($txt)."\n";                                                                                                                                                       
print $txt."\n";
}                                                                                                                                                                                            
    if(md5($a) != md5($txt))                                                                                                                                                                
    {     
    //print_r($mas);
    $log[] = $jss;
    $log[] = $mas;
    $log[] = "================== $w ==========";
    $log[] = "----------- old --------------";
    $log[] = $a;
    $log[] = "================== $w ==========";
    $log[] = $txt;
    $log[] = 
    $f2 = $log_prefix.".$w.log";
//    $t = json_encode($log,192);;
    $t = print_r($log,1);
//    file_put_contents($log_file,$t);
    file_put_contents($f2,$t);


    file_put_contents($f,$txt);                                                                                                                                                             
    print "Save $w\n";
    print $txt."\n";                                                                                                                                                                      
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