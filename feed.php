<?php
switch($_SERVER['HTTP_HOST']){
    case 'phpquickfix.me':
        $siteType = 'php';
        break;
    case 'jsquickfix.me':
        $siteType = 'js';
        break;
    case 'websecquickfix.me':
        $siteType = 'websec';   
        break;
    case 'apiquickfix.me':
        $siteType = 'api';
        break;
    default:
        $siteType = 'php';
}

$jsonCacheFile  = 'var/cache/'.$siteType.'-quickfix.json';
//$gimmieFeed   = 'https://gimmebar.com/api/v0/public/assets/phpquickfix';
$gimmieFeed     = 'https://gimmebar.com/api/v0/public/assets/phpquickfix/'.$siteType.'quickfix';
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
    $title = htmlentities($item->title);

    $title = str_replace(
        array('&acirc;'),
        array('-'),
        $title
    );

    $itemList .= sprintf('<item>
            <title>%s</title>
            <link>%s</link>
            <description>%s</description>
            <pubDate>%s</pubDate>
        </item>'."\n",
    $title,
    htmlspecialchars($item->source),
    //$item->title.' : '.$item->description,
    $item->description,
    date('r',$item->date));
}


header('Content-type: text/xml; ; charset=UTF-8');
echo sprintf(
    '<rss version="2.0">
     <channel>
        <title>%s - get your fix now!</title>
        <description>Quick hits of PHP news coming your way</description>
        <language>en-us</language>
        <pubDate>%s</pubDate>
        %s
    </channel>
    </rss>
',$siteType.'quickfix', date('r'), $itemList);

?>
