<?php

//print "<pre>";

$prefix = "lp_";

$cache_file = $cache_dir."tmp/$item.json";
//$o[file] = $cache_file;
$ftime = filemtime($cache_file);

//print $cache_file."\n<br>";
$flag = 1;
if(file_exists($cache_file) && $ftime > (time()-30))
{
    $a = file_get_contents($cache_file);
    $o3 = json_decode($a,1);
    $o3[lp_cached] = 1;

    $flag = 0;
//print "==================\n";
}

if($flag)
{
unset($o2);


//$lps[eth][gnft_eth]
$lp[eth][uni_usdc_eth]		= "0xb4e16d0168e52d35cacd2c6185b44281ec28c9dc";
$lp[eth][uni_eth_gnft]		= "0xbcad06fdfcea3fd7d082b14f47a6757e11c5846c";

$lp[matic][sushi_usdc_eth]	= "0x853ee4b2a13f8a742d64c8f088be7ba2131f670d";
$lp[matic][sushi_eth_ddao]	= "0xfc067766349d0960bdc993806ea2e13fcfc03c4d";
$lp[matic][sushi_eth_gnft]	= "0x03b67a0ce884e806673cc92e9a1c4a77d5bc770b";
$lp[matic][quick_usdc_gnft]	= "0x3fd0cc5f7ec9a09f232365bded285e744e0446e2";

foreach($lp as $net=>$v3)
{
    foreach($v3 as $id=>$addr)
    {

//totalSupply: 0x18160ddd
unset($t2,$v);
$b = "0x18160ddd";

/*
$t = substr($w,2);
$t = view_number($t,64,"0");
$b .= $t;

$t = substr($contract,2);
$t = view_number($t,64,"0");
$b .= $t;
*/

$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $addr;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."-".$n."-$pair-$name";
$v[id] = $net."-supply-".$id;
$jss2[$net][] = $v;

//getReserves:    0x0902f1ac 
unset($t2,$v);
$b = "0x0902f1ac";

/*
$t = substr($w,2);
$t = view_number($t,64,"0");
$b .= $t;

$t = substr($contract,2);
$t = view_number($t,64,"0");
$b .= $t;
*/

$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $addr;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."-".$n."-$pair-$name";
$v[id] = $net."-reserves-".$id;
$jss2[$net][] = $v;
	
    }
}
//print_r($jss2);
foreach($jss2 as $net=>$jss)
{
$rpc = $rpc_mas[$net];
$mas = curl_mas2($jss,$rpc,0);
//print_r($mas);

    foreach($mas as $v2)
    {
	$id = $v2[id];
	$t = explode("-",$id);
	$net = $t[0];
	$case = $t[1];
	$whats = $t[2];
	$v = $v2[result];
		$t = explode("_",$whats);
		$c1 = $t[1];
		$c2 = $t[2];
		$pair = $c1."_".$c2;

	switch($case)
	{
	    case "supply":
		$t = $v;
		$t = hexdec($t);
		$t /= 10**18;
		$v = $t;
		$o2[$net][$pair][supply] = $v;
		if($v > 1)
		{
		//$v = round($v,2);
		$v = number_format($v,2,"."," ");
		}
		else
		$v = substr($v,0,7);
		$o2[$net][$pair][supply2] = $v;
	    break;
	    case "reserves":
		$t = substr($v,2);
		$r1 = substr($t,0,64);
		$r1 = hexdec($r1);
		if($c1=="usdc")
		$r1 /= 10**6;
		else
		$r1 /= 10**18;

		$r2 = substr($t,64,64);
		$r2 = hexdec($r2);
		$r2 /= 10**18;
		$o2[$net][$pair][coin1] = $c1;
		$o2[$net][$pair][coin2] = $c2;
		$o2[$net][$pair][r1] = $r1;
		$o2[$net][$pair][r2] = $r2;
		
		if($pair == "usdc_eth" || $pair == "usdc_gnft")
		{
		    $t = $r1/$r2;
		    $o2[$net][$pair][rate] = $t;
		}
		else
		{
		    $t = $r1/$r2;
		    $t *= $o2[$net][usdc_eth][rate];
		    $o2[$net][$pair][rate] = $t;
		}
//		$t = $t;
		$t = number_format($t,2,"."," ");
		$o2[$net][$pair][rate2] = $t;

		if($c1=="usdc")
		{
		    $o2[$net][$pair][tvl2] = $r1*2;
		}
		else
		{
		    $o2[$net][$pair][tvl2] = $r1 * 2 * $o2[$net][usdc_eth][rate];
		}
		$t = $o2[$net][$pair][tvl2];
		$t = number_format($t,2,"."," ");
		$o2[$net][$pair][tvl] = $t;



		$t = $o2[$net][$pair][tvl2] / $o2[$net][$pair][supply];
		$o2[$net][$pair][lp_rate2] = $t;
		$p = "";
		if($t > 1000)
		{
		    $t /= 1000;
		    $p = "k";
		}
		if($t > 1000)
		{
		    $t /= 1000;
		    $p = "M";
		}
		if($t > 1000)
		{
		    $t /= 1000;
		    $p = "B";
		}
//		$t = $p."\$ ".round($t,2);
		$t = round($t,2)." $p\$";
		$o2[$net][$pair][lp_rate] = $t;

		$t = $r1;
		$t = number_format($t,2,"."," ");
		$o2[$net][$pair][$c1] = $t;

		$t = $r2;
		$t = number_format($t,2,"."," ");
		$o2[$net][$pair][$c2] = $t;

	    break;
	}
    }

}
//print_r($o2);die;
foreach($o2 as $net=>$v3)
{
    foreach($v3 as $pair=>$v2)
    {

	$k = $pref.$net."_".$pair;
	$k2 = $k;
	switch($k)
	{
	    case "eth_eth_gnft":
		$k2 = "eth_uni_gnft";
	    break;
	    case "matic_eth_ddao":
		$k2 = "matic_sushi_ddao";
	    break;
	    case "matic_eth_gnft":
		$k2 = "matic_sushi_gnft";
	    break;
	    case "matic_usdc_gnft":
		$k2 = "matic_quick_gnft";
	    break;


	}
	reset($v2);
	foreach($v2 as $k4=>$v4)
	{
	    $k5 = $prefix.$k2."_".$k4;
	    $o3[$k5] = $v4;
	}
    }
}
$txt = json_encode($o3,192);
file_put_contents($cache_file,$txt);

}


$o[result] = $o3;
//print_r($o3);