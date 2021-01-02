<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Load Language according demand
 */
/* 
class UrlVerification {

    public $CI;

    public function __construct() {
        // load the instance
        $this->CI = &get_instance();
    }

    public function verifyUrl() {

        $segs = $this->CI->uri->segment_array();
		for ($ui = 3; $ui <= count($segs); $ui++) {
           if ((isset($segs[$ui])) && (mu_dms_crypt($segs[$ui], 'd') == "") && (filter_var($segs[$ui], FILTER_VALIDATE_INT) === false)) {
              redirect('Custom_Error/customerror');
            }
        }
    }
} */
