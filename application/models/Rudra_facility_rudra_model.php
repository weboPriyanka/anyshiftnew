<?php
                
defined('BASEPATH') or exit('No direct script access allowed');

                
class Rudra_facility_rudra_model extends CI_Model
                
{
                   
                    
	public function __construct()
                    
	{
                    
		parent::__construct();
                
                    $this->bdp = $this->db->dbprefix;
                    $this->full_table = 'rudra_facility';
                        
                    }
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name)
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT TBL.id, TBL.fo_id, TBL.fc_name, rudra_countries.name as fc_country, rudra_states.name as fc_state, TBL.fc_city, TBL.fc_address, TBL.fc_landmark, TBL.fc_image, TBL.added_on" ;
	$query .= "  FROM $table   "; 
	$query .= " RIGHT JOIN rudra_countries
	ON TBL.fc_country = rudra_countries.id";
	$query .= " RIGHT JOIN rudra_states
	ON TBL.fc_state = rudra_states.id";
	$where = " WHERE 1 = 1 ";
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_name LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_lat LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_long LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_address LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_landmark LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_image LIKE '%".$filter_data['general_search']."%'";
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
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fo_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_name LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_lat LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_long LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_address LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_landmark LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.fc_image LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}

}