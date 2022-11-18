<?php

//print "<pre>";

$d = __DIR__;
$d = dirname($d);
$cache_dir = $d."/cache/";

$w = $item2;



//print_r($var_query);
$t = $_GET["a"];
$t = explode("|",$t,4);
unset($t[3]);
$nums[0] = "usdc";
$nums[1] = "usdt";
$nums[2] = "dai";
foreach($t as $n=>$v)
{
//    if($v>0)
    $amounts[$nums[$n]] = $v;
}

$t = serialize($nums);
$t = md5($t);
$cache_file = $cache_dir."$item.$w.$t";

$ftime = filemtime($cache_file);

if(file_exists($ftime) && $ftime > time()-10)
{
    $a = file_get_contents($cache_file);
    $o2 = json_decode($a);
    
}
else
{

/*
function decimals($coin)
{
    switch($coin)
    {
	case "usdt":
	case "usdc":
	$o = 6;
	break;
	default:
	$o = 18;
    }
    return $o;
}
*/
//print_r($t);
//$t = $item3;
//print "T: $t\n";

$rpc = $rpc_mas[matic];
//print "dfA";
//$o[result] = "99";
$contract = "0x1908e11f43D70F780F2790cA3Db8d9b8164465Fe";
$contract = "0xF051B6AE3e51E456134dE1CD66a784d4f6f792c7";
$a = "0x137bD6F0C5055dE30934FD0278641aF98DE47D23";
$a = "0xDBBA9F5372Ced8fc1Fda5669d13F2a23D446267d";
$a = "0xca4f9cb94E73569e5069388D33756905528A1ea6";
$a = "0xE6bDEF88781A9864a2958F97cea044Ba8dB1209a";
$a = "0x87ded972eDcB9aEbc161018D2529FBBFAa4f3A03";
$a = "0x5cb435C6a3e38B9Cb4848495546FDad209AC7f52";
$a = "0xe33912aC643E54e5e2834531734Cb65864C9BCd3";
$a = "0xfA04C0BA0707608472a756558e7D1605Cca78D48";
$a = "0x2BFA8deE226246b45cb0b416A65050f74888f37A";
$a = "0xBF8ac643Fea62910D1d2fA9ae5049CEe6A76aa05";
$a = "0x3e3a6721293d2eb25d5C3CdcA1CEF1006A531c78";
$a = "0xCb7B3ff495456a489b724AB8248a5E009FD85567";
$a = "0xEff30a0e1B7D404aa7DbD7e6e31d6dDe1dFE4042";
$a = "0x4Cb1aacFC7d6aD8F1fa99CAb3554fFC16C48b10B";
$a = "0x37498FF209FEe42D4ce4e3cdf24081644772EBb5";
$a = "0xeF1365166832aa2256920b93583f42d81D879439";
$a = "0x149Cc2da81625da172B04E7647D17B66ef885963";
$a = "0x0aEFc83570dEfBEd8bE28A897c71aB5a342063cE";
$a = "0x918294145B18Ae868b00efa4b7AFe3c3869b8A27";
$a = "0x33C14A6686353442f282321Fa6aFd1FcE766496A";
$a = "0xb9CC2bC73AEcC705Bf7346b32710D6b286aB0bB9";
$a = "0xd0b123cF3c2E2d7b6C49186ef43c96Ed94386020";
$a = "0x759BafaAAE3B0571DEd22E1EA700fdaD376fb46c";
$a = "0x88b752854b948e79fEdeB491E78235A11C680a30";
$a = "0x3265B3DdC9E3394E7cA01dD5Cc21BA98a98dB57E";
$a = "0x394457FC5164474d7A42e9aCaA8b37792404C48C";
$a = "0x967670A00ca38826A551Fe0e7a13Ea47049552E2";
$a = "0x4F9196D325A1cDEBa066d74DB01Af2615717d8f1";
$a = "0x4F4a59b20BD8C670cBe4E066bf30024dA8a62801";
$a = "0x60486a16183aee735e672A33469d4Aa270c6b437";
$a = "0xeC85aa35F66b25426B1a988b90D91e73825ed9c7";
$a = "0x90560D7DEDa4384cd129e40D40DB8107f670EF01";
$a = "0xd1759e64F074C0A146652f7A75a1f03394Ef0Dfd";
$a = "0xdE96d78C1eD99EC135173193eeFaA9443f6c9dc3";
$a = "0x5608C0f49E21D3193d9268Bf9Cf5bA1692963670";
$a = "0x381D0BCF610d577bc142d597Bc8632E3523b3C21";
$a = "0x6d8c8e902CC5C0c8bA977c65005EA7A05d3B79F2";
$a = "0x04E31c352DA1ffC6A0A83450432320dccec0eAE5";
$a = "0x5d75668712a8f300680EEBf9d17a57CF3aae5dd2";
//$a = "0xB78DE295b26d54969A6581A4944e61860A93F520";
$contract = $a;

$a = "0x04E31c352DA1ffC6A0A83450432320dccec0eAE5";
$contract_read = $a;


$tkns[usdc] = "0x2791Bca1f2de4661ED88A30C99A7a9449Aa84174";
$tkns[usdt] = "0xc2132D05D31c914a87C6611C10748AEb04B58e8F";
$tkns[dai]  = "0x8f3Cf7ad23Cd3CaDbD9735AFf958023239c6A063";

foreach($tkns as $coin=>$addr)
{
unset($t2,$v);
$b = "0xdd62ed3e";

$t = substr($w,2);
$t = view_number($t,64,"0");
$b .= $t;

$t = substr($contract,2);
$t = view_number($t,64,"0");
$b .= $t;


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
$v[id] = "allowance_".$coin."_".$w;
$jss[] = $v;
//------------------------
unset($t2,$v);
$b = "0x313ce567";
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
$v[id] = "decimal_".$coin."_".$w;
$jss[] = $v;

}
//print_r($jss);
unset($o3);
$mas = curl_mas2($jss,$rpc,0);
//print_r($mas);
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = $id;
    $t = explode("_",$t);
    $case = $t[0];
    $coin = $t[1];
    $wal = $t[2];
    $v = $v2[result];
    $v = gmp_hexdec($v);
    $v = gmp_strval($v);
    $o3[$coin][$case] = $v;
//    $o3[$id][$case] = $v;
}
//print_r($o3);
foreach($o3 as $coin=>$v2)
{
    $t = $v2[allowance]/10**$v2[decimal];
    $t = gmp_div_q($v2[allowance],10**$v2[decimal]);
    $t = gmp_strval($t);
    if($t > 1000000)$t = "&#8734;";
    $o2["buy_allowance_".$coin] = $t;
}
// print_r($o2);
unset($jss);
//print_r($amounts);
$b = "0x86bd0c12";
//$factory = "0x1b02da8cb0d097eb8d57a175b88c7d8b47997506";

