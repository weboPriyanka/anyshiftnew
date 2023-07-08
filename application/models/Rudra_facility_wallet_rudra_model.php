<?php                
defined('BASEPATH') or exit('No direct script access allowed');                
class Rudra_facility_wallet_rudra_model extends CI_Model                
{                                    
	public function __construct()                    
	{              
		parent::__construct();
        $this->bdp = $this->db->dbprefix;
        $this->full_table = 'rudra_facility_wallet';
    }
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name,$leftJoin)
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT TBL.id, TBL.fo_id,concat(rudra_facility_owner.fo_fname,' ',rudra_facility_owner.fo_lname) as fo_name, TBL.fw_total_credit, TBL.fw_used, TBL.fw_balance, TBL.status, TBL.added_on" ;
	$query .= "  FROM $table   ";
	if(!empty($leftJoin)){
			$query .= "LEFT JOIN  rudra_facility_owner
	ON TBL.fo_id =  rudra_facility_owner.id";
	}	
	$where = " WHERE 1 = 1 ";
	if(!empty($filter_data['id']))
	{
		$where.=" AND TBL.id=".$filter_data['id'];
	}
	if(!empty($filter_data['fo_id']))
	{
		$where.=" AND TBL.fo_id IN(".$filter_data['fo_id'].")";
	}
	if(!empty($filter_data['start_date'])&&!empty($filter_data['end_date']))
	{
	$where .= " AND (TBL.added_on BETWEEN '".date('Y-m-d H:i:s',strtotime($filter_data['start_date']))."' AND '".date('Y-m-d H:i:s',strtotime($filter_data['end_date']))."')";
	}
	$where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fw_total_credit LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fw_used LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fw_balance LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	if(!empty($leftJoin)){
	$where .=  "  OR  rudra_facility_owner.fo_fname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  rudra_facility_owner.fo_lname LIKE '%".$filter_data['general_search']."%'";
	}
	 $where .= " ) ";
	$order_by = ($order == '' ? '' : ' ORDER BY '.$order." ".$dir);
	 $limit = " LIMIT ".$start." , " .$limit;
	$query = $query.$where.$order_by.$limit;
	 $res = $this->db->query($query)->result();
	 return $res;
	}


	public function count_table_data($filter_data,$table_name,$leftJoin)
		{
		$table = $this->full_table .' TBL';
	$query = " SELECT COUNT(TBL.id) as cntrows" ;
	$query .= "  FROM $table   "; 
	if(!empty($leftJoin)){
			$query .= "LEFT JOIN  rudra_facility_owner
	ON TBL.fo_id =  rudra_facility_owner.id";
	}
	$where = " WHERE 1 = 1 ";
	if(!empty($filter_data['id']))
	{
		$where.=" AND TBL.id=".$filter_data['id'];
	}
	if(!empty($filter_data['fo_id']))
	{
		$where.=" AND TBL.fo_id IN(".$filter_data['fo_id'].")";
	}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fw_total_credit LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fw_used LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fw_balance LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  rudra_facility_owner.fo_fname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  rudra_facility_owner.fo_lname LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}

}