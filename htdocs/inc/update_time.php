<?php

//print "<pre>";

$rpc = $rpc_mas[matic];

$addr = $item2;
//$contractAddress = $contracts[stake2];
//print "contract: $contractAddress\n";

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
$t2[to] = $addr;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "update_time";
$jss[] = $v;


//print_r($jss);
unset($out);
//print "Send ".count($jss)." requests to blockchain\n";
$t = $time;
//print "Get data from blockchain in ".count($jss)." requests\n";

if(count($jss))
{
$mas = curl_mas2($jss,$rpc,0);
}
//print_r($mas);
$t = time()-$t;
$t = $mas[0][result];
$t = hexdec($t);
$o[result][update_time] = $t;
$o[result][addr] = $addr;
?>