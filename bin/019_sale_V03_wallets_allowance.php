#!/usr/bin/php                                                                                                                                                                              
<?php
include "conf.php";


$prefix = "metatg_";
$sleep = 5;

$cap = 220000;
/*
$net = $argv[1];
if(!$net)
{
    print "Usage: ".$argv[0]." <net>\n\n";
    print "\tExample:\n\t";
    print " ".$argv[0]." matic\n\t";
    print " ".$argv[0]." bsc\n\n5";
    die;
}
*/

print date("Y-m-d H:i:s\n");                                                                                                                                                                
$time = time();

/*
unset($rpc_mas,$c,$tkn);
$f = "/opt/rpc_need.txt";
$a = file_get_contents($f);
$rpc_mas[matic] = $a;
$rpc_mas[bsc] = "https://bsc-dataseed1.binance.org";

//print_r($rpc_mas);

$rpc = $rpc_mas[$net];

//$c[matic] = "0xdFEa9464365bbE652657795B62D6326436BbA67e";
//$c[bsc]   = "0xcEF60B37C31167bd2d714D8729624530126ca5c0";

$c[matic] = "0xD1181ABD73F7561596cc589e26f198C41834F0b4";
$c[bsc] = "0x08Ff8B625AbfB21452b3fb284a85735cAB6fb9f3";

$tkns[matic] = "0x19Ca9521Ec3F01a03476323dd54740C1239eF5e5";
$tkns[bsc] = "0xd4987eBA16672165B14f50C84fC4AEb8Dd986772";

$contractAddress = $c[$net];

$tkn = $tkns[$net];
*/
include "018_conf.php";


