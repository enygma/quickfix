<?php
header('Content-type: text/html; charset=UTF-8');
include_once 'inc.php';
?>
<html>
        <head>
                <link rel="alternate" type="application/rss+xml" href="/feed" title="<?php echo $siteType; ?>quickfix" />
                <link rel="stylesheet" type="text/css" href="/css/<?php echo $siteType; ?>.css">
        </head>
        <body>
                <table cellpadding="5" cellspacing="0" border="0" id="content">
                <tr>
                        <td id="header">
                                <a href="/"><img src="/img/<?php echo $siteType;?>-onfire.jpg" border="0"></a><br/>
                                <span class="header-title"><?php echo $siteType;?>quickfix.me</span>
                        </td>
                </tr>
                <tr><td id="nav">
                        <a href="/feed">rss feed</a>
                        | follow <a href="http://twitter.com/<?php echo $siteType; ?>quickfix">@<?php echo $siteType;?>quickfix</a> on twitter
                        | <a href="http://gimmebar.com/loves/phpquickfix">gimmebar</a>
                </td></tr>
                <tr>
                        <td id="detail">
                        <?php
                        $json = json_decode(file_get_contents('var/cache/'.$siteType.'-quickfix.json'));
                         foreach($json->records as $item){ ?>
                                <div class="item">
                                        <a href="<?php echo $item->source; ?>" class="item-title"><?php echo $item->title; ?></a><br/>
                                        <span class="item-tagged">&nbsp;&nbsp;<b>tagged:</b> <?php foreach($item->tags as $tag){ echo $tag.' '; } ?></span>
<br/>
                                        <span class="item-tagged">&nbsp;&nbsp;<b>@</b><?php echo date('m.d.Y H:i:s',$item->date); ?>
                                </div>
                        <?php }
                        ?>
                        <br/><br/>
                        <div class="byline">
                               <?php echo $siteType; ?>quickfix is a production of <a href="http://phpdeveloper.org">phpdeveloper.org</a><br/>
                                <a href="mailto:info@phpdeveloper.org">info@phpdeveloper.org</a>
                        </div>
                        </td>
                </tr>
                </table>
                <script type="text/javascript">

                var _gaq = _gaq || [];
                 _gaq.push(['_setAccount', 'UA-246789-8']);
                 _gaq.push(['_trackPageview']);

                (function() {
                        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                })();

                </script>
        </body>
</html>
