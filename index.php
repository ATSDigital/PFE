<?php

$x=$_POST['prenom'];
$txt = file_get_contents($x);

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

//___________________________________________________________________

$mots = extraireMotsDUnePhrase($txt);
   $taille=count($mots);
   
    
    for($i=0;$i < $taille;$i++) 
{ 
if(strlen($mots[$i])<5){
	unset($mots[$i]);

}


} 
$mots=array_values($mots);

$taille2=count($mots);
 for($j=0;$j < $taille2;$j++) 
{ 

//echo $mots[$j]."|".strlen($mots[$j])."|";
//echo $taille;
}
$tab=array_count_values($mots);
$i=0;
foreach($tab as $cle=>$valeur)
{
	$t1[$i]=$cle;
	$t2[$i]=$valeur;
	$i++;
    // echo $cle.' => '.$valeur.'<br/>';
}

//$max = max($t2);
for($n=0;$n<10;$n++){
	$maxs = array_keys($t2, max($t2));
	$tt1[$n]=$t1[$maxs[0]];
	$tt2[$n]=$t2[$maxs[0]];
	unset($t1[$maxs[0]]);
	unset($t2[$maxs[0]]);
$t1=array_values($t1);
$t2=array_values($t2);
	//unset($t1[$maxs[$n]]);
}

//$taie=count($t2);
for($n=0;$n<10;$n++){
echo $tt1[$n]."--".$tt2[$n]."//";}

//echo $maxs[0];
//echo $t1[88];
//echo $t1[0].$t2[0].$t1[1].$t2[1];

function extraireMotsDUnePhrase($phrase)
{    
    /* caractères que l'on va remplacer (tout ce qui sépare les mots, en fait) */
    $aremplacer = array(",",".",";",":","!","?","(",")","[","]","{","}",'"',"'"," ","-", "’");
     
    $enremplacement = " "; 
    
    /* on fait le remplacement (comme dit ci-avant), puis on supprime les espaces de début et de fin de chaîne (trim) */
    $sansponctuation = trim(str_replace($aremplacer, $enremplacement, $phrase)); 
    
    /* on coupe la chaîne en fonction d'un séparateur, et chaque élément est une valeur d'un tableau */
    $separateur = "/[ ]+/"; // 1 ou plusieurs espaces
    $mots =  preg_split($separateur, $sansponctuation,-1, PREG_SPLIT_NO_EMPTY); 
    
    return $mots;
}




?>



<!DOCTYPE html>

<html lang="en">
   
        <meta charset="utf-8" />
        <title>Chart.js demo</title>

       
        <!-- import plugin script -->
        <script src='Chart.js'></script>
        <script src="jquery-2.1.4.min.js"></script>
    </head>
    <body>
       
        <!-- bar chart canvas element -->
        <canvas id="income" width="800" height="600"></canvas>
        <script>


var a1="<?php echo $tt1[0] ?>";var a6="<?php echo $tt1[5] ?>";
var a2="<?php echo $tt1[1] ?>";var a7="<?php echo $tt1[6] ?>";
var a3="<?php echo $tt1[2] ?>";var a8="<?php echo $tt1[7] ?>";
var a4="<?php echo $tt1[3] ?>";var a9="<?php echo $tt1[8] ?>";
var a5="<?php echo $tt1[4] ?>";var a10="<?php echo $tt1[9] ?>";


var b1="<?php echo $tt2[0] ?>";var b6="<?php echo $tt2[5] ?>";
var b2="<?php echo $tt2[1] ?>";var b7="<?php echo $tt2[6] ?>";
var b3="<?php echo $tt2[2] ?>";var b8="<?php echo $tt2[7] ?>";
var b4="<?php echo $tt2[3] ?>";var b9="<?php echo $tt2[8] ?>";
var b5="<?php echo $tt2[4] ?>";var b10="<?php echo $tt2[9] ?>";
            
            // bar chart data
            var barData = {
                labels : [a1,a2,a3,a4,a5,a6,a7,a8,a9,a10],
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : [b1,b2,b3,b4,b5,b6,b7,b8,b9,b10]
                    }
                    
                ]
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
            new Chart(income).Bar(barData);
        </script>
    </body>
</html>