do
{
unset($o3);
unset($o4);
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
//die;

foreach($c as $net=>$v2)
{
unset($jss);
$rpc = $rpc_mas[$net];                                                                                                                                                                      
$contractAddress = $c[$net];                                                                                                                                                                
$tkn = $tkns[$net];

//------------------------------                                                                                                                                                            
unset($t,$v);                                                                                                                                                                               
$b = "0x1b4657f9";                                                                                                                                                                          
                                                                                                                                                                                            
$t2 = $sale;                                                                                                                                                                                
$t2 = view_number($t2,64,"0");                                                                                                                                                              
$b .= $t2;                                                                                                                                                                                  
                                                                                                                                                                                            
$t[data] = $b;                                                                                                                                                                              
$t[to] = $contractAddress;                                                                                                                                                                  
$v[jsonrpc] = "2.0";                                                                                                                                                                        
$v[method] = "eth_call";                                                                                                                                                                    
$v[params][0] = $t;                                                                                                                                                                         
$v[params][1] = "latest";                                                                                                                                                                   
$v[id] = "global-txs";                                                                                                                                                                             
$jss[] = $v;                                                                                                                                                                                
//------------------------------                                                                                                                                                            
unset($t,$v);                                                                                                                                                                               
$b = "0xdd3680fc";                                                                                                                                                                          
                                                                                                                                                                                            
$t2 = $sale;                                                                                                                                                                                
$t2 = view_number($t2,64,"0");                                                                                                                                                              
$b .= $t2;                                                                                                                                                                                  
                                                                                                                                                                                            
$t[data] = $b;                                                                                                                                                                              
$t[to] = $contractAddress;                                                                                                                                                                  
                                                                                                                                                                                            
$v[jsonrpc] = "2.0";                                                                                                                                                                        
$v[method] = "eth_call";                                                                                                                                                                    
$v[params][0] = $t;                                                                                                                                                                         
$v[params][1] = "latest";                                                                                                                                                                   
$v[id] = "global-amount";                                                                                                                                                                          
$jss[] = $v;                        
                                                                                                                                                                                            
reset($wal_mas);                                                                                                                                                                            
foreach($wal_mas as $w)                                                                                                                                                                     
{ 


//------------------------------
unset($t,$v);                                                                                                                                                                               
$b = "0x5ee2418e";
                    
                                                                                                                                                                        
$t2 = $tkn;
$t2 = substr($t2,2);                                                                                                                                                                                
$t2 = view_number($t2,64,"0");                                                                                                                                                              
$b .= $t2;                                                                                                                                                                                  

$t2 = $w;
$t2 = substr($t2,2);                                                                                                                                                                                
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
$v[id] = $w."-allowance";                                                                                                                                                                         
$jss[] = $v;                                                  

//------------------------------
unset($t,$v);                                                                                                                                                                               
$b = "0x70a08231";                                                                                                                                                                                            
                                                                                                                                                                                            
$t2 = $w;
$t2 = substr($w,2);                                                                                                                                                                                
$t2 = view_number($t2,64,"0");                                                                                                                                                              
$b .= $t2;                                                                                                                                                                                  
        
$t[data] = $b;                                                                                                                                                                              
$t[to] = $tkn;                                                                                                                                                                  
//print_r($t);                                                                                                                                                                              
                                                                                                                                                                                            
$v[jsonrpc] = "2.0";                                                                                                                                                                        
$v[method] = "eth_call";                                                                                                                                                                    
//$v[params][0] = $row[wal];                                                                                                                                                                
$v[params][0] = $t;                                                                                                                                                                         
$v[params][1] = "latest";                                                                                                                                                                   
//$v[id] = $row[id];                                                                                                                                                                        
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;                                                                                                                                            
$v[id] = $w."-balance";                                                                                                                                                                         
$jss[] = $v; 

//------------------------------
unset($t,$v);                                                                                                                                                                               
$b = "0xb64395b5";
                                                                                                                                                                        
$t2 = $sale;
$t2 = view_number($t2,64,"0");                                                                                                                                                              
$b .= $t2;                                                                                                                                                                                  

$t2 = $w;
$t2 = substr($t2,2);                                                                                                                                                                                
$t2 = view_number($t2,64,"0");                                                                                                                                                              
$b .= $t2;                                                                                                                                                                                  

// level
$t2 = 1;
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
$v[id] = $w."-alloc";                                                                                                                                                                         
$jss[] = $v;                                                  
 
}                                                

//print_r($jss);
unset($mas);
if(count($jss))                                                                                                                                                                             
{                                                                                                                                                                                           
//print_r($jss);                                                                                                                                                                            
$mas = curl_mas($jss,$rpc,1);                                                                                                                                                               
}                                                                                                                                                                                           
//print_r($mas);
//print_r($mas);die;
foreach($mas as $v2)
{
    $t = $v2[id];
    $t = explode("-",$t);
    if($t[0] == "global")
    {
    $p = "global";    
    }
    else
    {
    $p = "wals";
    $w = $t[0];
    }
    $id = $t[1];
    $v = $v2[result];
    switch($id)
    {
	case "txs":
	    $v = hexdec($v);
	break;
        default:
    $dd = $decimal[$net];
//error_reporting(65535);
        $v = gmp_hexdec($v);
	$v = gmp_div($v,10**$dd);
	$v = gmp_strval($v);
    }
//	$v = hexdec($v);
//        $o[wals][$w][$net][$id] = $v;
//        $o[wals][$w][$id][$net] = $v;
	if($p=="global")
	{
	    switch($id)
	    {
		case "amount":
		    $kk = $prefix."AllocSaleAmount";
		    $o4[$kk] += $v;
		break;
		case "txs":
		    $kk = "AllocTxCount";
		    $kk = $prefix."AllocSaleCount";
		    $o4[$kk] += $v;

		break;
	    }
        $o[$p][$id][$net] = $v;
//        $o[$p][$id2] += $v;

	}
	else
	{
        $o[wals][$w][$net][$id] = $v;
	    if($id == "alloc")
	    {
		$kk = $prefix."alloc_my_all";
		$o4[$kk] += $v;
	    }
	}
    
}
}
print_r($o);
//print "==============\n";
//print_r($o4);
//die;
//die;
$t = $o4[$prefix."AllocSaleAmount"];
    $m = 4000;
    //if($t >=  1000)     $m = 4000;
    if($t >=  55000)    $m = 2000;
    if($t >= 110000)    $m = 1000;
    if($t >= 165000)    $m = 400;
//print "T: $t\n";
    
$kk = $prefix."AllocSaleAmount2";
$o4[$kk] = $t;
$t2 = 220000;
$p = $t/$t2;
$p *= 100;
$p = round($p,0);
		    $kk = $prefix."SalePersent";
		    $o4[$kk] = $p;

		    $kk = $prefix."AllocSaleRefund";
		    $o4[$kk] = "-";

//die;
//-----------------------
    $kk = $prefix."minimal";
    $o4[$kk] = $m;

    $kk = $prefix."sale";
    $o4[$kk] = $sale;

foreach($o[wals] as $w=>$v3)
{
    $o3[$w] = $o4;
foreach($v3 as $net=>$v2)
{
    $kk = $prefix.$net."_contract";
    $o3[$w][$kk] = $c[$net];

    $kk = $prefix.$net."_tkn";
    $o3[$w][$kk] = $tkns[$net];

    $kk = $prefix.$net."_decimal";
    $o3[$w][$kk] = $decimal[$net];

    $kk = $prefix.$net."_decimal2";
    $o3[$w][$kk] = view_number("0",$decimal[$net],"0");

/*
    $kk = $prefix."all";
    $t = $o[glob][all]/10**18;
    $t = round($t,3);
//    $o3[$w][$kk] = rand(0,10);
    $o3[$w][$kk] = $t;

    $kk = $prefix."minimal";
    $t = $o[glob][minimal];
    $tt = 18-$o[glob][decimal];
    if($tt < 0)
    $t2 = 10**$tt;
    else
    $t2 = 1/10**abs($tt);
    $o3[$w][$kk] = $t*$t2;
    $kk = $prefix."step";
    $o3[$w][$kk] = $t2;;

    $kk = $prefix."status";
    $t2 = $o[glob][status];
    if($t2=="1")
    $t = "live";
    else
    $t = "finished";    
    $o3[$w][$kk] = $t;;
//print "=======================$t: $t2\n";die;
*/
    foreach($v2 as $k=>$v)
    {
        $kk = $prefix.$net."_".$k;
//	if(0)
        switch($k)
        {
            case "allowance":
	    if($v>990000)$v = "&#8734;";

	    break;
            case "balance":


    		//$kk2 = $prefix.$net."_".$k;
		$t = $v;
		if($t>200000)
		$t = 200000;
    		$o3[$w][$kk."2"] = $t; 

	    if($v>990000)$v = "99k+";
/*
                $v /= 10**18;
                $t = $v;
                $t *= 1000;
                $t = ceil($t);
                $t /= 1000;
                $v = $t;
*/            
            break;
        }
        $o3[$w][$kk] = $v; 
    }
    $act = "";
//    if($v2[balance] < 20000)
    if($v2[balance] < 100)
    $act = "-";

    if(!$act && $v2[allowance] < $v2[balance]-1)
    $act = "approve";

    if(!$act)
    $act = "alloc";

//print_r($o3[$w]);
//print "============\n";die;
    if($o3[$w][AllocSaleAmount] >= $cap)
    $act = "";    

    $kk = $prefix.$net."_act";
    $o3[$w][$kk] = $act; 

//    if($o3)
//print_r($v2);die;

}
}
//print_r($o);
//print_r($o3);
//die;

foreach($o3 as $w=>$v2)                                                                                                                                                                      
{                                                                                                                                                                                           
    $txt = json_encode($v2,192);                                                                                                                                                            
    $t = pathinfo(__FILE__);                                                                                                                                                                
    $f = $cache_dir."tmp/".$w.".".$t[filename].".json"; 

    $a = @file_get_contents($f);                                                                                                                                                            
//    if(file_exists($f))                                                                                                                                                                   
print $f."\n";                                                                                                                                                                            
//print "md5(a) = ".md5($a)."\n";                                                                                                                                                           
//print $a;                                                                                                                                                                                 
//print "\nmd5(t) = ".md5($txt)."\n";                                                                                                                                                       
//print $txt."\n";                                                                                                                                                                          
                                                                                                                                                                                            
    if(md5($a) != md5($txt))                                                                                                                                                                
    {                                           
print $txt;                                                                                                                                            
    file_put_contents($f,$txt);                                                                                                                                                             
    print "Save $w\n";                                                                                                                                                                      
    }                                                                                                                                                                                       
                                                                                                                                                                                            
}     

    for($i=0;$i<$sleep;$i++)
    {
	print ".";
	sleep(1);
    }

}
while(time() < ($time+55));                 