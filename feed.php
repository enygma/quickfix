<?php

$jsonCacheFile  = 'var/cache/php-quickfix.json';
//$gimmieFeed   = 'https://gimmebar.com/api/v0/public/assets/phpquickfix';
$gimmieFeed     = 'https://gimmebar.com/api/v0/public/assets/phpquickfix/phpquickfix';
$wgetCmd    = 'wget -O'.$jsonCacheFile.' '.$gimmieFeed;

// look for the cache file
if(!is_file($jsonCacheFile) || (is_file($jsonCacheFile) && filemtime($jsonCacheFile)<strtotime('-1 minute')) ){
    // fetch the latest content from gimmiebar
    exec($wgetCmd);
}
$json = file_get_contents($jsonCacheFile);

// build it out into a RSS feed

$itemList = '';

$data = json_decode($json);

foreach($data->records as $item){
    $itemList .= sprintf('<item>
            <title>%s</title>
            <link>%s</link>
            <description>%s</description>
            <pubDate>%s</pubDate>
        </item>'."\n",
    htmlentities($item->title),
    htmlspecialchars($item->source),
    //$item->title.' : '.$item->description,
    $item->description,
    date('r',$item->date));
}


header('Content-type: text/xml; ; charset=UTF-8');
echo sprintf(
    '<rss version="2.0">
     <channel>
        <title>phpquickfix - get your fix now!</title>
        <description>Quick hits of PHP news coming your way</description>
        <language>en-us</language>
        <pubDate>%s</pubDate>
        %s
    </channel>
    </rss>
',date('r'),$itemList);



?>
