<?php
$jsonCacheFile  = 'var/cache/php-quickfix.json';
//$gimmieFeed     = 'https://gimmebar.com/api/v0/public/assets/phpquickfix';
$gimmieFeed     = 'https://gimmebar.com/api/v0/public/assets/phpquickfix/phpquickfix';
$wgetCmd        = 'wget -O'.$jsonCacheFile.' '.$gimmieFeed;

// look for the cache file
if(!is_file($jsonCacheFile) || (is_file($jsonCacheFile) && filemtime($jsonCacheFile)<strtotime('-1 minute')) ){
        // fetch the latest content from gimmiebar
        exec($wgetCmd);
}
$json = file_get_contents($jsonCacheFile);
?>
