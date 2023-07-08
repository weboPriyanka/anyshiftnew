<?php
                
defined('BASEPATH') or exit('No direct script access allowed');

                
class Rudra_facility_transactions_rudra_model extends CI_Model
                
{
                   
                    
	public function __construct()              
	{           
			parent::__construct();
			$this->bdp = $this->db->dbprefix;
			$this->full_table = 'rudra_facility_transactions';
	}
	public function find($find){
		$count = 0;
		$this->db->group_start();
		$this->db->like('cg_fname',$find);
		$this->db->or_like('cg_lname',$find);
		$this->db->or_like('cg_mobile',$find);
		$this->db->group_end();
		$res = $this->db->get('rudra_care_giver');
		$count = $this->db->count_all_results('rudra_care_giver');	
		if ($count == 1) {
                    return $res->row_array();
            }elseif($count > 1) {
                    return $res->result_array();
            }
            return FALSE;
           
	}
	public function findbyJob($find,$whereSearch=""){
		$count = 0;
		if(!empty($whereSearch))
		{
			$this->db->where($whereSearch->kind,$whereSearch->Value);
		}
		$this->db->group_start();
		$this->db->like('job_title',$find);
		$this->db->or_like('job_description',$find);
		$this->db->group_end();
		$res = $this->db->get('rudra_jobs');
		$count = $this->db->count_all_results('rudra_jobs');	
		if ($count == 1) {
                    return $res->row_array();
            }elseif($count > 1) {
                    return $res->result_array();
            }
            return FALSE;
           
	}
	public function admin_get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name,$leftJoin1 = '')
	{
		$table = $this->full_table .' TBL ';
		$query = " SELECT TBL.id, TBL.fwt_amount, TBL.fwt_type,concat(rudra_facility_owner.fo_fname,' ',rudra_facility_owner.fo_lname) as fo_name, TBL.status, TBL.ad_id, TBL.ad_type" ;
		$query .= "  FROM $table "; 
	if(!empty($leftJoin1)){
			$query .= " LEFT JOIN rudra_facility_owner
	ON TBL.fo_id = rudra_facility_owner.id";
		}
	$where = " WHERE 1 = 1 ";
	if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	// In Progress Code
	if((!empty($filter_data['searchByJob']))||(!empty($filter_data['searchByCare'])))
	{
		if(!empty($filter_data['job_id'])){
		$where .=  " AND ad_id IN (".$filter_data['job_id'].") AND ad_type='job' ";
		}else{
			$where .=  " AND ad_id IN ('') AND ad_type='job' ";
		}
	}
	// In Progress Code
	
	// In Progress Code
	if(!empty($filter_data['fo_id']))
	{
		$where.=" AND TBL.fo_id=".$filter_data['fo_id'];
	}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fwt_amount LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fwt_type LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	if(!empty($leftJoin1)){
		$where .=  "  OR  rudra_facility_owner.fo_fname LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_facility_owner.fo_lname LIKE '%".$filter_data['general_search']."%'";
	}
	$where .=  "  OR  TBL.ad_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.ad_type LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$order_by = ($order == '' ? '' : ' ORDER BY '.$order." ".$dir);
	 $limit = " LIMIT ".$start." , " .$limit;
	$query = $query.$where.$order_by.$limit;
	 $res = $this->db->query($query)->result();
	 return $res;
	}
	public function admin_count_table_data($filter_data,$table_name,$leftJoin1 = '')
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT COUNT(TBL.id) as cntrows" ;
	$query .= "  FROM $table  "; 
	if(!empty($leftJoin1)){
			$query .= " LEFT JOIN rudra_facility_owner
	ON TBL.fo_id = rudra_facility_owner.id";
		}
		$where = " WHERE 1 = 1 ";
		if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	// In Progress Code
	if((!empty($filter_data['searchByJob']))||(!empty($filter_data['searchByCare'])))
	{   if(!empty($filter_data['job_id'])){
		$where .=  " AND ad_id IN (".$filter_data['job_id'].") AND ad_type='job' ";
		}else{
			$where .=  " AND ad_id IN ('') AND ad_type='job' ";
		}
	}
	$where .=  " AND TBL.ad_type='job' ";
	// In Progress Code
		if(!empty($filter_data['fo_id'])){
		$where.=" AND TBL.fo_id=".$filter_data['fo_id'];
		}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fwt_amount LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fwt_type LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.ad_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.ad_type LIKE '%".$filter_data['general_search']."%'";
	if(!empty($leftJoin1)){
		$where .=  "  OR  rudra_facility_owner.fo_fname LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_facility_owner.fo_lname LIKE '%".$filter_data['general_search']."%'";
		}
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}
    public function get_table_data($add_type, $limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name,$leftJoin1 = '',$leftJoin2 = '',$leftJoin3 = '',$whereSearch = '')
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT TBL.id, TBL.fwt_amount, TBL.fwt_type, TBL.status, TBL.ad_id, TBL.ad_type, TBL.added_on" ;
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
		if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	// In Progress Code
	if((!empty($filter_data['searchByJob']))||(!empty($filter_data['searchByCare'])))
	{
		if(!empty($filter_data['job_id'])){
		$where .=  " AND TBL.ad_id IN (".$filter_data['job_id'].") AND TBL.ad_type='job' ";
		}else{
			$where .=  " AND TBL.ad_id IN ('') AND TBL.ad_type='job' ";
		}
	}
	if($add_type =="Admin")
	{
		$where .=  " AND TBL.ad_type='admin' ";
		
	}
	else if($add_type =="Nurse")
	{
		$where .=  " AND TBL.ad_type='job' ";
	}
		if(!empty($whereSearch))
		{
			$where.="AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
		}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fwt_amount LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fwt_type LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.ad_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.ad_type LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$order_by = ($order == '' ? '' : ' ORDER BY '.$order." ".$dir);
	 $limit = " LIMIT ".$start." , " .$limit;
	$query = $query.$where.$order_by.$limit;
	 $res = $this->db->query($query)->result();
	 return $res;
	}

	public function count_table_data($filter_data,$add_type,$table_name,$whereSearch = '')
		{
		$table = $this->full_table .' TBL';
	$query = " SELECT COUNT(TBL.id) as cntrows" ;
	$query .= "  FROM $table   "; 
	$where = " WHERE 1 = 1 ";
	if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	// In Progress Code
	if((!empty($filter_data['searchByJob']))||(!empty($filter_data['searchByCare'])))
	{
		if(!empty($filter_data['job_id'])){
		$where .=  " AND TBL.ad_id IN (".$filter_data['job_id'].") AND TBL.ad_type='job' ";
		}else{
			$where .=  " AND TBL.ad_id IN ('') AND TBL.ad_type='job' ";
		}
	}
	if(!empty($whereSearch))
		{
			$where.="AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
		}
	if($add_type =="Admin")
	{
		$where .=  " AND TBL.ad_type='admin' ";
		
	}
	else if($add_type =="Nurse")
	{
		$where .=  " AND TBL.ad_type='job' ";
	}
	// $where .=  " AND TBL.ad_type='job' ";
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fwt_amount LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fwt_type LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.ad_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.ad_type LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}
		
    public function transaction($where)
		{
			$table = $this->full_table ;
			
			if(!empty($where)){
				$this->db->where($where);
			}
			$res = $this->db->get($table);
			if(!empty($where)){
				$this->db->where($where);
			}
			$count = $this->db->count_all_results($table);
			if ($count == 1) {
                    return $res->row_array();
            }elseif($count > 1) {
                    return $res->result_array();
            }
            return FALSE;
		}
}