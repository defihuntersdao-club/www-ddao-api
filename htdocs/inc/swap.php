<?php

print "<pre>";
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
    if($v>0)
    $amounts[$nums[$n]] = $v;
}
//print_r($t);
//$t = $item3;
//print "T: $t\n";

$rpc = $rpc_mas[matic];
//print "dfA";
//$o[result] = "99";
$contract = "0x1908e11f43D70F780F2790cA3Db8d9b8164465Fe";
$contract = "0xF051B6AE3e51E456134dE1CD66a784d4f6f792c7";
$a = "0x137bD6F0C5055dE30934FD0278641aF98DE47D23";
$contract = $a;



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
$b = "0x8bb3af21";
$factory = "0x1b02da8cb0d097eb8d57a175b88c7d8b47997506";
$t = $factory;
$t = substr($t,2);
$t = view_number($t,64,"0");
$b .= $t;

$b .= "00000000000000000000000000000000000000000000000000000000000000a0";
$kolvo = count($amounts);
switch($kolvo)
{
    case "1":
    $t = "00000000000000000000000000000000000000000000000000000000000000e0";
    break;

    case "2":
    $t = "0000000000000000000000000000000000000000000000000000000000000100";
    break;
    case "3":
    $t = "0000000000000000000000000000000000000000000000000000000000000120";
    break;
}
$b .= $t;

$t = "0000000000000000000000007ceb23fd6bc0add59e62ac25578270cff1b9f619";
$b .= $t;
$t = "00000000000000000000000090f3edc7d5298918f7bb51694134b07356f7d0c7";
$b .= $t;
$t = $kolvo;
$t = dechex($kolvo);
$t = view_number($t,64,"0");
$b .= $t;
reset($amounts);
unset($b1,$b2);
foreach($amounts as $coin=>$v)
{
    $t = $tkns[$coin];
    $t = substr($t,2);
    $t = view_number($t,64,"0");
    $b1 .= $t;

//print $v." ".(10**$o3[$coin][decimal])."\n";
    $t = gmp_mul($v, 10**$o3[$coin][decimal]);
//print $t."\n";
//    $t = gmp_dechex($t);
    $t = dechex($t);
//print $t."\n";
    $t = view_number($t,64,"0");
    $b2 .= $t;
}
$b .= $b1;

$t = $kolvo;
$t = dechex($kolvo);
$t = view_number($t,64,"0");
$b .= $t;

$b .= $b2;
//print $b."\n";

unset($t2,$v);
//$b = "0x313ce567";
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contract;
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
$mas = curl_mas2($jss,$rpc,0);
print_r($mas);
$t = $mas[0][result];
$t = substr($t,2+64*2);
$l = strlen($t)/64;
for($i=0;$i<$l;$i++)
{
    $t2 = substr($t,$i*64,64);
    print $i."\t".$t2."\n";
    $t4[$i] = $t2;
}
//print_r($t4);
$m = count($t4)-1;
$t = $t4[$m];
$t = hexdec($t);
$t /= 10**18;
$t = floor($t*100)/100;
$o2[buy_swap] = $t;

$o[result] = $o2;
?>