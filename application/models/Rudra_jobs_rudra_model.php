<?php               
defined('BASEPATH') or exit('No direct script access allowed');                
class Rudra_jobs_rudra_model extends CI_Model              
{                
	public function __construct()                   
	{             
		parent::__construct();
		$this->bdp = $this->db->dbprefix;
		$this->full_table = 'rudra_jobs';
     }
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name,$leftJoin1 = '',$leftJoin2 = '',$leftJoin3 = '',$whereSearch = '')
	{
		$table = $this->full_table .' TBL';
		$query = " SELECT TBL.id,rudra_facility_category.fc_name,rudra_nurse_category.nc_name,Concat(rudra_shift_manager.sm_fname,' ',rudra_shift_manager.sm_lname) as sm_name, TBL.job_title, TBL.shift_type, TBL.job_hours,  TBL.job_rate, TBL.job_prem_rate, TBL.status, TBL.start_date, TBL.end_date, TBL.added_on" ;
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
	if(!empty($filter_data['job_id']))
	{
		$where .=" AND TBL.id=".$filter_data['job_id'];
	}
	if(!empty($filter_data['searchBy'])&&(empty($filter_data['job_id'])))
		{
			$where .=  " AND (  TBL.job_title LIKE '%".$filter_data['searchBy']."%')";
		}
	if(!empty($filter_data['sm_id']))
	{
		$where.=" AND TBL.sm_id=".$filter_data['sm_id'];
	}
	if(!empty($filter_data['fo_id']))
	{
		$where.="  AND TBL.fo_id=".$filter_data['fo_id'];
	}
	if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	if((!empty($filter_data['searchByFacility']))&& empty($filter_data['fo_id']))
		{ 
	        $where .=  " AND ( rudra_facility_owner.fo_fname LIKE '%".$filter_data['searchByFacility']."%'";
			$where .=  " OR rudra_facility_owner.fo_lname LIKE '%".$filter_data['searchByFacility']."%'";
			$where .=  " OR rudra_facility_owner.fo_mobile LIKE '%".$filter_data['searchByFacility']."%' )";
		}
	if(!empty($filter_data['searchBySM'])&&(empty($filter_data['sm_id'])))
		{
			$where .=  " AND (  TBL.sm_fname LIKE '%".$filter_data['searchBySM']."%'";
			$where .=  " OR TBL.sm_lname LIKE '%".$filter_data['searchBySM']."%'";
			$where .=  " OR TBL.sm_lname LIKE '%".$filter_data['searchBySM']."%' )";
		}
	
		if(!empty($whereSearch))
		{
			$where.=" AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
		}
		$where .= " AND ( ";
		$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.job_title LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.shift_type LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.job_hours LIKE '%".$filter_data['general_search']."%'";
		//$where .=  "  OR  TBL.is_premium LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.job_rate LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.job_prem_rate LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_shift_manager.sm_fname LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_shift_manager.sm_lname LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_facility_category.fc_name LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_nurse_category.nc_name LIKE '%".$filter_data['general_search']."%'";
		 $where .= " ) ";
		 $order_by = ($order == '' ? '' : ' ORDER BY '.$order." ".$dir);
		 $limit = " LIMIT ".$start." , " .$limit;
		 $query = $query.$where.$order_by.$limit;
		 $res = $this->db->query($query)->result();
		 return $res;
	}
    public function admin_get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name,$leftJoin1 = '',$leftJoin2 = '',$leftJoin3 = '',$whereSearch = '',$leftJoin4 = '')
	{
		$table = $this->full_table .' TBL';
		$query = " SELECT TBL.id,rudra_facility_category.fc_name,rudra_nurse_category.nc_name, concat(rudra_facility_owner.fo_fname,' ',rudra_facility_owner.fo_lname) as fo_name,concat(rudra_shift_manager.sm_fname,' ',rudra_shift_manager.sm_lname) as sm_name, TBL.job_title, TBL.shift_type, TBL.job_hours,  TBL.job_rate, TBL.job_prem_rate, TBL.status, TBL.start_date, TBL.end_date, TBL.added_on" ;
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
		}if(!empty($leftJoin4)){
			$query .= " LEFT JOIN rudra_facility_owner
	ON TBL.fo_id = rudra_facility_owner.id";
		}
		
		$where = " WHERE 1 = 1 ";
		if(!empty($filter_data['job_id']))
	{
		$where .=" AND TBL.id=".$filter_data['job_id'];
	}
	if(!empty($filter_data['searchBy'])&&(empty($filter_data['job_id'])))
		{
			$where .=  " AND (  TBL.job_title LIKE '%".$filter_data['searchBy']."%')";
		}
		if(!empty($filter_data['sm_id']))
	{
		$where.=" AND TBL.sm_id=".$filter_data['sm_id'];
	}
	if(!empty($filter_data['fo_id']))
	{
		$where.=" AND TBL.fo_id=".$filter_data['fo_id'];
	}
	if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	if((!empty($filter_data['searchByFacility']))&& empty($filter_data['fo_id']))
		{ 
	        $where .=  " AND ( rudra_facility_owner.fo_fname LIKE '%".$filter_data['searchByFacility']."%'";
			$where .=  " OR rudra_facility_owner.fo_lname LIKE '%".$filter_data['searchByFacility']."%'";
			$where .=  " OR rudra_facility_owner.fo_mobile LIKE '%".$filter_data['searchByFacility']."%' )";
		}
	if(!empty($filter_data['searchBySM'])&&(empty($filter_data['sm_id'])))
		{
			$where .=  " AND (  TBL.sm_fname LIKE '%".$filter_data['searchBySM']."%'";
			$where .=  " OR TBL.sm_lname LIKE '%".$filter_data['searchBySM']."%'";
			$where .=  " OR TBL.sm_lname LIKE '%".$filter_data['searchBySM']."%' )";
		}
		if(!empty($whereSearch))
		{
			$where.="AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
		}
		$where .= " AND ( ";
		$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.job_title LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.job_description LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.shift_type LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.job_hours LIKE '%".$filter_data['general_search']."%'";
		//$where .=  "  OR  TBL.is_premium LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.job_rate LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.job_prem_rate LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
		if(!empty($leftJoin1)){
	$where .=  "  OR  rudra_shift_manager.sm_fname LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_shift_manager.sm_lname LIKE '%".$filter_data['general_search']."%'";
	}if(!empty($leftJoin4)){
		$where .=  "  OR  rudra_facility_owner.fo_fname LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_facility_owner.fo_lname LIKE '%".$filter_data['general_search']."%'";
	}if(!empty($leftJoin3)){
		$where .=  "  OR  rudra_facility_category.fc_name LIKE '%".$filter_data['general_search']."%'";
	}
		if(!empty($leftJoin2)){
		$where .=  "  OR  rudra_nurse_category.nc_name LIKE '%".$filter_data['general_search']."%'";
		}
		 $where .= " ) ";
		 $order_by = ($order == '' ? '' : ' ORDER BY '.$order." ".$dir);
		 $limit = " LIMIT ".$start." , " .$limit;
		 $query = $query.$where.$order_by.$limit;
		 $res = $this->db->query($query)->result();
		 return $res;
	}
    
	public function count_table_data($filter_data,$table_name,$leftJoin1 = '',$leftJoin2 = '',$leftJoin3 = '',$whereSearch = '')
		{
		$table = $this->full_table .' TBL';
	$query = " SELECT COUNT(TBL.id) as cntrows" ;
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
		}if(!empty($leftJoin4)){
			$query .= " LEFT JOIN rudra_facility_owner
	ON TBL.fo_id = rudra_facility_owner.id";
		}
		
		$where = " WHERE 1 = 1 ";
		if(!empty($filter_data['job_id']))
	{
		$where .=" AND TBL.id=".$filter_data['job_id'];
	}
	if(!empty($filter_data['searchBy'])&&(empty($filter_data['job_id'])))
		{
			$where .=  " AND (  TBL.job_title LIKE '%".$filter_data['searchBy']."%')";
		}
		if(!empty($filter_data['sm_id']))
	{
		$where.=" AND TBL.sm_id=".$filter_data['sm_id'];
	}
	if(!empty($filter_data['fo_id']))
	{
		$where.=" AND TBL.fo_id=".$filter_data['fo_id'];
	}
	if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	if((!empty($filter_data['searchByFacility']))&& empty($filter_data['fo_id']))
		{ 
	        $where .=  " AND ( rudra_facility_owner.fo_fname LIKE '%".$filter_data['searchByFacility']."%'";
			$where .=  " OR rudra_facility_owner.fo_lname LIKE '%".$filter_data['searchByFacility']."%'";
			$where .=  " OR rudra_facility_owner.fo_mobile LIKE '%".$filter_data['searchByFacility']."%' )";
		}
	if(!empty($filter_data['searchBySM'])&&(empty($filter_data['sm_id'])))
		{
			$where .=  " AND (  TBL.sm_fname LIKE '%".$filter_data['searchBySM']."%'";
			$where .=  " OR TBL.sm_lname LIKE '%".$filter_data['searchBySM']."%'";
			$where .=  " OR TBL.sm_lname LIKE '%".$filter_data['searchBySM']."%' )";
		}
		if(!empty($whereSearch))
		{
			$where.="AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
		}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_cat_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_cat_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.job_title LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.job_description LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.shift_type LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.job_hours LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.is_premium LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.job_rate LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.job_prem_rate LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	if(!empty($leftJoin1)){
		$where .=  "  OR  rudra_shift_manager.sm_fname LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_shift_manager.sm_lname LIKE '%".$filter_data['general_search']."%'";
	}if(!empty($leftJoin4)){
		$where .=  "  OR  rudra_facility_owner.fo_fname LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_facility_owner.fo_lname LIKE '%".$filter_data['general_search']."%'";
	}if(!empty($leftJoin3)){
		$where .=  "  OR  rudra_facility_category.fc_name LIKE '%".$filter_data['general_search']."%'";
	}
		if(!empty($leftJoin2)){
		$where .=  "  OR  rudra_nurse_category.nc_name LIKE '%".$filter_data['general_search']."%'";
		}
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}

}