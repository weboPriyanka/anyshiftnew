<?php
                
defined('BASEPATH') or exit('No direct script access allowed');

                
class Rudra_user_rudra_model extends CI_Model
                
{
                   
                    
	public function __construct()
                    
	{
                    
		parent::__construct();
                
                    $this->bdp = $this->db->dbprefix;
                    $this->full_table = 'rudra_user';
                        
                    }
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name)
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT TBL.id, TBL.admin_id, TBL.name, TBL.added_on" ;
	$query .= "  FROM $table    INNER JOIN  rudra_admin ON TBL.admin_id = rudra_admin.id  "; 
	$where = " WHERE 1 = 1 ";
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  rudra_admin.name LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.name LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$order_by = ($order == '' ? '' : ' ORDER BY '.$order." ".$dir);
	 $limit = " LIMIT ".$start." , " .$limit;
	$query = $query.$where.$order_by.$limit;
	 $res = $this->db->query($query)->result();
	 return $res;
	}


	public function count_table_data($filter_data,$table_name)
		{
		$table = $this->full_table .' TBL';
	$query = " SELECT COUNT(TBL.id) as cntrows" ;
	$query .= "  FROM $table    INNER JOIN  rudra_admin ON TBL.admin_id = rudra_admin.id  "; 
	$where = " WHERE 1 = 1 ";
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  rudra_admin.name LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.name LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}


	public function check_SMuser_exists($email = ""){

		$where = "WHERE `status` = 'Active' AND (`sm_email` = '" . $email . "')";
		

		$return = [];
		$sql = "SELECT * FROM `rudra_shift_manager` " . $where . "  ";
		$check_user_exists = $this->db->query($sql);
		if ($check_user_exists->num_rows() > 0) {
			$return = $check_user_exists->row();
		}

		return $return;



	}


	public function check_Nurseuser_exists($email=''){

		$where = "WHERE `status` = 'Active' AND (`cg_email` = '" . $email . "')";
		

		$return = [];
		$sql = "SELECT * FROM `rudra_care_giver` " . $where . "  ";
		$check_user_exists = $this->db->query($sql);
		if ($check_user_exists->num_rows() > 0) {
			$return = $check_user_exists->row();
		}

		return $return;



	}

}