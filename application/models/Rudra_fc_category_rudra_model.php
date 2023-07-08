<?php                
defined('BASEPATH') or exit('No direct script access allowed');               
class Rudra_fc_category_rudra_model extends CI_Model                
{                
	public function __construct()                    
	{                    
		parent::__construct();
		$this->bdp = $this->db->dbprefix;
		$this->full_table = 'rudra_fc_category';
     }
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name,$leftJoin = '',$whereSearch='')
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT TBL.id,rudra_facility_category.fc_name as fc_name, TBL.normal_rate, TBL.premium_rate, TBL.added_on" ;
	$query .= "  FROM $table  "; 
	if(!empty($leftJoin)){
		$query .= "LEFT JOIN rudra_facility_category
ON TBL.fcat_id = rudra_facility_category.id";
	}
	$where = " WHERE 1 = 1 ";
	if(!empty($whereSearch))
	{
		$where.=" AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
	}
	if(!empty($filter_data['fcat_id']))
	{
		$where.=" AND TBL.fcat_id=".$filter_data['fcat_id'];
	}
	if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	if(!empty($filter_data['searchBy'])&&(empty($filter_data['fcat_id'])))
	{
		$where .=  " AND (  rudra_facility_category.fc_name LIKE '%".$filter_data['searchBy']."%')";
	}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.normal_rate LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.premium_rate LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  rudra_facility_category.fc_name LIKE '%".$filter_data['general_search']."%'";
	
	 $where .= " ) ";
	$order_by = ($order == '' ? '' : ' ORDER BY '.$order." ".$dir);
	 $limit = " LIMIT ".$start." , " .$limit;
	$query = $query.$where.$order_by.$limit;
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
		$where.=" AND TBL.".$whereSearch->kind."=".$whereSearch->Value;
	}
	if(!empty($filter_data['fcat_id']))
	{
		$where.=" AND TBL.fcat_id=".$filter_data['fcat_id'];
	}
	if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	if(!empty($filter_data['searchBy'])&&(empty($filter_data['fcat_id'])))
	{
		$where .=  " AND (  rudra_facility_category.fc_name LIKE '%".$filter_data['searchBy']."%')";
	}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fcat_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.normal_rate LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.premium_rate LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}

}