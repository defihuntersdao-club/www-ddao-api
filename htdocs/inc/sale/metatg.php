#!/usr/bin/php
<?php

$a[num][AllocSaleAmount] = 220000;
$a[num][AllocSaleAmount2] = 220000;
$a[num][SalePersent] = 100;
$a[num][AllocSaleCount] = 5;

$nn = 0;
foreach($a[num] as $k=>$v)
{
$a2[num][$nn][name] = $k;
$a2[num][$nn][value] = $v;
$a2[num][$nn][num] = $nn;
$nn++;
}

$a2[time] = time();
$a2[count] = count($a[num]);

$f = "sale.metatg.all.json";

$txt = json_encode($a2,192);
file_put_contents($f,$txt);

