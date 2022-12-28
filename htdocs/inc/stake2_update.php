<?php

//print "<pre>";

$rpc = $rpc_mas[matic];


$contractAddress = $contracts[stake2];
//print "contract: $contractAddress\n";

unset($v,$t,$t2);
// UpdateTime:     0x1bbe5a9a
$b = "0x1bbe5a9a";

$t = 0;
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
$t = time()-$t;
//print "Get data from blockchain in ".count($jss)." requests [$t sec]\n";

//print_r($mas);

foreach($mas as $v2)
{
    $id = $v2[id];
    $v = $v2[result];
    switch($id)
    {
	default:
	$v = hexdec($v);
    }
    $o2[$id] = $v;
}

$o[result] = $o2;
?>