#!/usr/bin/php                                                                                                                                                                              
<?php
include "conf.php";

$sleep = 5;

$net = $argv[1];
if(!$net)
{
    print "Usage: ".$argv[0]." <net>\n\n";
    print "\tExample:\n\t";
    print " ".$argv[0]." matic\n\t";
    print " ".$argv[0]." bsc\n\n5";
    die;
}

$sale = 1;

print date("Y-m-d H:i:s\n");                                                                                                                                                                
$time = time();


/*
unset($rpc_mas,$c,$tkn);
$f = "/opt/rpc_need.txt";
$a = file_get_contents($f);
$rpc_mas[matic] = $a;
$rpc_mas[bsc] = "https://bsc-dataseed1.binance.org";

//print_r($rpc_mas);


$c[matic] = "0xdFEa9464365bbE652657795B62D6326436BbA67e";
$c[bsc]   = "0xcEF60B37C31167bd2d714D8729624530126ca5c0";

$tkns[matic] = "0x19Ca9521Ec3F01a03476323dd54740C1239eF5e5";
$tkns[bsc] = "0xd4987eBA16672165B14f50C84fC4AEb8Dd986772";
*/
include "018_conf.php";                                                                                                                                                                     

$contractAddress = $c[$net];
$rpc = $rpc_mas[$net];
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
$v[id] = "txs";                                                                                                                                                                         
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
$v[id] = "amount";                                                                                                                                                                         
$jss[] = $v;                                                  

print_r($jss);

if(count($jss))                                                                                                                                                                             
{                                                                                                                                                                                           
//print_r($jss);                                                                                                                                                                            
$mas = curl_mas($jss,$rpc,1);                                                                                                                                                               
}                                                                                                                                                                                           
print_r($mas);
