<?php
$sale = 4;

unset($rpc_mas,$c,$tkn);                                                                                                                                                                    
$f = "/opt/rpc_need.txt";                                                                                                                                                                   
$a = file_get_contents($f);                                                                                                                                                                 
$rpc_mas[matic] = $a;                                                                                                                                                                       
$rpc_mas[bsc] = "https://bsc-dataseed1.binance.org";                                                                                                                                        
                                                                                                                                                                                            
//print_r($rpc_mas);                                                                                                                                                                        
                                                                                                                                                                                            
                                                                                                                                                                                            
//$c[matic] = "0xdFEa9464365bbE652657795B62D6326436BbA67e";                                                                                                                                 
//$c[bsc]   = "0xcEF60B37C31167bd2d714D8729624530126ca5c0";                                                                                                                                 
                                                                                                                                                                                            
$c[matic] = "0xD1181ABD73F7561596cc589e26f198C41834F0b4";                                                                                                                                   
$c[bsc] = "0x08Ff8B625AbfB21452b3fb284a85735cAB6fb9f3";                                                                                                                                     
                                                                                                                                                                                            
$tkns[matic] = "0x19Ca9521Ec3F01a03476323dd54740C1239eF5e5";                                                                                                                                
$tkns[bsc] = "0xd4987eBA16672165B14f50C84fC4AEb8Dd986772";                                                                                                                                  
$tkns[matic] = "0xc2132D05D31c914a87C6611C10748AEb04B58e8F";
$tkns[bsc] = "0x55d398326f99059ff775485246999027b3197955";

$decimal[bsc] = 18;
$decimal[matic] = 6;
//$rpc = $rpc_mas[$net];                                                                                                                                                                      
//$contractAddress = $c[$net];                                                                                                                                                                
//$tkn = $tkns[$net];                                               
?>