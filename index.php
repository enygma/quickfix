<?php
print_r($_SERVER);
?>
<?php
header('Content-type: text/html; charset=UTF-8');
include_once 'inc.php';
?>
<html>
        <head>
                <link rel="alternate" type="application/rss+xml" href="/feed" title="phpquickfix" />
                <style>
                        body {
                                background-color: #EEEEEE;
                                margin: 0px;
                                padding: 0px;
                        }
                        #content {
                                width: 550px;
                                margin-left: auto;
                                margin-right: auto;
                        }
                        #content td {
                                font-family: verdana, arial, helvetica;
                        }
                        #header {
                                text-align: center;
                                background-color: #eb5822;
                        }
                        .header-title {
                                color: #FFFFFF;
                                font-size: 15px;
                        }
                        #detail {
                                background-color: #FFFFFF;
                                padding: 30px;
                        }
                        .item {
                                margin-bottom: 18px;
                        }
                        .item-title {
                                font-size: 16px;
                                color: #000000;
                                .item-tagged {
                                color: #8D8D8D;
                                font-size: 11px;
                        }
                        .byline {
                                color: #8D8D8D;
                                text-align: center;
                                font-size: 11px;
                        }
                        #nav {
                                text-align: center;
                                font-size: 11px;
                                padding-bottom: 7px;
                        }
                        #nav a {
                                color: #000000;
                                font-size: 11px;
                        }
                </style>
        </head>
        <body>
                <table cellpadding="5" cellspacing="0" border="0" id="content">
                <tr>
                        <td id="header">
                                <a href="/"><img src="/img/onfire.jpg" border="0"></a><br/>
                                <span class="header-title">phpquickfix.me</span>
                        </td>
                </tr>
                <tr><td id="nav">
                        <a href="/feed">rss feed</a>
                        | follow <a href="http://twitter.com/phpquickfix">@phpquickfix</a> on twitter
                        | <a href="http://gimmebar.com/loves/phpquickfix">gimmebar</a>
                </td></tr>
                <tr>
                        <td id="detail">
                        <?php
                        $json = json_decode(file_get_contents('./quickfix.json'));
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
                                phpquickfix is a production of <a href="http://phpdeveloper.org">phpdeveloper.org</a><br/>
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