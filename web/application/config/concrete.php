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

return array(
    'seo' => array(
        'url_rewriting' => true,
        'url_rewriting_all' => true
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
