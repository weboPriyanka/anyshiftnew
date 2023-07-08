<?php               
defined('BASEPATH') or exit('No direct script access allowed');               
class Rudra_facility_category_rudra_model extends CI_Model                
{                                 
	public function __construct()              
	{              
		parent::__construct();
        $this->bdp = $this->db->dbprefix;
		$this->full_table = 'rudra_facility_category';
	}
	public function search($find){
		$count = 0;
		$this->db->group_start();
		$this->db->like('fc_name',$find);
		$this->db->group_end();
		$res = $this->db->get('rudra_facility_category');
		$count = $this->db->count_all_results('rudra_facility_category');	
		if ($count == 1) {
                    return $res->row_array();
            }elseif($count > 1) {
                    return $res->result_array();
            }
            return FALSE;
	}	
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name)
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT TBL.id, TBL.fc_name, TBL.status, TBL.added_on" ;
	$query .= "  FROM $table   "; 
	$where = " WHERE 1 = 1 ";
	if(!empty($filter_data['id']))
	{
		$where.=" AND TBL.id=".$filter_data['id'];
	}
	if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	if(!empty($filter_data['searchBy'])&&(empty($filter_data['id'])))
	{
		$where .=  " AND (  TBL.fc_name LIKE '%".$filter_data['searchBy']."%')";
	}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_name LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
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
	$query .= "  FROM $table   "; 
	$where = " WHERE 1 = 1 ";
	if(!empty($filter_data['id']))
	{
		$where.=" AND TBL.id=".$filter_data['id'];
	}
	if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	if(!empty($filter_data['searchBy'])&&(empty($filter_data['id'])))
	{
		$where .=  " AND (  TBL.fc_name LIKE '%".$filter_data['searchBy']."%')";
	}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_name LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}

}