<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Admin Author Model Class
 * This Class Represents the Author Model in system
 * Extend the Model(sytem/libraries/Model)
 *
 * @package     Author
 * @author	Uprack
 */
class MY_Model extends CI_Model
{
        public $addCreateModified=true;
        /**
        * The default constructor
        * @access	public
        */
        function __construct()
        {
                //The Call Parent constructor i.e. Model Constructor
                parent::__construct();
        }

        public function query($query){
            $master=$this->db;
            $resulset   = $master->query($query);
        }
        
        /**
        * get Rows records from table according to start limit
        *
        * @access	private
        * @param1	integer
        * @return	array
        */
        function get_records($start_limit=0,$query,$limit=0)
        {
			
            //it willcontain the records and other values
           $paging_array   =array();


           //number of records to be shown on page
           $perpagerecords                 =!empty($limit)?$limit:PER_PAGE_RECORD;
           //start limit from total records
           $limit_start                    =$start_limit;
           //end limit from total records
           $limit_end                      =$perpagerecords;
           //current page number
           $cur_page                       =$start_limit;

           //get toatal number of records.pass extra query if user perform search

           $total_records                  =$this->get_total_records($query);

           //get all row records as an array.pass start limit,end limit,and extra query if search is perform
           $data_res                       =$this->findAll($query,$limit_start,$limit_end);
           $records_start_from             =$start_limit+1;
           $records_start_to               =($records_start_from+$perpagerecords)-1;
           if($records_start_to<=$total_records)
           {
                   $records_start_to       =$records_start_to;
           }
           else
           {
                   $records_start_to       =$total_records;
           }
           $paging_array['records']        =$data_res;
           $paging_array['total_records']  =$total_records;
           $paging_array['perpagerecords'] =$perpagerecords;
           $paging_array['cur_page']       =$cur_page;
           $paging_array['num_links']      = 9;

           $paging_array['records_start_from']      =$records_start_from;
           $paging_array['records_start_to']        =$records_start_to;

           return $paging_array;
        }
        
        
        // --------------------------------------------------------------------

        /**
        * Get Total Number Of Records
        *
        * @access	public
        * @param1	string
        * @return	integer
        */
        function get_total_records($query)
        {
                $total_rows = '';
                $master=$this->db;
                $resulset   = $master->query($query);
                if(!empty($resulset)){
                    $total_rows =$resulset->num_rows();
                }   
                return $total_rows;
        }
		// --------------------------------------------------------------------

        /**
        * Get Row Record
        *
        * @access	public
        * @param1	string
        * @return	integer
        */
        function get_row_record($query)
        {
                $master=$this->db;
                $resulset   = $master->query($query);
                $total_rows =$resulset->num_rows();
				$result		=array();
				if($total_rows>0)
				{
						$result=$resulset->row_array();
						$this->data_stripslashes($result);
				}
				
                return $result;
        }
		// --------------------------------------------------------------------

        /**
        * Get Rows Record
        *
        * @access	public
        * @param1	string
        * @return	integer
        */
        function get_rows_record($query)
        {
			
                $master=$this->db;
                $resulset   = $master->query($query);
                $total_rows =$resulset->num_rows();
				$result		=array();
				if($total_rows>0)
				{
						foreach($resulset->result_array() as $row)
						{
								$this->data_stripslashes($row);
								//$result[]=$row;
								
								array_push($result,$row);
						}
				}
				//print_r($result);
                return $result;
        }
        // --------------------------------------------------------------------

        /**
        * return all records as an array,use limit and extra conditions
        *
        * @access	public
        * @param	string
        * @param	integer
        * @param	integer
        * @return	array
        */
        function findAll($query=NULL, $start = NULL, $count = NULL)
        {
		
                return $this->find($query, $start, $count);
        }
        // --------------------------------------------------------------------

        /**
        * return rows records as an array,use limit and extra conditions
        *
        * @access	private
        * @param	string
        * @param	integer
        * @param	integer
        * @return	array
        */
		
