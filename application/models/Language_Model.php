<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Language_Model extends CI_Model {

    public function updateLanguage($lang, $userid) {

        $param['lang'] = $lang;
        $customwhere['id'] = $userid;
        $qry = $this->db->where($customwhere)
                ->update('tbl_user_master', $param);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function fetchUserLanguage($userid) {
        $qry = $this->db->select('lang')
                ->where('id', $userid)
                ->get('tbl_user_master');
        if ($qry->num_rows() > 0) {
            $resultData['status'] = TRUE;
            $resultData['info'] = $qry->row_array();
        } else {
            $resultData['status'] = FALSE;
        }

        return $resultData;
    }

}
