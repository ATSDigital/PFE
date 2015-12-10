<?php
$txt = file_get_contents('http://feeds.gawker.com/io9/full');

preg_match_all('#&lt;p class="first-text"&gt;(.+)&lt;/p&gt;#isU',$txt , $txt);
//print_r($txt);

$nb=count($txt[0]); 
$myfile = fopen("f1.txt", "w") or die("Unable to open file!");

for($i=0;$i<$nb;$i++) 
{ 
	fwrite($myfile, $txt[1][$i]);
	
//echo$txt[1][$i];
}

$txt= fread(fopen('f1.txt', "r"), filesize('f1.txt'));

$txt = preg_replace('#&lt;a href=(.*)&gt;(.*)&lt;/a&gt;#siU','',$txt);
$txt = preg_replace('#&lt;inset id=(.*)&gt;#siU','',$txt);
$txt = preg_replace('#&lt;inset id=(.*)&gt;#siU','',$txt);
$txt = preg_replace('#&lt;inset id=(.*)&gt;#siU','',$txt);
$txt = preg_replace('#&lt;strong&gt;#siU','',$txt);
$txt = preg_replace('#&lt;/Strong&gt;#siU','',$txt);
$txt = preg_replace('#&lt;br /&gt;#siU','',$txt);
$txt = preg_replace('#&lt;strike&gt;#siU','',$txt);
$txt = preg_replace('#&lt;/strike&gt;#siU','',$txt);
$txt = preg_replace('#&lt;em&gt;#siU','',$txt);
$txt = preg_replace('#&lt;/em&gt;#siU','',$txt);
$txt=strip_tags($txt);

echo $txt;
?>