        private function find($query = NULL, $start = NULL, $count = NULL)
        {
			
                $results = array();
                // Load the database library
                $master=$this->db;
               
                // Filter could be an array or filter values or an SQL string.
                $where_clause          = '';
                

                $limit_clause = '';
                if ($start!==NULL && $start>=0)
                {
                        if ($count)
                        {
                                $limit_clause    = " LIMIT $start, $count ";
                        }
                        else
                        {
                                $limit_clause    = " LIMIT $start ";
                        }
                }

                // Build up the SQL query string and run the query
                $sql                   =$query . $limit_clause;

                $query                 = $this->db->query($sql);
				//pr($query);
                if ($query->num_rows > 0)
                {
                         // ////////////////////////////////////////////////////////////////////
                         // NOTE: At this stage you could return the entire result set, like:
                         // NOTE: ...return $query->result_array();
                         // NOTE: ...The generated code loops through the result set to provide
                         // NOTE: ...the oppurtunity to provide further customisations on the
                         // NOTE: ...code (especially if you are generating in verbose mode).
                         // ////////////////////////////////////////////////////////////////////

                        foreach ($query->result_array() as $row)      // Go through the result set
                        {
                                // Build up a list for each column from the database and place it in
                                // ...the result set
                                //strip slashes to data array item.function written in MY_Model
                                $this->data_stripslashes($row);
                                $results[]  = $row;

                        }

                }

                return $results;

        }
		/**
        * Insert The Record in Table
        *
        * @access	public
        * @param	string as table name
		* @param	array(column name as key and value as column value)
        * @return	integer
        */
        function insert($table_name,$data,$return_id=0)
        {
                // Build up the SQL query string
                $this->data_addslashes($data);
                if($this->addCreateModified){
                    $data['modified']=$data['created']=date('Y-m-d H:i:s');
                }
		        $insert=$this->db->insert($table_name,$data);  
                if(!$insert){
                    $arrError=array('code'=>$this->db->conn_id->error_list[0]['errno']);
                    return $arrError;                    
                }else if($return_id==1){
                    return $this->db->insert_id();
                }else{
                    return true;
                }
                
        }
		
        public $arrHistoryTables = array('students','account_vouchers','student_fees','student_fee_map','transport_student_fee_map','transport_student_fees');
		/**
        * update the record with single condition
        *
        * @access	public
        * @param	string
        * @return	array
		* @param	string
		* @param	string
        */
        function update($table_name,$data,$condition,$value=NULL)
        {
                // Load the database library
                $master=$this->db;
                if(!empty($condition['id']) && in_array($table_name, $this->arrHistoryTables)){
                    $query='INSERT INTO '.$table_name.'_history SELECT * FROM '.$table_name.' WHERE id='.$condition['id'];
                    $this->db->query($query);
                }else if(!empty($condition['voucherId']) && in_array($table_name, $this->arrHistoryTables)){
                    $query='INSERT INTO '.$table_name.'_history SELECT * FROM '.$table_name.' WHERE voucherId='.$condition['voucherId'];
                    $this->db->query($query);
                }
                
                // Build up the SQL query string
                $this->data_addslashes($data);
                if($this->addCreateModified)
                    $data['modified']=date('Y-m-d H:i:s');
                
                $master->where($condition, $value);
			
                $update=$master->update($table_name,$data);
                if(!$update){
                    $arrError=array('code'=>$master->conn_id->error_list[0]['errno']);
                    return $arrError;                    
                }else{
                    return true;
                }
                
        }
		// --------------------------------------------------------------------

        /**
        * Delete Existing Record
        *
        * @access	public
        * @param        integer
        * @return	void
        */
        function delete($table,$condition,$value=NULL)
        {
                //load database
                $master=$this->db;
                //apply where condition
                $master->where($condition, $value);
                //delete record
                $master->delete($table);
        }
        // --------------------------------------------------------------------

        /**
        * add slashes to data or data array
        *
        * @access	protected
        * @param	string/array
        * @return	string/array
        */
        protected function data_addslashes(&$input)
        {
                if(is_array($input))
                {
                        foreach($input as $k=>$v)
                        {
                                //$v=preg_replace('/[^(\x20-\x7F)\x0A]*/','', $v);
                                $input[$k]      =addslashes(trim($v));
                        }
                }
                else
                {
                        $input      =addslashes(trim($input));
                }


        }

         // --------------------------------------------------------------------

        /**
        * strip slashes from data or data array
        *
        * @access	protected
        * @param	string/array
        * @return	string/array
        */
        protected function data_stripslashes(&$input)
        {
                if(is_array($input))
                {
                        foreach($input as $k=>$v)
                        {
                                $input[$k]      =stripslashes(trim($v));
                        }
                }
                else
                {
                        $input      =stripslashes(trim($input));
                }


        }
        #
        
// END Admin My Model Class

/* End of file My_Model.php */
/* Location: ./system/application/libraries/My_Model.php */
}

?>
