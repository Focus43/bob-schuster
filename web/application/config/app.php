<?php

return array(
    'providers' => array(
        'core_session'  => '\Application\Src\Session\SessionServiceProvider',
        'core_database' => '\Application\Src\Database\DatabaseServiceProvider'
    ),
    'theme_paths'					=> array(
    		'/page_not_found' => 'lineal'
    )
);