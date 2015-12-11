<?php 
// fonction pour extraire les mots d'un texte.
function extraireMotsDUnePhrase($phrase)
{    
    // caractères que l'on va remplacer (tout ce qui sépare les mots) 
    $aremplacer = array(",",".",";",":","!","?","(",")","[","]","{","}",'"',"'"," ","-", "’");
     
    $enremplacement = " "; 
    
    /* on fait le remplacement , 
    puis on supprime les espaces de début et de fin de chaîne (trim) */
    $sansponctuation = trim(str_replace($aremplacer, $enremplacement, $phrase)); 
    
    /* on coupe la chaîne en fonction d'un séparateur, 
    et chaque élément est une valeur d'un tableau */
    $separateur = "/[ ]+/"; // 1 ou plusieurs espaces
    $mots =  preg_split($separateur, $sansponctuation,-1, PREG_SPLIT_NO_EMPTY); 
    
    return $mots;
}
?>
