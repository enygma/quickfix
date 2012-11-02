<?php
echo '<!-- '; print_r($_SERVER); echo '-->';

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
	case 'dearrecruiters.org':
		$siteType = 'js';
		break;
	case 'chipd.in':
		$siteType = 'websec';
		break;
	default:
		$siteType = 'php';
}

echo '<!-- '.$_SERVER['HTTP_HOST'].' -> '.$siteType.' -->';

$jsonCacheFile  = 'var/cache/'.$siteType.'-quickfix.json';
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
