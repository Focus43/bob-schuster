<?php

use Concrete\Core\Application\Application;

/**
 * ----------------------------------------------------------------------------
 * Instantiate concrete5
 * ----------------------------------------------------------------------------
 */
$app = new Application();


/**
 * ----------------------------------------------------------------------------
 * Detect the environment based on the hostname of the server
 * ----------------------------------------------------------------------------
 */
$app->detectEnvironment(
    array(
        'local' => array(
            'vagrant-ubuntu-vivid-64'
        ),
        'production' => array(
            'bobschuster.pc7j-2hvd.accessdomain.com'
        )
    ));

/**
 * Override Concrete5's config persistence method.
 */
\Application\Src\Config\Ephemeral::bindToApp($app);

return $app;