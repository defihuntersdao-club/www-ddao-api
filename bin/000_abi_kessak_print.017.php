#!/usr/bin/php
<?php
include "conf.php";
include "vendor/autoload.php";
//error_reporting(65535);

$num = "017";

$f = "$num.abi";
$a = file_get_contents($f);
//$a = json_decode($a,1);
//$b = $a[abi];
//$abi = json_encode($b,192);
//print $abi;
$abi = $a;
//print "abi:\n$abi\n";
//$abi = file_get_contents($f);
//print_r($abi);die;
//error_reporting(65535);
$contract = new Web3\Contract($rpc, $abi);

//$contractAddress = "0xfc067766349d0960bdc993806ea2e13fcfc03c4d";
$f = "$num.address";
$a = file_get_contents($f);
$contractAddress = $a;
print "Contract: $contractAddress\n";
$a = "
decimal
Sale	1
TxsCount	1	0xfc067766349d0960bdc993806ea2e13fcfc03c4d
TxsAmountGlob	1
TxsAmount	1	0xfc067766349d0960bdc993806ea2e13fcfc03c4d
";

$a = trim($a);;
$mas = explode("\n",$a);

foreach($mas as $v2)
{
    $t = explode("\t",$v2);
    
    $functionName = $t[0];;
print $functionName.":\t";
    $eval = "\$b = \$contract->at(\$contractAddress)->getData('".implode("','",$t)."');";
//print $eval."\n";;
    eval($eval);
//    $b = $contract->at($contractAddress)->getData($functionName);
    $t = substr($b,0,8);
    print "0x".$t."\t";

    print "0x".$b." ";
//    print $eval." ";
    print "\n";
}
