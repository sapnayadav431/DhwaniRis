<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Language_Model');
    }

    public function selectedLangLoad() {
        $language = "";
        $lang = xss_clean($this->input->post('lang'));
        $csrftoken = $this->security->get_csrf_hash(); //set csrf token for ajax
        $data['csrftoken'] = $csrftoken; //return new csrf token with ajax request
        /* -------------SET COOKIE FIELD START------------------- */
        set_cookie('language', $lang, time() + 60 * 60 * 24 * 1); //set lang

        if ((get_cookie('language', TRUE) !== NULL) && !empty(get_cookie('language', TRUE))) {
            if ($this->Language_Model->updateLanguage($lang, $_SESSION['ezee_user_id'])) {
                $data['status'] = TRUE;
            } else {
                $data['status'] = FALSE;
            }
        } else {
            $data['status'] = FALSE;
        }

        echo json_encode($data);
    }

}
