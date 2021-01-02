<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * helps u manage storage
 */

class Storage_Manager {

    public $list, $numFile, $totalFSize, $totalFolder, $noofpages, $allChieldArray;

    public function __construct() {
        /*
         * variable inisialization start
         */
        $this->list = array();
        $this->numFile = 0;
        $this->totalFSize = 0;
        $this->totalFolder = 0;
        $this->noofpages = 0;
        $this->allChieldArray = array();

        /*
         * variable inisialization end
         */
        $this->CI = & get_instance();
        $this->CI->load->model('Storage_Model');
        $this->CI->load->model('Document_Model');
    }

    /*
     * Find Root Storage Name
     */

    public function findRootStorage() {
        $rootstorage=$this->CI->Storage_Model->fetchRootStorage();
        $rootname=$rootstorage['sl_name'];
        return $rootname;
    }

    /* -----------------FETCH STORAGE LEVEL------------------------- */

    public function findMultipleChild($sl_id, $level, $slperm, $userassign) {
        global $data;
        global $k;
        $k++;
        $data[$k]['slid'] = $sl_id;
        $loop = array();
        $data[$k]['slname'] = $this->parentLevel($sl_id, $slperm, $level, '', $loop);
//print_r($data);
        if (!in_array($sl_id, $userassign)) {
            $sql_child = $this->CI->Storage_Model->fetchStorageAssignChild($sl_id);
            if (count($sql_child) > 0) {
                foreach ($sql_child as $key => $value) {
                    $child = $value['sl_id'];

                    $this->findMultipleChild($child, $level, $slperm, $userassign);
                }
            }
        }
        return $data;
    }

    public function parentLevel($slid, $slperm, $level, $value, $loop) {
        global $i;
        global $loop;
        $loop = array();
        $i++;
        if ($slperm == $slid) {
            $rwParent = $this->CI->Storage_Model->fetchStorageAssign($slid);
            if ($level < $rwParent['sl_depth_level']) {
                $this->parentLevel($rwParent['sl_parent_id'], $slperm, $level, $rwParent['sl_name'], $loop);
            }
            $loop[] = $rwParent['sl_name'];
        } else {
            $parent = $this->CI->Storage_Model->fetchStorageAssignChildParent($slid, $slperm);
            if (count($parent) > 0) {

                $rwParent = $parent;
                if ($level < $rwParent['sl_depth_level']) {

                    $this->parentLevel($rwParent['sl_parent_id'], $slperm, $level, $rwParent['sl_name'], $loop);
                    $loop[] = $rwParent['sl_name'];
                }
            } else {
                $rwParent = $this->CI->Storage_Model->fetchStorageAssign($slid);
                $getparnt = $rwParent['sl_parent_id'];
                if ($level <= $rwParent['sl_depth_level']) {

                    $this->parentLevel($getparnt, $slperm, $level, $rwParent['sl_name'], $loop);
                    $loop[] = $rwParent['sl_name'];
                }
            }
        }

        return $loop;

//echo $value;
//    echo $value;
    }

    /* -----------------FETCH STORAGE LEVEL------------------------- */

    public function findChild($sl_id, $level, $slperm) {
        global $data;
        global $k;
        $k++;

        $data[$k]['slid'] = $sl_id;
        $loop = array();
        $data[$k]['slname'] = $this->parentLevel($sl_id, $slperm, $level, '', $loop);
//print_r($data);
        $sql_child = $this->CI->Storage_Model->fetchStorageAssignChild($sl_id);

        if (count($sql_child) > 0) {
            foreach ($sql_child as $key => $value) {
                $child = $value['sl_id'];

                $this->findChild($child, $level, $slperm);
            }
        }
        return $data;
    }

    /* ----------------------fetch bread crums dynamic------------- */

    public function parentSelectedLevel($slid, $slperm, $level, $value, $loop, $sublevel = 0) {
        global $loop;
        $loop = array();
        if (in_array($slid, $slperm)) {
            $rwParent = $this->CI->Storage_Model->fetchStorageAssign($slid);
            if ($level[$slid] < $rwParent['sl_depth_level']) {
                $this->parentSelectedLevel($rwParent['sl_parent_id'], $slperm, $level, $rwParent['sl_name'], $loop, $rwParent['sl_depth_level']);
            }

            $loop[] = '<li class="active"><a href="' . base_url('app/dms-storage-structure/') . mu_dms_crypt($rwParent['sl_id'], 'e') . '">' . $rwParent['sl_name'] . '</a></li>';
        } else {

            $parent = $this->CI->Storage_Model->fetchStorageAssignChildParent($slid, $slperm);
            if (count($parent) > 0) {
                $rwParent = $parent;
                if ($sublevel <= $rwParent['sl_depth_level']) {

                    $this->parentSelectedLevel($rwParent['sl_parent_id'], $slperm, $level, $rwParent['sl_name'], $loop, $rwParent['sl_depth_level'] - 1);
                }
                $loop[] = '<li class="active"><a href="' . base_url('app/dms-storage-structure/') . mu_dms_crypt($rwParent['sl_id'], 'e') . '">' . $rwParent['sl_name'] . '</a></li>';
            } else {
                $rwParent = $this->CI->Storage_Model->fetchStorageAssign($slid);
                if (count($rwParent) > 0) {
                    $getparnt = $rwParent['sl_parent_id'];
                    if ($sublevel <= $rwParent['sl_depth_level']) {

                        $this->parentSelectedLevel($getparnt, $slperm, $level, $rwParent['sl_name'], $loop, $rwParent['sl_depth_level'] - 1);
                    }
                    $loop[] = '<li class="active"><a href="' . base_url('app/dms-storage-structure/') . mu_dms_crypt($rwParent['sl_id'], 'd') . '">' . $rwParent['sl_name'] . '</a></li>';
                }
            }
        }
        return $loop;
    }

