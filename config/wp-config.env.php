<?php
/**
 * @var $hostname
 */


// Set environment based on hostname
switch ($hostname) {
    case 'wp-voodookit.local':
        define('WP_ENV', 'dev');
        break;

    default: 
        define('WP_ENV', 'prod');
}

