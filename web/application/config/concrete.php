<?php

$ephemeralStashCacheDriver = array(
    'class' => '\Stash\Driver\Ephemeral',
    'options' => array()
);

$redisStashCacheDriver = array(
    'class' => '\Stash\Driver\Redis',
    'options' => array(
        'servers' => array(
            array(
                'server' => $_SERVER['CACHE1_HOST'],
                'port'   => $_SERVER['CACHE1_PORT']
            )
        )
    )
);

$trackingCode = <<<EOT
<script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-24748273-2']);
	_gaq.push(['_gat._forceSSL']);
	_gaq.push(['_trackPageview']);

	(function () {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})();

</script>
EOT;

return array(
    'seo' => array(
        'url_rewriting' => true,
        'url_rewriting_all' => true,
        'tracking' => array(
            'code' => $trackingCode
        )
    ),
    'permissions' => array(
        'model' => 'advanced'
    ),
    'marketplace' => array(
        'enabled' => false
    ),
    'external' => array(
        'intelligent_search_help' => false,
        'news_overlay' => false,
        'news' => false
    ),
    'misc'  => array(
        'seen_introduction' => true
    ),
    'email' => array(
        'default' => array(
            'address' => 'hi@focus-43.com',
            'name' => 'Focus43.com Site'
        )
    ),
    'mail' => array(
        'method' => 'SMTP',
        'methods' => array(
            'smtp' => array(
                'server'        => 'smtp.postmarkapp.com',
                'port'          => '25',
                'username'      => 'd9c87de5-5d44-4e29-80d2-d43e79bca0a2',
                'password'      => 'd9c87de5-5d44-4e29-80d2-d43e79bca0a2',
                'encryption'    => ''
            )
        )
    ),
    'cache' => array(
        'pages' => true,
        'levels' => array(
            'expensive' => array(
                'drivers' => array(
                    $ephemeralStashCacheDriver,
                    (defined('EPHEMERAL_ONLY_DURING_INSTALL') ? $ephemeralStashCacheDriver : $redisStashCacheDriver)
                )
            ),
            'object' => array(
                'drivers' => array(
                    $ephemeralStashCacheDriver
                )
            )
        )
    )
);
