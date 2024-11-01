<?php
ignore_user_abort(true);

if ( !empty($_POST) || defined('DOING_AJAX') || defined('DOING_AUTO_UPDATE') )
        die();

define('DOING_AUTO_UPDATE', true);

if ( !defined('ABSPATH') ) {
        /** Set up WordPress environment */
        require_once(dirname(__FILE__).'/../../../../wp-load.php');

}

AutoPaging::getInstance()->updateAll();