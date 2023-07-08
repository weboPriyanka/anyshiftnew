<?php
                
defined('BASEPATH') or exit('No direct script access allowed');

                
class Rudra_videos_rudra_model extends CI_Model
                
{
                   
                    
	public function __construct()
                    
	{
                    
		parent::__construct();
                
                    $this->bdp = $this->db->dbprefix;
                    $this->full_table = 'rudra_videos';
                        
                    }
	public function get_table_data($limit,$start,$order,$dir,$filter_data,$tbl_data,$table_name,$leftJoin1)
	{
		$table = $this->full_table .' TBL';
	$query = " SELECT TBL.id, rudra_video_category.cat_name, rudra_video_subcategory.subcat_name, TBL.video_url, TBL.status, TBL.image_url, TBL.title, TBL.description" ;
	$query .= "  FROM $table   "; 
	if(!empty($leftJoin1)){
			$query .= " LEFT JOIN rudra_video_category
	ON TBL.cat_id = rudra_video_category.id";
	$query .= " LEFT JOIN rudra_video_subcategory
	ON TBL.subcat_id = rudra_video_subcategory.id";
		}
	$where = " WHERE 1 = 1 ";
	 $where .= " AND ( ";
	$where .=  "  TBL.id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.cat_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.subcat_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.video_url LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.title LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.description LIKE '%".$filter_data['general_search']."%'";
	if(!empty($leftJoin1)){
		$where .=  "  OR  rudra_video_category.cat_name LIKE '%".$filter_data['general_search']."%'";
		$where .=  "  OR  rudra_video_subcategory.subcat_name LIKE '%".$filter_data['general_search']."%'";
			
		}
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
	$where .=  "  OR  TBL.cat_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.subcat_id LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.video_url LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.status LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.title LIKE '%".$filter_data['general_search']."%'";
	$where .=  "  OR  TBL.description LIKE '%".$filter_data['general_search']."%'";
	 $where .= " ) ";
	$query = $query.$where;
	 $res = $this->db->query($query)->row();
	 return $res->cntrows;
		}

}