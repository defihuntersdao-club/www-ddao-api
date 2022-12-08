<?php
function div10($n,$d=18,$l=36)
{

//print "\nN: $n\n";
    $preg = "/^(0{0,$d})/si";
    $t = view_number($n,$l,"0");
//print "T: $t\n";
    $t = strrev($t);
    $t2 = substr($t,0,$d);
    $t2 = preg_replace($preg,"",$t2);
    $t2 = strrev($t2);
//print "T2: $t2\n";
    $t3 = substr($t,$d);
    $t3 = strrev($t3);
    $t3 *= 1;
    $t3 = preg_replace($preg,"",$t3);
//print "T3: $t3\n";
    if(!$t3)$t3 = "0";
    $out = $t3;
    if($t2)
    $out .= ".".$t2;

    return $out;
}
?>