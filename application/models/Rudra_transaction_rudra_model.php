<?php
                
defined('BASEPATH') or exit('No direct script access allowed');

                
class Rudra_transaction_rudra_model extends CI_Model
                
{
                   
                    
	public function __construct()
                    
	{             
		parent::__construct();
		$this->bdp = $this->db->dbprefix;
		$this->full_table = 'rudra_facility_transactions';
     }
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name,$leftJoin1 = '',$leftJoin2 = '',$leftJoin3 = '',$whereSearch = '')
	{
		$table = $this->full_table .' TBL';
		$query = " SELECT TBL.id, TBL.fwt_amount, TBL.fwt_type,TBL.status, TBL.ad_id, TBL.ad_type, TBL.added_on" ;
		$query .= "  FROM $table   "; 
		if(!empty($leftJoin1)){
			$query .= " LEFT JOIN rudra_shift_manager
	ON TBL.sm_id = rudra_shift_manager.id";
		}
		if(!empty($leftJoin2)){
			$query .= " LEFT JOIN  rudra_nurse_category
	ON TBL.cg_cat_id =  rudra_nurse_category.id";
		}
		if(!empty($leftJoin3)){
			$query .= " LEFT JOIN  rudra_facility_category
	ON TBL.fc_cat_id =  rudra_facility_category.id";
		}
		
		$where = " WHERE 1 = 1 ";
		if(!empty($whereSearch))
		{
			$where.="AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
		}
		$where .= " AND ( ";
		$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.fwt_amount LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.fwt_type LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.ad_type LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
		//$where .=  "  OR  rudra_shift_manager.sm_fname LIKE '%".$filter_data['general_search']."%'";
		 $where .= " ) ";
		 $order_by = ($order == '' ? '' : ' ORDER BY '.$order." ".$dir);
		 $limit = " LIMIT ".$start." , " .$limit;
		 echo $query = $query.$where.$order_by.$limit;
		 $res = $this->db->query($query)->result();
		 return $res;
	}


	public function count_table_data($filter_data,$table_name,$whereSearch = '')
		{
		$table = $this->full_table .' TBL';
	$query = " SELECT COUNT(TBL.id) as cntrows" ;
	$query .= "  FROM $table   "; 
	$where = " WHERE 1 = 1 ";
		if(!empty($whereSearch))
		{
			$where.="AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
		}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.fwt_amount LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.fwt_type LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.ad_type LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}

}