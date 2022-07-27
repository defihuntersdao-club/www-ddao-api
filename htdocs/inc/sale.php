<?php
//include "../../conf.php";

$d = __DIR__;
//$d = dirname($d);

$d = $d."/sale/";

unset($mas);
//print "sale";
//$case = $_GET[i];
$case = $item2;

switch($case)
{
    case "gearz":
    case "metatg":
    case "ddao_learn":
    case "defiyeld":
    case "gbc":
    case "sabai":
    case "eywa";
	$f = "sale.$case.all.json";
	$tf = $d.$f;
	if(file_exists($tf))
	{
	$a = file_get_contents($tf);
	$mas = json_decode($a,1);
	}
	//print $a;
	$i = $mas[count]*1;
	unset($t);
	$t[name] = "alloc_name";
	$t[num] = $i;
	$t[value] = $sale[$case][name];
	$mas[num][] = $t;
	$i++;

	unset($t);
	$t[name] = "cap_txt";
	$t[num] = $i;
	$t[value] = $sale[$case][cap_txt];
	$mas[num][] = $t;
	$i++;

	unset($t);
	$t[name] = "funds_txt";
	$t[num] = $i;
	$t[value] = $sale[$case][funds_txt];
	$mas[num][] = $t;
	$i++;

	unset($t);
	$t[name] = "alloc_url";
	$t[num] = $i;
	$t[value] = $sale[$case][url];
	$mas[num][] = $t;
	$i++;

	unset($t);
	$t[name] = "nets_logo";
	$t[num] = $i;
	foreach($sale[$case][net] as $t2)
	$t[value] .= " <img src=\"$t2\">";;
	$mas[num][] = $t;
	$i++;

	if($case == "defiyeld")
	{

	unset($t);
	$t[name] = "SalePersent";
	$t[num] = $i;
	$t[value] = 100;
	$mas[num][] = $t;
	$i++;

	unset($t);
	$t[name] = "AllocSaleCount";
	$t[num] = $i;
	$t[value] = 15;
	$mas[num][] = $t;
	$i++;

	unset($t);
	$t[name] = "AllocSaleAmount";
	$t[num] = $i;
	$t[value] = "220k $";
	$mas[num][] = $t;
	$i++;


	unset($t);
	$t[name] = "AllocSaleAmount2";
	$t[num] = $i;
	$t[value] = "220 000";
	$mas[num][] = $t;
	$i++;


	}

	$v = "/images/logo_$case.";
	switch($case)
	{
//	    case "metatg":
	    case "defiyeld":
//	    case "eywa":
	    $v .= "svg";
	    break;
	    case "metatgold":
	    $v .= "gif";
	    break;
	    default:
	    $v .= "png";
	}
	unset($t);
	$t[name] = "alloc_logo";
	$t[num] = $i;
	$t[value] = $v;
	$mas[num][] = $t;
	$i++;

    	$mas[count] = $i;
	//$a = json_encode($mas,192);
	//print $a;
	$o[result] = $mas;
    break;
    default:
	$f = "sale.gbc.all.json";
	$tf = $d.$f;
	$a = file_get_contents($tf);
	$mas = json_decode($a,1);
	$oo = $mas;
	foreach($mas[num] as $k=>$v)
	{
	    $oo[num][$k] = "-";
	}
	//$a = json_encode($o,192);
	//print $a;    
	$o[result] = $oo;;
}
//
//print "END";
?>