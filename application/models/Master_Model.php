<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master_Model extends CI_Model {
	
	
	/* --------------------------find all data-------------------------------- */
	
	public function find_all($table) {
        				
       $qry = $this->db->select('*')->from($table)->get();
	   $data = $qry->result_array();
		
        return $data;
					   
    }
	
	/* --------------------------insert data-------------------------------- */
	
	public function insert($table,$param) {
       		
       $this->db->insert($table,$param);
	 
	    return $this->db->insert_id();
    }
	
	
	/* --------------------------update data-------------------------------- */
	
	public function update($table,$param) {
		$id = $param['id'];
		$this->db->where('id',$id);
	    return $this->db->update($table,$param);
    }
	
	
		
	/* --------------------------find all data-------------------------------- */
	public function findAll($query)
    {
		
		$qry = $this->db->query($query);
	   $data = $qry->result_array();
		
        return $data;
    }
	
	
	/* --------------------------check value exist-------------------------------- */
	public function validateExist($table,$param) 
	{
		$name = $param['name'];
        $qry = $this->db->where('name', $name)
                ->get($table);
        if ($qry->num_rows() > 0) {
            $resultData['status'] = TRUE;
        } else {
            $resultData['status'] = FALSE;
        }

        return $resultData;
    }
	
	
	
	/* --------------------------get row record-------------------------------- */
	function get_row_record($query)
    {  
			$resulset   = $this->db->query($query);
			$total_rows =$resulset->num_rows();
			$result		=array();
			if($total_rows>0)
			{
					$result=$resulset->row_array();
					
			}
			
			return $result;
    }
	
	/* --------------------------get row record-------------------------------- */
	function get_rows_record($query)
    {  
		$resulset   = $this->db->query($query);
		$total_rows =$resulset->num_rows();
		$result		=array();
		if($total_rows>0)
		{
				$result=$resulset->result_array();
				
		}
		
		return $result;
    }
	
}