    /* ---------------------dms treee--------------------------- */

    public function dmsTreeGenerate($level, $slid, $parentid, $slperm) {
        $i = 0;
        $treestr = '';
        $parentarray = array();
        $childarray = array();
        $parent = $this->CI->Storage_Model->fetchStorageAssignChildParentDepth($slperm, $level);
        if (!empty($parent)) {
            $hasSub = $this->CI->Storage_Model->fetchStorageAssignChild($parent['sl_id']);
            if (count($hasSub) > 0) {
                if ($parent['sl_id'] == $slid || $parent['sl_id'] == $parentid) {
                    $parentarray[$i]['selected'] = true;
                    $parentarray[$i]['opened'] = true;
                    $parentarray[$i]['sl_id'] = $parent['sl_id'];
                    $parentarray[$i]['sl_name'] = $parent['sl_name'];
                    $parentarray[$i]['hassub'] = $this->storageSubLevelS($parent['sl_depth_level'] + 1, $parent['sl_id'], $slid, $parentid, $i);
                } else {
                    $parentarray[$i]['selected'] = false;
                    $parentarray[$i]['opened'] = false;
                    $parentarray[$i]['sl_id'] = $parent['sl_id'];
                    $parentarray[$i]['sl_name'] = $parent['sl_name'];
                    $parentarray[$i]['hassub'] = $this->storageSubLevelS($parent['sl_depth_level'] + 1, $parent['sl_id'], $slid, $parentid, $i);
                }
            } else {
                if ($parent['sl_id'] == $slid) {
                    $parentarray[$i]['selected'] = true;
                    $parentarray[$i]['opened'] = false;
                    $parentarray[$i]['type'] = "file";
                    $parentarray[$i]['sl_id'] = $parent['sl_id'];
                    $parentarray[$i]['sl_name'] = $parent['sl_name'];
                } else {
                    $parentarray[$i]['selected'] = false;
                    $parentarray[$i]['opened'] = false;
                    $parentarray[$i]['type'] = "file";
                    $parentarray[$i]['sl_id'] = $parent['sl_id'];
                    $parentarray[$i]['sl_name'] = $parent['sl_name'];
                }
            }
            $treestr = '<li data-jstree={"selected":' . $parentarray[0]['selected'] . ',"opened":' . $parentarray[0]['opened'] . '}>'
                    . '<a href=' .
                    base_url("app/dms-storage-structure/" . mu_dms_crypt($parentarray[0]['sl_id'], "e"))
                    . '>'
                    . '<i class="md md-storage"></i>' . $parentarray[0]['sl_name']
                    . '</a>'
                    . '<ul>' .
                    $this->treeStringGeneration($subtreestr = '', !empty($parentarray[0]['hassub']) ? $parentarray[0]['hassub'] : '', $k = 0, $hassub_oldstring = '')
                    . '</ul>';
            return $treestr;
        }
    }

    /* ---------Btree sub Generation------------------ */

