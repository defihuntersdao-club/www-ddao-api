<?php

//print "<pre>";
// Sale:   0xc0a8d68d
$id = $item2;
$w = $item3;
unset($v,$t,$t2);

$a = $contracts[alloc_matic];
$contractAddress = $a;

$contractAddress2[matic] = $contractAddress;
$o2[contract] = $contractAddress;

$a = $contracts[alloc_bsc];
$contractAddress = $a;

//$contractAddress2[bsc] = $contractAddress;


$c_key[1] = "name";
$c_key[2] = "url";
$c_key[3] = "img";
$keys[0] = "id";
$keys[] = "exists";
$keys[] = "enabled";
$keys[] = "test_mode";
$keys[] = "hidden";
$keys[] = "amount1d";
$keys[] = "amount2d";
$keys[] = "amount3d";
$keys[] = "cap";


foreach($contractAddress2 as $net=>$contractAddress)
{
//print "contractAddress: $contractAddress\n";
$rpc = $rpc_mas[$net];
unset($jss);

unset($v,$t,$t2);
// UpdateTime:     0x1bbe5a9a
$b = "0x1bbe5a9a";

//$t = 0;
//$t = dechex($t);
//$t = view_number($t,64,0);
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
$v[id] = $net."_contract-update-time";
$jss[] = $v;

//--------------------
unset($v,$t2);
$b = "0xc0a8d68d";
$t = $id;
$t = dechex($t);
//$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
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
$v[id] = $net."_Sale";
$jss[] = $v;
//--------------------
// AllocSaleCount: 0x9462e2df      0x9462e2df0000000000000000000000000000000000000000000000000000000000000001
// AllocSaleAmount:        0xdd3680fc      0xdd3680fc0000000000000000000000000000000000000000000000000000000000000001
// AllocSaleLevelCount:    0xc722c602      0xc722c60200000000000000000000000000000000000000000000000000000000000000010000000000000000000000000000000000000000000000000000000000000001
// AllocSaleLevelAmount:   0x6a1a72bc
unset($v,$t2);
$b = "0x9462e2df";
$t = $id;
$t = dechex($t);
//$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
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
$v[id] = $net."_AllocSaleCount";
$jss[] = $v;
//--------------------------------
unset($v,$t2);
$b = "0xdd3680fc";
$t = $id;
$t = dechex($t);
//$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
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
$v[id] = $net."_AllocSaleAmount";
$jss[] = $v;
//--------------------------------

for($i=1;$i<4;$i++)
{
unset($v,$t2);
$b = "0xc722c602";

$t = $id;
$t = dechex($t);
$t = view_number($t,64,0);
$b .= $t;

$t = $i;
$t = dechex($t);
$t = view_number($t,64,0);
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
$v[id] = $net."_AllocSaleLevelCount_$i";
$jss[] = $v;
//--------------------------------
unset($v,$t2);
$b = "0x6a1a72bc";

$t = $id;
$t = dechex($t);
$t = view_number($t,64,0);
$b .= $t;

$t = $i;
$t = dechex($t);
$t = view_number($t,64,0);
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
$v[id] = $net."_AllocSaleLevelAmount_$i";
$jss[] = $v;
//--------------------------------
//--------------------------------
unset($v,$t2);
// SaleAddrLevelAmount:    0xb64395b5
$b = "0xb64395b5";

$t = $id;
$t = dechex($t);
$t = view_number($t,64,0);
$b .= $t;

$t = $w;
$t = substr($w,2);
$b .= view_number($t,64,0);

$t = $i;
$t = dechex($t);
$t = view_number($t,64,0);
$b .= $t;
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
$v[id] = $net."_SaleAddrLevelAmount_$i";
$jss[] = $v;
//--------------------------------
//--------------------------------
unset($v,$t2);
// SaleAmoutView:  0xabeab5f8
$b = "0xabeab5f8";

$t = $id;
$t = dechex($t);
$t = view_number($t,64,0);
$b .= $t;


$t = $i;
$t = dechex($t);
$t = view_number($t,64,0);
$b .= $t;
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
$v[id] = $net."_SaleAmount_$i";
$jss[] = $v;

}
//--------------------------------
unset($v,$t2);
// SaleAddrLevelAmount:    0xb64395b5
// SaleTokensInfo: 0x45ba83bb
$b = "0x45ba83bb";

$t = $id;
$t = dechex($t);
$t = view_number($t,64,0);
$b .= $t;

$t = $w;
$t = substr($w,2);
$b .= view_number($t,64,0);

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
$v[id] = $net."_SaleTokensInfo_$w";
$jss[] = $v;



//print_r($jss);
if(count($jss))
{
    $nn = 0;
    do
    {
    $nn++;
    if($nn>5)break;
    $mas = curl_mas2($jss,$rpc,0);

    }
    while(!count($mas));
}
//print_r($mas);
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = explode("_",$id);
    $net2 = $t[0];
    $case = $t[1];
    $grp = $t[2];
    $v = $v2[result];

    switch($case)
    {
	case "Sale":
//print "-------------\n";
	    $t = substr($v,2);
	    $l = strlen($t)/64;
//print " - $l -\n";
	    for($j=0;$j<$l;$j++)
	    {
//print "-- $j --\n";
		$t2 = substr($t,$j*64,64);
//		print "$j\t";
//		print "$t2\t";
//		print hexdec($t2);
//		print "\n";
		$t4[$j] = $t2;
	    }
	    $skip = 0;
	    foreach($t4 as $k=>$v3)
	    {
		if($k > 0 && $k == $skip)continue;
		if($k<9)$t5[$keys[$k]] = hexdec($v3);
		else
		{
		    $t = $v3;
		    $t = hexdec($t);
		    $i_c++;
		    if($t>0)
		    {

			$c[$c_key[$i_c]] = "";
			$skip = $k+1;
			$t2 = $t4[$skip];
			for($i2=0;$i2<$t;$i2++)
			{
			    $t3 = substr($t2,$i2*2,2);
			    $t3 = hexdec($t3);
			    $t5[$c_key[$i_c]] .= chr($t3);
			}
		    }
		    else
		    $t5[$c_key[$i_c]] = "";

		}
	    }
//	    print_r($c);

//	    print_r($t4);
//	    print_r($t5);
	    foreach($t5 as $k=>$v3)
	    {
	    $o2["Sale_".$k] = $v3;
	    }

	break;
	case "SaleTokensInfo":
	    unset($t3);
	    $t = substr($v,2);
	    $l = strlen($t)/64;
	    for($j=0;$j<$l;$j++)
	    {
		if($j<2)continue;
		$t2 = substr($t,$j*64,64);
//		print "$j\t";
//		print "$t2\t";
//		print "\n";
		$t3[$j] = $t2;
	    }
	    $l = hexdec($t3[2]);
	    unset($t3[2]);
	    $num = 5;
	    $nn = 0;
	    $nn2 = 1;
//print_r($t3);
	    foreach($t3 as $k3=>$v3)
	    {
		switch($nn)
		{
		    case "0":
			$t = "0x".substr($v3,24);
			$o2[$net."_sale_tkn_".$nn2] = $t;
		    break;
		    case "1":
			$t = hexdec($v3);
			$decimals[$nn2] = $t;
			$o2[$net."_sale_decimals_".$nn2] = $t;
		    break;
		    case "2":
			$t = gmp_hexdec($v3);
			$t = gmp_strval($t);
			$t /= 10**$decimals[$nn2];
			$t = floor($t);
			//$t = gmp_strvb
			//$decimals[$nn2] = $t;
			$o2[$net."_sale_balance_".$nn2] = $t;

		    break;
		    case "3":
			$t = hexdec($v3);
			//$t = gmp_strval($t);
			//$t = $v3;
			//$t = gmp_hexdec($v3);
			//$t = gmp_strval($t);
			//$t = bcdiv($t,10**18);


			$t /= 10**$decimals[$nn2];
			//$t = ceil($t);
			if($t > 100000)$t = "&infin;";
			//$t = gmp_strvb
			//$decimals[$nn2] = $t;
			$o2[$net."_sale_allowance_".$nn2] = $t;
		    break;
		    case "4":
			$t = $v3;
			unset($c);
			for($j=0;$j<32;$j++)
			{
			    $t2 = substr($t,$j*2,2);
			    if($t2 == "00")break;
			    $t2 = hexdec($t2);

			    $c .= chr($t2);
			}
			$o2[$net."_sale_abbr_".$nn2] = $c;
		    break;
		}
		$nn++;
		if($nn>$num){$nn2++;$nn=0;}
	    }
        break;

	case "contract-update-time":
	    $case = str_replace("-","_",$case);

	default:
	$v = hexdec($v);
	if($grp)
	{
	$o2[$case."_".$grp] += $v;
	$o2[$case."_".$net."_".$grp] = $v;
	}
	else
	{
	$o2[$case] += $v;
	$o2[$case."_".$net] = $v;
	}
    }
}


}
//if(!$o2[Sale_img])$o2[Sale_img] = "&lt;img src='/images/no_image.png'&gt;";
//$o2[contract_update_time] = $o2["contract-update-time"];
$t = $o2[AllocSaleAmount] / $o2[Sale_cap];
$t *= 100;
if($t>100)$t = 100;
$t = round($t,2);
$o2[AllocPerc] = $t;
$t = floor($t);
$o2[AllocPerc2] = $t;

ksort($o2);
//print_r($o2);
$o[result] = $o2;
?>