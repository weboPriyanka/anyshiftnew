<?php
                
defined('BASEPATH') or exit('No direct script access allowed');

                
class Rudra_menu_rudra_model extends CI_Model
                
{
                   
                    
	public function __construct()
                    
	{
                    
		parent::__construct();
                
                    $this->bdp = $this->db->dbprefix;
                    $this->full_table = 'rudra_menu';
                        
                    }
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name)
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT TBL.id, TBL.fc_id, TBL.mn_name, TBL.mn_controller, TBL.mn_method, TBL.mn_params, TBL.mn_status, TBL.mn_icon" ;
	$query .= "  FROM $table "; 
	$where = " WHERE 1 = 1 ";
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_name LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_controller LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_method LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_params LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_status LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_icon LIKE '%".$filter_data['general_search']."%'";
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
	$query = " SELECT COUNT(id) as cntrows" ;
	$query .= "  FROM $table "; 
	$where = " WHERE 1 = 1 ";
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_name LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_controller LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_method LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_params LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_status LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.mn_icon LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}

}