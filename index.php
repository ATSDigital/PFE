<!DOCTYPE html>
<html>
    <head>
        <title>Notre première instruction : echo</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h2>Affichage de texte avec PHP</h2>

<?php

$xml = file_get_contents('test.txt');
// Use cURL to get the RSS feed into a PHP string variable.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
        'http://www.dpreview.com/feeds/news.xml');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$xml = curl_exec($ch);
curl_close($ch);
/////////////////////////////////


// Include the handy XML data extraction functions.
include 'xml_regex.php';
// An RSS 2.0 feed must have a channel title, and it will
// come before the news items. So it's safe to grab the
// first title element and assume that it's the channel
// title.
$channel_title = value_in('title', $xml);
// An RSS 2.0 feed must also have a link element that
// points to the site that the feed came from.
$channel_link = value_in('link', $xml);

// Create an array of item elements from the XML feed.
$news_items = element_set('item', $xml);

foreach($news_items as $item) {
    
    $description = value_in('description', $item);
    
    $item_array[] = array(
            
            'description' => $description,
            
    );
}


if (sizeof($item_array) > 0) {
    // First create a div element as a container for the whole
    // thing. This makes CSS styling easier.
    $html = '<div class="rss_feed_headlines">';
    // Markup the title of the channel as a hyperlink.
  
    // Now iterate through the data array, building HTML for
    // each news item.
    $count = 0;
    foreach ($item_array as $item) {
       
        $html .= '<dd>'.make_safe($item['description']);
     
        echo '</dd>';
        // Limit the output to five news items.
        if (++$count == 5) {
            break;
        }
    }

   $html .= '</dl></div>';
     
  $html = preg_replace('#<!\[CDATA\[.*?\]\]>#s', '', $html);
  $html = preg_replace('#<img(.*)/>#i', '',$html);
    echo $html;
}

function make_safe($string) {

   $string = preg_replace('#<!\[CDATA\[.*?\]\]>#s', '', $string);
  
   $string = preg_replace('`(<a[^>]*>)(.*)(</a>)`Ui', '',$string);
	
   $string = preg_replace('#<img(.*)/>#i', '',$string);
   
   $string = strip_tags($string);
    //$string = trim(htmlspecialchars(utf8_encode($string)));
    // The next line requires PHP 5.2.3, unfortunately.
    $string = htmlentities($string, ENT_QUOTES, 'UTF-8', false);
    // Instead, use this set of replacements in older versions of PHP.
    $string = str_replace('<', '&lt;', $string);
    $string = str_replace('>', '&gt;', $string);
    $string = str_replace('(', '&#40;', $string);
    $string = str_replace(')', '&#41;', $string);
    $string = str_replace('"', '&quot;', $string);
    $string = str_replace('\'', '&#039;', $string);

    return $string;
}

?>

 </p>
    </body>
</html>
