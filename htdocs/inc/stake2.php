<?php
//include "conf.php";
//include "../../vendor/autoload.php";
//include "../../vendor_erc20/autoload.php";
//error_reporting(65535);

//print "<pre>";

$rpc = $rpc_mas[matic];

//print_r($items);
$w = $item2;

$t = __FILE__;
$t = pathinfo($t);
$t =  $t[filename];
$t = explode("_",$t);
$net = $t[1];
$sol = $t[2];

//$net = "localhost";
//$sol = "vault";

//$w = $wals[nn][0];
//$pk = $wals[wal][$w];
//$w = "0x330ec7c6afc3cf19511ad4041e598b235d44862f";


//$rpc = $rpc_mas[$net];
//$chain_id = $glob[chain_id][$net];
//$usdc = "0xBfd995F0F67C1A3772146862132C2B716E745452";

//$d = __DIR__."/abi/";
//$contractAddress = "0xfc067766349d0960bdc993806ea2e13fcfc03c4d";
//$f = "y_contract.$net.$sol.txt";
//print "F: $f\n";
//$a = file_get_contents($f);
$a = "0x40f94039968a98053b858e0A6EE34308f7075790";
$a = "0x071553BBaf05799496C02A287d3416934f3bB4EA";
$contractAddress = $a;
//print "Contract:  $contractAddress\n";

//$f = "y_contract.$net.DDAOStakingLP.txt";
//print "F: $f\n";
//$a = file_get_contents($f);
$a = "0x457280d60d23C40dbA92C00Acd3e701De040C8cb";
$a = "0xfA6c94860d56C59072523FDD230c06163C66ED24";
$contractAddress2 = $a;
//print "Contract2:  $contractAddress2\n";

//$f = "y_contract.$net.dimple.txt";
//$a = file_get_contents($f);
//$contractAddress2 = $a;
//print "Contract2: $a\n";


//foreach($m as $name=>$b)
{
// StakeList:      0xf1dd12ec
    $b = "0xf1dd12ec";

    $t = $contractAddress2;
    $t = substr($t,2);
    $t = view_number($t,64,"0");
    $b .= $t;

    $t = $w;
    $t = substr($t,2);
    $t = view_number($t,64,"0");
    $b .= $t;




unset($v,$t,$t2);

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
$v[id] = $name;
$jss[] = $v;
}
//------------------------
/*
unset($v,$t,$t2);
$b = "0x32fef689";

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
$v[id] = "tick1";
$jss[] = $v;
*/

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

//$keys[0] = "tkn";

$keys[1]  = "nn";
$keys[]  = "owner";
$keys[]  = "grp";
$keys[]  = "lp";
$keys[]  = "amount";
$keys[]  = "utime";
$keys[]  = "interval";
$keys[]  = "closed";
$keys[]  = "closed_time";
$keys[]  = "claim_time";
$keys[]  = "claimed";
//print_r($keys);

$num = count($keys);
//$keys[]  = "";
$v = $mas[0][result];
//          print $v."\n";
            $t = $v;
            $t = substr($t,2+64*2);
            $l = strlen($t)/64;
            for($i=0;$i<$l;$i++)
            {
                $t2 = substr($t,$i*64,64);
                $i2 = $i-3;
                if($i2>=0)
                $nn = ($i2/$num - floor($i2/$num))*$num + 1;
                $nn .= "";

                switch($nn)
                {
                    case "2":
                    case "4":
                        $t3 = "0x".substr($t2,24);
                    break;
                    case "-1":
                    $t3 = hexdec($t2);
                    $t3 /= 10**18;
                    break;
                    case "-15":
                    $t3 = hexdec($t2);
                        if($t3)
                        $t3 .= " ".date("Y-m-d H:i:s",$t3);
                    break;
                    default:
                    $t3 = hexdec($t2);
                }
                if($i==1)$step = $t3;
                $nn2 = $keys[$nn];
                if($nn2 == "nn")$id = $t3;
//          $tt = ($i/2 - floor($i/2))*2;
//          if($tt == 1)$t3 = date("Y-m-d H:i:s",$t3);
//              $id = $
		/*
                print $i."\t";
//              print $tt."\t";
                print $nn."\t";
                print "$t2\t";
                print view_number($keys[$nn],20," ")."\t";
                print "$t3\t";
                print "\n";
		*/
                if($id)
                {
                $o3[$id][$nn2] = $t3;

                }

            }


$grps[1] = "lp_matic_sushi_ddao";
$grps[2] = "lp_matic_sushi_gnft";
$grps[3] = "lp_matic_quick_gnft";

$grps2[1] = "DDAO/ETH";
$grps2[2] = "GNFT/ETH";
$grps2[3] = "GNFT/USDC";
foreach($o3 as $nn=>$o2)
{
    $id = $o2[nn];
    $o3[$id][until] = $o2[utime] + $o2[interval] * $step;
    $o3[$id][until_time] = "UTC ".date("Y-m-d H:i:s",$o3[$id][until]);
    $o3[$id][time] = date("Y-m-d H:i:s",$o2[utime]);
    $o3[$id][closed_time2] = "UTC ".date("Y-m-d H:i:s",$o3[$id][closed_time]);

    $t = bcdiv($o2[amount],10**18,18);
//print $t."|";
    $t = strrev($t);
    $l = strlen($t);

    for($i=0;$i<$l;$i++)
    {
//print $t[$i]."-";
	if($t[$i]=="0")$t[$i] = " ";
	else break;
    }
    $t = strrev($t);
    $t = trim($t);
//print "\nT: $t\n";
    $a = $t;
//    $a = bcdiv($o2[amount],10**18,18);
    $o3[$id][amount2] = $a;
    if($o2[closed]==0)
    {
    $amount[$o2[grp]] += $o2[amount];
    $amount_count[$o2[grp]]++;
    $staked_quantity[$o2[grp]]++;
    }
//  $html[$grps[$o2[grp]]."_wal_lp_count_staked"]++;
    $o3[$id][pair] = $grps2[$o3[$id][grp]];
//    $html
}

//print_r($amount);
reset($grps);
//foreach($amount as $grp=>$a)
foreach($grps as $grp=>$g)
{
    $a = $amount[$grp];
/*
    $t = bcdiv($a,10**18,18);
    $t = strrev($t);
    $l = strlen($t);
    for($i=0;$i<$l;$i++)
    {
	if($t[$i]=="0")$t[$i] = "";
	else break;
    }
    $t = strrev($t);
*/
//    $html[$grps[$grp]."_wal_lp_bal_staked"] = bcdiv($a,10**18,18);
    $k = $g."_wal_lp_bal_staked";
    $v = 0;
    if($a)
    {
	$v = bcdiv($a,10**18,18);
	$t = $v;
	$t = strrev($t);
	$l = strlen($t);
	for($i=0;$i<$l;$i++)
	{
	if($t[$i]=="0")$t[$i] = " ";
	else break;
	}
	$t = strrev($t);
	$t = trim($t);
	$v = $t;
    }
    $html[$k] = $v;
    $v = $staked_quantity[$grp];
    $v *= 1;
    $k = $g."_wal_lp_count_staked";
    $html[$k] = $v;
}
$nn=0;
krsort($o3);
foreach($o3 as $v2)
{
    $o4[$nn] = $v2;
    $nn++;
}

$o[result]["list"] = $o4;
$o[result]["list_length"] = count($o4);
$o[result][html] = $html;
//$o[result][amount_count] = $amount_count;
//print_r($o3);
//print_r($amount2);