    protected function storageSubLevelS($level, $slID, $slid, $parentid, $i) {
        $i++;
        $parentarray = array();
        $childarray = array();
        $parentchield = $this->CI->Storage_Model->fetchStorageAssignChild($slID);
        foreach ($parentchield as $key => $parent) {
            $hasSub = $this->CI->Storage_Model->fetchStorageAssignChild($parent['sl_id']);
            if (count($hasSub) > 0) {
                if ($parent['sl_id'] == $slid || $parent['sl_id'] == $parentid) {
                    $childarray[$key]['selected'] = true;
                    $childarray[$key]['opened'] = true;
                    $childarray[$key]['sl_id'] = $parent['sl_id'];
                    $childarray[$key]['sl_name'] = $parent['sl_name'];
                    $childarray[$key]['hassub'] = $this->storageSubLevelS($parent['sl_depth_level'] + 1, $parent['sl_id'], $slid, $parentid, $i);
                } else {
                    $childarray[$key]['selected'] = false;
                    $childarray[$key]['opened'] = false;
                    $childarray[$key]['sl_id'] = $parent['sl_id'];
                    $childarray[$key]['sl_name'] = $parent['sl_name'];
                    $childarray[$key]['hassub'] = $this->storageSubLevelS($parent['sl_depth_level'] + 1, $parent['sl_id'], $slid, $parentid, $i);
                }
            } else {
                if ($parent['sl_id'] == $slid) {
                    $childarray[$key]['selected'] = true;
                    $childarray[$key]['opened'] = TRUE;
                    $childarray[$key]['type'] = "";
                    $childarray[$key]['sl_id'] = $parent['sl_id'];
                    $childarray[$key]['sl_name'] = $parent['sl_name'];
                } else {
                    $childarray[$key]['selected'] = false;
                    $childarray[$key]['opened'] = false;
                    $childarray[$key]['type'] = "";
                    $childarray[$key]['sl_id'] = $parent['sl_id'];
                    $childarray[$key]['sl_name'] = $parent['sl_name'];
                }
            }
        }
        return $childarray;
    }

    /* ---------Btree Generation------------------ */

    protected function treeStringGeneration($subtreestr, $data, $k, $hassub_oldstring) {
        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                if (!empty($data[$i]['hassub'])) {
                    $hassub_oldstring = $subtreestr;
                    $subtreestr .= $hassub_oldstring . '<li data-jstree={"selected":' . $data[$i]['selected'] . ',"opened":' . $data[$i]['opened'] . '}>'
                            . '<a href=' .
                            base_url("app/dms-storage-structure/" . mu_dms_crypt($data[$i]['sl_id'], "e"))
                            . '>'
                            . '<i class="md md-storage"></i>' . $data[$i]['sl_name']
                            . '</a>'
                            . '<ul>' .
                            $this->treeStringGeneration($subtreestr = '', $data[$i]['hassub'], $k, $hassub_oldstring) .
                            '</ul>'
                            . '</li>';
                } else {
                    $subtreestr .= '<li data-jstree={"selected":' . $data[$i]['selected'] . ',"opened":' . $data[$i]['opened'] . '}>'
                            . '<a href=' .
                            base_url("app/dms-storage-structure/" . mu_dms_crypt($data[$i]['sl_id'], "e"))
                            . '>'
                            . '<i class="md md-storage"></i>' . $data[$i]['sl_name']
                            . '</a>'
                            . '</li>';
                }
            }
            $hassub_oldstring = '';
        }
        return $subtreestr;
    }

    public function findTotalFile($slperm) {


        $rwcontFile = $this->CI->Document_Model->documentSizePageCount($slperm); //page count and pdf size
        $totalFSize1 = $rwcontFile['dsize'];
        $this->totalFSize += round($totalFSize1 / (1000 * 1000), 2);
        $this->numFile += $this->CI->Document_Model->documentCount($slperm);
        $this->list["files"] = $this->numFile;
        $this->list["fileSize"] = $this->totalFSize;
        if (!empty($slperm)) {
            $this->totalFolder += 1;
        }
        $this->list["totalFolder"] = $this->totalFolder;
        $this->noofpages += $rwcontFile['npages'];
        $this->list['numPages'] = $this->noofpages;

        $sql_child = $this->CI->Storage_Model->fetchStorageAssignChild($slperm);

        if (count($sql_child) > 0) {
            foreach ($sql_child as $key => $value) {
                $child = $value['sl_id'];

                $this->findTotalFile($child);
            }
        }
        return $this->list;
    }

    /* -----------------FETCH STORAGE LEVEL------------------------- */

    public function moveMultipleChild($sl_id, $level, $slperm, $userassign) {
        global $data;
        global $k;
        $k++;
        if (!in_array($sl_id, $userassign)) {
            $data[$k]['slid'] = $sl_id;
            $loop = array();
            $data[$k]['slname'] = $this->parentLevel($sl_id, $slperm, $level, '', $loop);
//print_r($data);

            $sql_child = $this->CI->Storage_Model->fetchStorageAssignChild($sl_id);
            if (count($sql_child) > 0) {
                foreach ($sql_child as $key => $value) {
                    $child = $value['sl_id'];

                    $this->moveMultipleChild($child, $level, $slperm, $userassign);
                }
            }
        }
        return $data;
    }

    /* --------------------FETCH ALL CHIELD----------------------- */

    public function fetchAllSlChild($slprem) {
        $sql_child = $this->CI->Storage_Model->fetchStorageAssignChild($slprem);
        if (count($sql_child) > 0) {
            foreach ($sql_child as $key => $value) {
                $child = $value['sl_id'];
                $this->allChieldArray[] = $child;
                $this->fetchAllSlChild($child);
            }
        }
        return $this->allChieldArray;
    }

}
