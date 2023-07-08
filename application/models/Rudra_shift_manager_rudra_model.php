<?php                
defined('BASEPATH') or exit('No direct script access allowed');               
class Rudra_shift_manager_rudra_model extends CI_Model                
{                
	public function __construct()                    
	{                    
		parent::__construct();
		$this->bdp = $this->db->dbprefix;
		$this->full_table = 'rudra_shift_manager';   
	}
	public function search($find,$whereSearch=""){
		$count = 0;
		if(!empty($whereSearch))
		{
			$this->db->where($whereSearch->kind,$whereSearch->Value);
		}
		$this->db->group_start();
		$this->db->like('sm_fname',$find);
		$this->db->or_like('sm_lname',$find);
		$this->db->or_like('sm_mobile',$find);
		$this->db->group_end();
		$res = $this->db->get('rudra_shift_manager');
		$count = $this->db->count_all_results('rudra_shift_manager');	
		if ($count == 1) {
                    return $res->row_array();
            }elseif($count > 1) {
                    return $res->result_array();
            }
            return FALSE;
           
	}
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name,$leftJoin1 = '',$whereSearch = '')
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT TBL.id,  concat(rudra_facility_owner.fo_fname,'  ',rudra_facility_owner.fo_lname) as fo_name, concat(TBL.sm_fname,'  ', TBL.sm_lname) as sm_name, TBL.sm_mobile, TBL.sm_email, TBL.sm_fcm_token, TBL.sm_device_token, TBL.sm_password, TBL.status, TBL.added_on" ;
	$query .= "  FROM $table   "; 
	if(!empty($leftJoin1)){
			$query .= " LEFT JOIN rudra_facility_owner
	ON TBL.fo_id = rudra_facility_owner.id";
		}
	$where = " WHERE 1 = 1 ";
	if(!empty($whereSearch))
			{
				$where.="AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
			}
	if(!empty($filter_data['id']))
	{
		$where.=" AND TBL.id=".$filter_data['id'];
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
	if(!empty($filter_data['searchBySM'])&&(empty($filter_data['id'])))
	{
		$where .=  " AND (  TBL.sm_fname LIKE '%".$filter_data['searchBySM']."%'";
		$where .=  " OR TBL.sm_lname LIKE '%".$filter_data['searchBySM']."%'";
		$where .=  " OR TBL.sm_lname LIKE '%".$filter_data['searchBySM']."%' )";
		
	}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_fname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_lname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_mobile LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_email LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_fcm_token LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_device_token LIKE '%".$filter_data['general_search']."%'";
	if(!empty($leftJoin1)){
	$where .=  "  OR  rudra_facility_owner.fo_fname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  rudra_facility_owner.fo_lname LIKE '%".$filter_data['general_search']."%'";
	}
	$where .=  "  OR  TBL.sm_password LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$order_by = ($order == '' ? '' : ' ORDER BY '.$order." ".$dir);
	 $limit = " LIMIT ".$start." , " .$limit;
	$query = $query.$where.$order_by.$limit;
	 $res = $this->db->query($query)->result();
	 return $res;
	}


	public function count_table_data($filter_data,$table_name,$leftJoin1 = '',$whereSearch = '')
		{
		$table = $this->full_table .' TBL';
	$query = " SELECT COUNT(TBL.id) as cntrows" ;
	$query .= "  FROM $table   "; 
	if(!empty($leftJoin1)){
			$query .= " LEFT JOIN rudra_facility_owner ON TBL.fo_id = rudra_facility_owner.id";
		}
	$where = " WHERE 1 = 1 ";
	if(!empty($whereSearch))
			{
				$where.="AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
			}
	if(!empty($filter_data['id']))
	{
		$where.=" AND TBL.id=".$filter_data['id'];
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
	if(!empty($filter_data['searchBySM'])&&(empty($filter_data['id'])))
	{
		$where .=  " AND (  TBL.sm_fname LIKE '%".$filter_data['searchBySM']."%'";
		$where .=  " OR TBL.sm_lname LIKE '%".$filter_data['searchBySM']."%'";
		$where .=  " OR TBL.sm_lname LIKE '%".$filter_data['searchBySM']."%' )";
		
	}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_fname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_lname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_mobile LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_email LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.sm_password LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	if(!empty($leftJoin1)){
	$where .=  "  OR  rudra_facility_owner.fo_fname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  rudra_facility_owner.fo_lname LIKE '%".$filter_data['general_search']."%'";
	}
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}

}