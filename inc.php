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
	default:
		$siteType = 'php';
}

$jsonCacheFile  = 'var/cache/'.$siteType.'-quickfix.json';
//$gimmieFeed     = 'https://gimmebar.com/api/v0/public/assets/phpquickfix';
$gimmieFeed     = 'https://gimmebar.com/api/v0/public/assets/phpquickfix/'.$siteType.'quickfix';
$wgetCmd        = 'wget -O'.$jsonCacheFile.' '.$gimmieFeed;

if (isset($_GET['flush'])) {
    exec('rm -rf '.$jsonCacheFile);
}

// look for the cache file
if(!is_file($jsonCacheFile) || (is_file($jsonCacheFile) && filemtime($jsonCacheFile)<strtotime('-1 minute')) ){
        // fetch the latest content from gimmiebar
        exec($wgetCmd);
}
$json = file_get_contents($jsonCacheFile);
?>
