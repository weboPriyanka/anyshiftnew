<?php
                
defined('BASEPATH') or exit('No direct script access allowed');

                
class Rudra_care_giver_rudra_model extends CI_Model
                
{
                   
                    
	public function __construct()
                    
	{
                    
		parent::__construct();
                
                    $this->bdp = $this->db->dbprefix;
                    $this->full_table = 'rudra_care_giver';
                        
                    }
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name)
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT TBL.id, concat(TBL.cg_fname,' ',TBL.cg_lname) as cg_name, TBL.cg_mobile, TBL.cg_fcm_token, TBL.cg_device_token, TBL.cg_profile_pic, TBL.cg_lat, TBL.cg_long, TBL.cg_address, TBL.cg_zipcode, TBL.status, TBL.hours_completed, TBL.total_earned, TBL.average_rating, TBL.added_on" ;
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
		$where .=  " AND (  TBL.cg_fname LIKE '%".$filter_data['searchBy']."%'";
		$where .=  " OR TBL.cg_lname LIKE '%".$filter_data['searchBy']."%'";
		$where .=  " OR TBL.cg_mobile LIKE '%".$filter_data['searchBy']."%' )";
		
	}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_fname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_lname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_mobile LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.cg_fcm_token LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.cg_device_token LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.cg_profile_pic LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.cg_lat LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.cg_long LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_address LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_zipcode LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.hours_completed LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.total_earned LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.average_rating LIKE '%".$filter_data['general_search']."%'";
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
		$where .=  " AND (  TBL.cg_fname LIKE '%".$filter_data['searchBy']."%'";
		$where .=  " OR TBL.cg_lname LIKE '%".$filter_data['searchBy']."%'";
		$where .=  " OR TBL.cg_mobile LIKE '%".$filter_data['searchBy']."%' )";
		
	}
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_fname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_lname LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_mobile LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.cg_fcm_token LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.cg_device_token LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.cg_profile_pic LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.cg_lat LIKE '%".$filter_data['general_search']."%'";
	//$where .=  "  OR  TBL.cg_long LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_address LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cg_zipcode LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.hours_completed LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.total_earned LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.average_rating LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}

}