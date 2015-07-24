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
    case 'laravelquickfix.me':
        $siteType = 'laravel';
        break;
    default:
        $siteType = 'js';
}

$jsonCacheFile  = 'var/cache/'.$siteType.'-quickfix.json';
//$gimmieFeed   = 'https://gimmebar.com/api/v0/public/assets/phpquickfix';
// $gimmieFeed     = 'https://gimmebar.com/api/v0/public/assets/phpquickfix/'.$siteType.'quickfix';
// $wgetCmd    = 'wget -O'.$jsonCacheFile.' '.$gimmieFeed;

$delFeed = 'http://feeds.delicious.com/v2/json/phpquickfix/'.$siteType.'quickfix';
$wgetCmd    = 'wget -O'.$jsonCacheFile.' '.$delFeed;

// look for the cache file
if(!is_file($jsonCacheFile) || (is_file($jsonCacheFile) && filemtime($jsonCacheFile)<strtotime('-1 minute')) ){
    // fetch the latest content from gimmiebar
    exec($wgetCmd);
}
$json = file_get_contents($jsonCacheFile);

// build it out into a RSS feed

$itemList = '';

$data = json_decode($json);

// foreach($data->records as $item){
foreach($data as $item){
    // $title = htmlentities($item->title);
    $title = htmlentities($item->d);

    $title = str_replace(
        array('&acirc;', chr(226), chr(128), chr(147), '&raquo;', '&ndash;', '&nbsp;'),
        array('-', ' ', ' ', ' ','>','-', ' '),
        $title
    );

    $description = '#'.implode(', #', (array)$item->t);
    $date = new \DateTime($item->dt);

    $itemList .= sprintf('<item>
            <title><![CDATA[%s]]></title>
            <link>%s</link>
            <description><![CDATA[%s]]></description>
            <pubDate>%s</pubDate>
        </item>'."\n",
    $title,
    // htmlspecialchars($item->source),
    htmlspecialchars($item->u),
    //$item->title.' : '.$item->description,
    $description,
    $date->format('r'));
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
