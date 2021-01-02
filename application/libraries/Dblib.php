<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dblib {
    /* -------------------DB Date Setter-------------------- */

    public function dbDateSetter($timetype = '', $currentDate = '') {
        if (LOAD_DB_NAME == "OCI") {
            if ($timetype == 'date') {
                $datestring = '%d-%M-%y';
            } else {
                $datestring = '%d-%M-%y %h.%i.%s.%u %A';
            }

            $time = strtotime($currentDate);
            $formatedDate = strtoupper(mdate($datestring, $time));
        } else {
            if ($timetype == 'date') {
                $datestring = 'Y-m-d';
            } else {
                $datestring = 'Y-m-d H:i:s';
            }

            $time = strtotime($currentDate);
            $formatedDate = date($datestring, $time);
        }
        return $formatedDate;
    }

    /* -------------------DB Date Getter-------------------- */

    public function dbDateGetter($timetype = '', $currentDate = '') {
        if (LOAD_DB_NAME == "OCI") {
            if ($timetype == 'date') {
                $datestring = 'd-m-Y';
            } else {
                $datestring = 'd-m-Y H:i:s';
                $dt = DateTime::createFromFormat("d#M#y H#i#s*A", $currentDate);
                $currentDate = $dt->format('d-m-Y H.i.s');
            }

            $time = strtotime($currentDate);
            $formatedDate = date($datestring, $time);
        } else {

            if ($timetype == 'date') {
                $datestring = 'd-m-Y';
            } else {
                $datestring = 'd-m-Y H:i:s';
            }
            $time = strtotime($currentDate);
            $formatedDate = date($datestring, $time);
        }
        return $formatedDate;
    }

}