foreach($amounts as $coin=>$v)
{
$t = $v;
//print $t."\t";
//$t = gmp_mul($t,10**decimals($coin));
//print $t."\t";
$t = dechex($t);
//print $t."\t";
//print "\n";
//$t = gmp_dechex($t);
//print "$coin: $v ".decimals($coin)."\n";
//print $t."\n";
//$t *= 10**decimals($coin);
//$t = 
//$t = substr($t,2);
$t = view_number($t,64,"0");
$b .= $t;
}
//print $b."\n";

unset($t2,$v);
//$b = "0x313ce567";
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contract_read;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."-".$n."-$pair-$name";
$v[id] = "calc";
$jss[] = $v;

//print_r($jss);

$mas = curl_mas2($jss,$rpc,0);
//print_r($mas);

$t = $mas[0][result];
$t = substr($t,2+64*2);
$l = strlen($t)/64;
for($i=0;$i<$l;$i++)
{
    $t2 = substr($t,$i*64,64);
    $t3 = hexdec($t2);
    $t31 = $t3 / 10**18;
//    print $i."\t".$t2."\t$t3\t$t31\n";
    $t4[$i] = $t2;
}
//print_r($t4);
$m = count($t4)-3;
$t = $t4[$m];
$t = hexdec($t);
$t /= 10**18;
$t = floor($t*100)/100;
$o2[buy_swap] = $t;

$txt = json_encode($o2,192);
file_put_contents($cache_file,$txt);
}

$o[result] = $o2;
?>