<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  |	https://codeigniter.com/user_guide/general/hooks.html
  |
 */
$hook['post_controller_constructor'][0] = array(
    'class' => 'LoadLanguage',
    'function' => 'setLanguage',
    'filename' => 'LoadLanguage.php',
    'filepath' => 'hooks',
    'params' => array()
);
/* -----------------------SESSION VERIFICATION----------------------- */
$hook['post_controller_constructor'][1] = array(
    'class' => 'SessionValidator',
    'function' => 'logged_in',
    'filename' => 'SessionValidator.php',
    'filepath' => 'hooks',
    'params' => array()
);

/* -----------------------URL VERIFICATION----------------------- */
$hook['post_controller_constructor'][2] = array(
    'class' => 'UrlVerification',
    'function' => 'verifyUrl',
    'filename' => 'UrlVerification.php',
    'filepath' => 'hooks',
    'params' => array()
);

 