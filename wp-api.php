<?php


function arrayToXml($array, &$xml){
    foreach ($array as $key => $value) {
        if(is_array($value)){
            if(is_int($key)){
                $key = "e";
            }
            $label = $xml->addChild($key);
            arrayToXml($value, $label);
        }
        else {
            $xml->addChild($key, $value);
        }
    }
}


$q = $_GET["q"];


$array = json_decode(file_get_contents($content), true);


header('Content-Type: application/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	
	xmlns:georss="http://www.georss.org/georss"
	xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#"
	>

<channel>
<title>Blog – Bahri Meriç CANLI Kişisel Web Sitesi</title>
<atom:link href="https://www.estonya.prj.be/wp-api.php" rel="self" type="application/rss+xml"/>
<link>https://www.bahri.info</link>
<description>Yazılım Geliştirici, Linuxcu, Dağcı, Amatör Telsizci</description><lastBuildDate>Sun, 19 Aug 2018 20:59:12 +0000</lastBuildDate>
<language>tr</language>
<sy:updatePeriod>	hourly	</sy:updatePeriod>
<sy:updateFrequency>	1	</sy:updateFrequency>
<generator>https://wordpress.org/?v=5.4.2</generator>
';

if( count($array["items"]) > 0 ) {
foreach($array["items"] as $item) {

echo "<item>";

echo "<title>".  strip_tags(str_replace("&", "-", $item["title"])). "</title>\n";
echo "<link>". $item["link"]. "</link>\n";
echo "<description>". strip_tags(str_replace("&", "-", $item["snippet"])). "</description>\n";

echo "</item>\n";

}
}



echo '
</channel>
</rss>
';

