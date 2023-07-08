<!-- [ Main Content ] start -->
<div class="row" style="display:none;">
    <!-- [Total-user section] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body" style="padding:10px;">
                <div class="col-sm-9" style="clear:right;float:left">
                    <button id="btn0" type="button" class="btn btn-info load_ajax_data" data-value="0">All</button>
                    <button id="btn1" type="button" class="btn btn-warning load_ajax_data" data-value="1">Today</button>
                    <button id="btn2" type="button" class="btn btn-warning load_ajax_data" data-value="2">Yesterday</button>
                    <button id="btn3" type="button" class="btn btn-warning load_ajax_data" data-value="3">This Week</button>
                    <button id="btn4" type="button" class="btn btn-warning load_ajax_data" data-value="4">Last Week</button>
                    <button id="btn5" type="button" class="btn btn-warning load_ajax_data" data-value="5">This Month</button>
                    <button id="btn6" type="button" class="btn btn-warning load_ajax_data" data-value="6">Last Month</button>
                </div>
                <div class="col-sm-3" style="float:right">
                    <div class="input-daterange input-group " id="datepicker_range">
                        <input type="text" class="form-control text-left" placeholder="Start date" id="start_date_stat" name="start">
                        <input type="text" class="form-control text-right" placeholder="End date" id="end_date_stat" name="end">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<div class="clear-fix clearfix"></div>
    <section id="divUsersStats">
    <div class="row">
    <!-- [Total-user section] start -->
								<div class="col-md-12 col-xl-4">
                                    <div class="card user-card">
                                        <div class="card-block">
                                            <h5 class="m-b-15">Balance</h5>

                                            <h4 class="f-w-300 mb-3"><a href="<?php echo site_url('facility-facility-transactions');?>">$<?php echo (isset($payment['fw_balance']))?$payment['fw_balance']:0;?></a></h4>
                                        </div>
                                    </div>
                                </div>
								<?php  $balance =  $payment['fw_balance'];
								        $debit  = $payment['fw_used'];
										$credit  = $payment['fw_total_credit'];
										$percentage = round((($credit-$debit)/$credit)*100);
										if($percentage>=60){
											$color = "green";
										}elseif($percentage<60&&$percentage>=50){
											$color = "orange";
										}else {
											$color = "red";
										}
										
								?>
								
								
								<div class="col-md-12 col-xl-4">
                                    <div class="card user-card">
                                        <div class="card-block">
                                            <h5 class="m-b-15">Total Payment</h5>
                                            <h4 class="f-w-300 mb-3"><a href="<?php echo site_url('facility-facility-transactions');?>">$<?php echo (isset($payment['fw_used']))?$payment['fw_used']:0;?></a></h4>
                                            <!--<span class="text-muted"><label class="label theme-bg text-white f-12 f-w-400">20%</label>Monthly Increase</span>-->
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-12 col-xl-4">
	                     
                                    <div class="card user-card">
                                        <div class="card-block">
                                            <h5 class="m-b-15">Shift Managers</h5>
                                            <h4 class="f-w-300 mb-3"><a href="<?php echo site_url('facility-shift-manager');?>"><?php echo (isset($shift_managers['counts']))?$shift_managers['counts']:0;?></a></h4>
                                            <!--<span class="text-muted"><label class="label theme-bg text-white f-12 f-w-400">20%</label>Monthly Increase</span>-->
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-12 col-xl-4">
                                    <div class="card user-card">
                                        <div class="card-block">
                                            <h5 class="m-b-15">Active Jobs</h5>
                                            <h4 class="f-w-300 mb-3"><a href="<?php echo site_url('facility-jobs');?>"><?php echo (isset($jobs['counts']))?$jobs['counts']:0;?></a></h4>
                                            <!--<span class="text-muted"><label class="label theme-bg text-white f-12 f-w-400">20%</label>Monthly Increase</span>-->
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-12 col-xl-4">
                                    <div class="card user-card">
                                        <div class="card-block">
                                            <h5 class="m-b-15">Pending Jobs</h5>
                                            <h4 class="f-w-300 mb-3"><a href="<?php echo site_url('facility-jobs');?>"><?php echo (isset($Pendingjobs['counts']))?$Pendingjobs['counts']:0;?></a></h4>
                                            <!--<span class="text-muted"><label class="label theme-bg text-white f-12 f-w-400">20%</label>Monthly Increase</span>-->
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-12 col-xl-4">
                                    <div class="card user-card">
                                        <div class="card-block">
                                            <h5 class="m-b-15">Published Jobs</h5>
                                            <h4 class="f-w-300 mb-3"><a href="<?php echo site_url('facility-jobs');?>"><?php echo (isset($Publishedjobs['counts']))?$Publishedjobs['counts']:0;?></a></h4>
                                            <!--<span class="text-muted"><label class="label theme-bg text-white f-12 f-w-400">20%</label>Monthly Increase</span>-->
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-12 col-xl-6">
                                    <div class="card code-table">
                                        <div class="card-header">
                                            <h5>Active Jobs</h5>
                                            
                                        </div>
                                        <div class="card-block pb-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Category</th>
                                                            <th>Shift</th>
															<th>Hours</th>
															<th>Start Date</th>
															<th>End Date</th>
															<th>Rate</th>
															<th>Status</th>
                                                    </tr></thead>
                                                    <tbody>
													    <?php if(!empty($jobDetails)){
														foreach($jobDetails as $job){?>
                                                        <tr>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo $job['job_title'];?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo $job['fc_name'];?></h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo ucwords($job['shift_type']);?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo $job['job_hours'];?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo date('Y-m-d', strtotime($job['start_date']));?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo date('Y-m-d', strtotime($job['end_date']));?></h6>
                                                            </td>
                                                            
                                                            <td>
                                                                <h6 class="m-b-0"><?php echo ($job['is_premium']=='yes')?'Premium Rate&nbsp;:'.$job['job_prem_rate']:'Rate :&nbsp;'.$job['job_rate'];
																?></h6>
                                                            </td>
															<td>
                                                                <h6 class="m-b-0"><a href="javascript:void(0)" style="cursor:default" class="label <?php echo ($job['status']=='Active')?'theme-bg':'theme-bg2';?> f-12 text-white"><?php echo $job['status'];?></a></h6>
                                                            </td>
                                                        </tr>
														<?php }}else{?>
														<tr>
														<td colspan="8"><h6 class="mb-1 " style="text-align: center;">No Jobs</h6> </td>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
	                            <div class="col-md-12 col-xl-6">
                                    <div class="card code-table">
                                        <div class="card-header">
                                            <h5>Pending Jobs</h5>
                                            
                                        </div>
                                        <div class="card-block pb-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Category</th>
                                                            <th>Shift</th>
															<th>Hours</th>
															<th>Start Date</th>
															<th>End Date</th>
															<th>Rate</th>
															<th>Status</th>
                                                    </tr></thead>
                                                    <tbody>
													    <?php if(!empty($PendingjobDetails)){
														foreach($PendingjobDetails as $job){?>
                                                        <tr>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo $job['job_title'];?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo $job['fc_name'];?></h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo ucwords($job['shift_type']);?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo $job['job_hours'];?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo date('Y-m-d', strtotime($job['start_date']));?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo date('Y-m-d', strtotime($job['end_date']));?></h6>
                                                            </td>
                                                            
                                                            <td>
                                                                <h6 class="m-b-0"><?php echo ($job['is_premium']=='yes')?'Premium Rate&nbsp;:'.$job['job_prem_rate']:'Rate :&nbsp;'.$job['job_rate'];
																?></h6>
                                                            </td>
															<td>
                                                                <h6 class="m-b-0"><a href="javascript:void(0)" style="cursor:default" class="label <?php echo ($job['status']=='Active')?'theme-bg':'theme-bg2';?> f-12 text-white"><?php echo $job['status'];?></a></h6>
                                                            </td>
                                                        </tr>
														<?php }}else{?>
														<tr>
														<td colspan="8"><h6 class="mb-1 " style="text-align: center;">No Jobs</h6> </td>
                                                        </tr>
														<?php } ?>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
   
                                <div class="col-md-12 col-xl-6">
                                    <div class="card code-table">
                                        <div class="card-header">
                                            <h5>Published Jobs</h5>
                                            
                                        </div>
                                        <div class="card-block pb-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Category</th>
                                                            <th>Shift</th>
															<th>Hours</th>
															<th>Start Date</th>
															<th>End Date</th>
															<th>Rate</th>
															<th>Status</th>
                                                    </tr></thead>
                                                    <tbody>
													    <?php if(!empty($PublishedjobDetails)){
														foreach($PublishedjobDetails as $job){?>
                                                        <tr>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo $job['job_title'];?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo $job['fc_name'];?></h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo ucwords($job['shift_type']);?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo $job['job_hours'];?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo date('Y-m-d', strtotime($job['start_date']));?></h6>
                                                            </td>
															<td>
                                                                <h6 class="mb-1"><?php echo date('Y-m-d', strtotime($job['end_date']));?></h6>
                                                            </td>
                                                            
                                                            <td>
                                                                <h6 class="m-b-0"><?php echo ($job['is_premium']=='yes')?'Premium Rate&nbsp;: $'.$job['job_prem_rate']:'Rate :&nbsp; $'.$job['job_rate'];
																?></h6>
                                                            </td>
															<td>
                                                                <h6 class="m-b-0"><a href="javascript:void(0)" style="cursor:default" class="label <?php echo ($job['status']=='Active')?'theme-bg':'theme-bg2';?> f-12 text-white"><?php echo $job['status'];?></a></h6>
                                                            </td>
                                                        </tr>
														<?php }}else{?>
														<tr>
														<td colspan="8"><h6 class="mb-1 " style="text-align: center;">No Jobs</h6> </td>
                                                        </tr>
														<?php } ?>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <div class="card code-table">
                                        <div class="card-header">
                                            <h5>Recent Shift Managers</h5>
                                            
                                        </div>
                                        <div class="card-block pb-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
														    <th>Shift Manager Name</th>
                                                            <th>Mobile</th>
															<th>Status</th>
                                                    </tr></thead>
                                                    <tbody>
													    <?php if(!empty($smDetails)){
														foreach($smDetails as $shifts){?>
                                                        <tr>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo $shifts['sm_fname'].'&nbsp;'.$shifts['sm_lname'];?></h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo $shifts['sm_mobile'];?></h6>
                                                            </td>
															<td>
                                                                <h6 class="m-b-0"><a href="javascript:void(0)" style="cursor:default" class="label <?php echo ($shifts['status']=='Active')?'theme-bg':'theme-bg2';?> f-12 text-white"><?php echo $shifts['status'];?></a></h6>
                                                            </td>
                                                        </tr>
														<?php }}else{?>
														<tr>
														<td colspan="3"><h6 class="mb-1 " style="text-align: center;">No Shift Managers</h6> </td>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-12 col-xl-12 col-lg-12">
                                    <div class="card-block pb-0">
											<div style="max-width: 100%; margin: auto" id="myDiv"></div>
                                    </div>
                                </div>
   </div>
    </section>
<style>
    .datepicker>.datepicker-days {
        display: block !important;
    }
	.modebar-container{display:none;}
</style>

  <script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
   
  <!-- Plotly.js -->
  <script src="https://cdn.plot.ly/plotly-2.16.1.min.js"></script>
<script> 
var data = [
  {
    domain: { x: [0, 1], y: [0, 1] },
    value: <?php echo $percentage;?>,
    title: { text: "Speed" },
    type: "indicator",
    mode: "gauge+number",
    delta: { reference: 380 },
    gauge: {
      axis: { range: [null, 100] },
      
      threshold: {
        line: { color: "<?php echo $color;?>", width: 4 },
        thickness: 1,
        value: 490
      }
    }
  }
];
var data = [
  {
    type: "indicator",
    mode: "gauge+number",
    value: <?php echo $balance;?>,
    gauge: {
      axis: { range: [null, <?php echo $credit;?>], tickwidth: 1, tickcolor: "<?php echo $color;?>" },
      bar: { color: "<?php echo $color;?>" },
      bgcolor: "white",
      borderwidth: 2,
      bordercolor: "gray",
	  
      threshold: {
        line: { color: "<?php echo $color;?>", width: 4 },
        thickness: 0.75,
        value:  <?php echo $credit;?>
      }
    }
  }
];
var layout = {
  width: '50%',
  height: '50%',
  margin: { t: 25, r: 25, l: 25, b: 25 },
  font: { color: "#111", family: "inherit",size:"14px",weight:"400" }
};

Plotly.newPlot('myDiv', data, layout);

</script>
