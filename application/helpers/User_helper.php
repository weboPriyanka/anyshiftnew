<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
function balance($fo_id) { 
   // get main CodeIgniter object 
	$ci = &get_instance();
	$data = 0;
	if(!empty($fo_id)){
		$wallet = $ci->db->select('*')->get_where('rudra_facility_wallet',array('fo_id'=>$fo_id))->row_array();	
		$data = $wallet['fw_balance'];
    }
	
	return $data;
} 
function wallet($amount,$fo_id,$admin_id,$wt_type,$ad_type) { 
   // get main CodeIgniter object 
	$ci = &get_instance();$wallet = '';
	$wallet = $ci->db->select('*')->get_where('rudra_facility_wallet',array('fo_id'=>$fo_id))->row_array();
	$fw_balance = $amount;
	if(!empty($amount)){
	if(empty($wallet)){
		if($wt_type=='credit'){
		$addArray = array('fo_id' => $fo_id,
							 'fw_total_credit' => $amount,
							 'fw_balance' => $amount);
        $ci->db->insert('rudra_facility_wallet',$addArray);
		}else{
			$fw_balance = 0-$amount;
			$fw_used = $amount;
			$addArray = array('fo_id' => $fo_id,
							 'fw_used' => $fw_used,
							 'fw_balance' => $fw_balance);
        $ci->db->insert('rudra_facility_wallet',$addArray);
			
		}
	}else{
		if($wt_type=='credit'){
			$fw_balance = $amount+$wallet['fw_balance'];
			$fw_total_credit = $amount+$wallet['fw_total_credit'];
			$updateArray = array('fo_id' => $fo_id,
								 'fw_total_credit' =>$fw_total_credit,
								 'fw_balance' => $fw_balance);
			$ci->db->where('id',$wallet['id']);
			$ci->db->update('rudra_facility_wallet',$updateArray);
			//echo $ci->db->last_query();
		}else{
			$fw_balance = $wallet['fw_balance']-$amount;
			$fw_used = $wallet['fw_used']+$amount;
			$updateArray = array('fo_id' => $fo_id,
								 'fw_used'=> $fw_used,
								 'fw_balance' => $fw_balance);
			$ci->db->where('id',$wallet['id']);
			$ci->db->update('rudra_facility_wallet',$updateArray);
		}
	}
	// Transaction Insert
	
					$addArray = array('fwt_amount' => $amount,
				 'fo_id' => $fo_id,
				 'fwt_type' => $wt_type,
				 'status' => 'Success',
				 'ad_id' => $admin_id,
				 'ad_type' => $ad_type);
				$ci->db->insert('rudra_facility_transactions',$addArray);
				//echo $ci->db->last_query();die;
		
	}
	return $fw_balance;
}

function getKeywordDropdown($filter = ""){

	$ci = &get_instance();

    if ($filter != ""){
        $ci->db->where(['filter' => $filter, 'status' => 'Active']);
	}else{
		$ci->db->where([ 'status' => 'Active']);
	}

    $result = $ci->db->get('rudra_keywords');

    $keywords = [];
    if ($result->num_rows() > 0) {
        
		foreach ($result->result() as $key => $wt) {
			$keywords[] = ['id' => $wt->id, 'filter' => $wt->filter, 'title' => $wt->title];
		}
        
    }

    return $keywords;

}

function getKeyword($id){

	$ci = &get_instance();

	$ci->db->where([ 'id' => $id]);

    $result = $ci->db->get('rudra_keywords');

    $data = '';
    if ($result->num_rows() > 0) {
        $wt = $result->row();
		$data = $wt->title;
        
    }

    return $data;
}

function getCountryDropdown(){

	$ci = &get_instance();

   
    $result = $ci->db->get('rudra_countries');

    $data = [];
    if ($result->num_rows() > 0) {
        
		foreach ($result->result() as $key => $wt) {
			$data[] = ['id' => $wt->id, 'name' => $wt->name];
		}
        
    }

    return $data;

}


function getStateDropdown(){

	$ci = &get_instance();

   
    $result = $ci->db->get('rudra_states');

    $keywords = [];
    if ($result->num_rows() > 0) {
        
		foreach ($result->result() as $key => $wt) {
			$keywords[] = ['id' => $wt->id, 'name' => $wt->name];
		}
        
    }

    return $keywords;

}


function getCountry($id){

	$ci = &get_instance();

	$ci->db->where([ 'id' => $id]);

    $result = $ci->db->get('rudra_countries');

    $data = '';
    if ($result->num_rows() > 0) {
        $wt = $result->row();
		$data = $wt->name;
        
    }

    return $data;
}

function getState($id){

	$ci = &get_instance();

	$ci->db->where([ 'id' => $id]);

    $result = $ci->db->get('rudra_states');

    $data = '';
    if ($result->num_rows() > 0) {
        $wt = $result->row();
		$data = $wt->name;
        
    }

    return $data;
}
