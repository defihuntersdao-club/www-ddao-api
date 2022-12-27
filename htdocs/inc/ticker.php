<?php
//include "conf.php";
//include "../../vendor/autoload.php";
//include "../../vendor_erc20/autoload.php";
//error_reporting(65535);

//print "<pre>";

$rpc = $rpc_mas[matic];

//print_r($items);
$w = $item3;
$contractAddress = $item2;

$a = $contracts[stake2];
$contractAddress2 = $a;


//------------------------------------------
unset($v,$t,$t2);
$b = "0x313ce567";
//$t = $w;
//$t = substr($t,2);
//$t = view_number($t,64,"0");
//$b .= $t;

//$t = substr($w,2);
//$b .= view_number($i,64,0);
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contractAddress;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "decimals";
$jss[] = $v;

//----------------------
unset($v,$t,$t2);
$b = "0x18160ddd";
//$t = $w;
//$t = substr($t,2);
//$t = view_number($t,64,"0");
//$b .= $t;

//$t = substr($w,2);
//$b .= view_number($i,64,0);
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contractAddress;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "supply";
$jss[] = $v;

//----------------------
unset($v,$t,$t2);
$b = "0x06fdde03";
//$t = $w;
//$t = substr($t,2);
//$t = view_number($t,64,"0");
//$b .= $t;

//$t = substr($w,2);
//$b .= view_number($i,64,0);
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contractAddress;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "name";
$jss[] = $v;

//------------------------------------------
unset($v,$t,$t2);
$b = "0x95d89b41";
//$t = $w;
//$t = substr($t,2);
//$t = view_number($t,64,"0");
//$b .= $t;

//$t = substr($w,2);
//$b .= view_number($i,64,0);
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contractAddress;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "abbr";
$jss[] = $v;
//------------------------------------------
unset($v,$t,$t2);
$b = "0x70a08231";
$t = $w;
$t = substr($t,2);
$t = view_number($t,64,"0");
$b .= $t;

//$t = substr($w,2);
//$b .= view_number($i,64,0);
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contractAddress;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "balance_".$w;
$jss[] = $v;
//------------------------------------------
unset($v,$t,$t2);
$b = "0x70a08231";
$t = $contractAddress2;
$t = substr($t,2);
$t = view_number($t,64,"0");
$b .= $t;

//$t = substr($w,2);
//$b .= view_number($i,64,0);
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contractAddress;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "balanceContract_".$contractAddress2;
$jss[] = $v;
//------------------------------------------
unset($v,$t,$t2);
$b = "0xdd62ed3e";

$t = $w;
$t = substr($t,2);
$t = view_number($t,64,"0");
$b .= $t;

$t = $contractAddress2;
$t = substr($t,2);
$t = view_number($t,64,"0");
$b .= $t;


//$t = substr($w,2);
//$b .= view_number($i,64,0);
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contractAddress;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "allowance_".$w;
$jss[] = $v;
//------------------------------------------
//print_r($jss);
unset($out);
//print "Send ".count($jss)." requests to blockchain\n";
$t = $time;
//print "Get data from blockchain in ".count($jss)." requests\n";
if(count($jss))
{
$mas = curl_mas2($jss,$rpc,0);
}
$t = time()-$t;
//print "Get data from blockchain in ".count($jss)." requests [$t sec]\n";

//print_r($mas);

foreach($mas as $v2)
{
    $id = $v2[id];
    $t = explode("_",$id);
    $case = $t[0];
    $v = $v2[result];
    switch($case)
    {
	case "abbr":
	case "name":
	    $t = $v;
	    $t = substr($t,64*2+2);
	    $c = "";
	    for($i=0;$i<32;$i++)
	    {
		$t2 = substr($t,$i*2,2);
		if($t2 == "00")break;
		$t2 = hexdec($t2);
		$t3 = chr($t2);
		$c .= $t3;
	    }
	    $v = $c;
	break;
	case "allowance":
	case "supply":
	case "balance";
	case "balanceContract";
	    $t = $v;
	    $t = gmp_hexdec($t);
	    $t = bcdiv($t,10**$o2[decimals],18);
	    $a = $t;
    if($a)
    {
//        $v = bcdiv($a,10**18,18);
//        $t = $v;
        $t = strrev($t);
        $l = strlen($t);
        for($i=0;$i<$l;$i++)
        {
        if($t[$i]=="0")$t[$i] = " ";
        else break;
        }
        $t = strrev($t);
        $t = trim($t);
	$l = strlen($t);
	if($t[$l-1] == ".")
	$t = substr($t,0,$l-1);
        $v = $t;
    }
	break;
	default:
	$v = hexdec($v);
    }
    $o2[$case] = $v;
}
$o[result] = $o2;