<?php
// fonction pour eliminer les balise et garder uniquement le contenu pur.
function ElimineBalise($txt)
{  
$txt = preg_replace('#&lt;a href=(.*)&gt;(.*)&lt;/a&gt;#siU','',$txt);
$txt = preg_replace('#&lt;inset id=(.*)&gt;#siU','',$txt);
$txt = preg_replace('#&lt;iframe src=(.*)&gt;&lt;/iframe&gt;#siU','',$txt);

$txt = preg_replace('#&lt;strong&gt;#siU','',$txt);
$txt = preg_replace('#&lt;/Strong&gt;#siU','',$txt);

$txt = preg_replace('#&lt;br /&gt;#siU','',$txt);
$txt = preg_replace('#&lt;strike&gt;#siU','',$txt);
$txt = preg_replace('#&lt;/strike&gt;#siU','',$txt);
$txt = preg_replace('#&lt;em&gt;#siU','',$txt);
$txt = preg_replace('#&lt;/em&gt;#siU','',$txt);

//$txt = htmlentities($txt, ENT_QUOTES, 'utf-8', false);
//$txt = trim(htmlspecialchars(utf8_encode($txt)));

$txt=strip_tags($txt);

return $txt;
}

?>
