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
								<div class="col-md-12 col-xl-3">
                                    <div class="card user-card">
                                        <div class="card-block">
                                            <h5 class="m-b-15">Nurses</h5>
                                            <h4 class="f-w-300 mb-3"><a href="<?php echo site_url('care-giver');?>" title="Nurse Listing"><?php echo (isset($nurses['counts']))?$nurses['counts']:0;?></a></h4>
                                            <!--<span class="text-muted"><label class="label theme-bg text-white f-12 f-w-400">20%</label>Monthly Increase</span>-->
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-12 col-xl-3">
                                    <div class="card user-card">
                                        <div class="card-block">
                                            <h5 class="m-b-15">Jobs</h5>
                                            <h4 class="f-w-300 mb-3"><a href="<?php echo site_url('jobs');?>" title="Jobs Listing"><?php echo (isset($jobs['counts']))?$jobs['counts']:0;?></a></h4>
                                            <!--<span class="text-muted"><label class="label theme-bg text-white f-12 f-w-400">20%</label>Monthly Increase</span>-->
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-12 col-xl-3">
                                    <div class="card user-card">
                                        <div class="card-block">
                                            <h5 class="m-b-15">Facilities</h5>
                                            <h4 class="f-w-300 mb-3"><a href="<?php echo site_url('facility-owner');?>" title="Facility Owner Listing"><?php echo (isset($facility['counts']))?$facility['counts']:0;?></a></h4>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-12 col-xl-3">
                                    <div class="card user-card">
                                        <div class="card-block">
                                            <h5 class="m-b-15">Shift Managers</h5>
                                            <h4 class="f-w-300 mb-3"><a href="<?php echo site_url('shift-manager');?>" title="Shift Managers Listing"><?php echo (isset($shift_managers['counts']))?$shift_managers['counts']:0;?></a></h4>
                                        </div>
                                    </div>
                                </div>
								</div>
								<div class="row">
								<div class="col-md-12 col-xl-6">
                                    <div class="card code-table" style="min-height: 500px;">
                                        <div class="card-header">
                                            <h5>Recent Nurses</h5>
                                            
                                        </div>
                                        <div class="card-block pb-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Mobile</th>
                                                            <th>Pic</th>
															<th>Address</th>
															<th>Zipcode</th>
															<th>Status</th>
                                                    </tr></thead>
                                                    <tbody>
													    <?php if(!empty($nurseDetails)){
														foreach($nurseDetails as $nurse){?>
                                                        <tr>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo $nurse['cg_fname'].'&nbsp;'.$nurse['cg_lname'];?></h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo $nurse['cg_mobile'];?></h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="m-b-0"><?php $img = (!empty($nurse['cg_profile_pic']))?$nurse['cg_profile_pic']:base_url('app_assets/images/user/avatar-2.jpg');?>
																<img class="rounded-circle" style="width:40px;" src="<?php echo $img;?>" alt="<?php echo $nurse['cg_fname'].'&nbsp;'.$nurse['cg_lname'];?>"></h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="m-b-0"><?php echo $nurse['cg_address'];?></h6>
                                                            </td>
															<td>
                                                                <h6 class="m-b-0"><?php echo $nurse['cg_zipcode'];?></h6>
                                                            </td>
															<td>
                                                                <h6 class="m-b-0"><a href="javascript:void(0)" style="cursor:default" class="label <?php echo ($nurse['status']=='Active')?'theme-bg':'theme-bg2';?> f-12 text-white"><?php echo $nurse['status'];?></a></h6>
                                                            </td>
                                                        </tr>
														<?php }}else{?>
														<tr>
														<td colspan="6"><h6 class="mb-1 " style="text-align: center;">No Nurses</h6> </td>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
    
	<div class="col-md-12 col-xl-6">
                                    <div class="card code-table" style="min-height: 500px;">
                                        <div class="card-header">
                                            <h5>Recent Jobs</h5>
                                            
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
            
			</div>
			<div class="row">
			<div class="col-md-12 col-xl-6">
                                    <div class="card code-table" style="min-height: 500px;">
                                        <div class="card-header">
                                            <h5>Recent Facilities</h5>
                                            
                                        </div>
                                        <div class="card-block pb-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Mobile</th>
															<th>Status</th>
                                                    </tr></thead>
                                                    <tbody>
													    <?php if(!empty($facilityDetails)){
														foreach($facilityDetails as $facility){?>
                                                        <tr>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo $facility['fo_fname'].'&nbsp;'.$facility['fo_lname'];?></h6>
                                                            </td>
                                                            <td>
                                                                <h6 class="mb-1"><?php echo $facility['fo_mobile'];?></h6>
                                                            </td>
															<td>
                                                                <h6 class="m-b-0"><a href="javascript:void(0)" style="cursor:default" class="label <?php echo ($facility['status']=='Active')?'theme-bg':'theme-bg2';?> f-12 text-white"><?php echo $facility['status'];?></a></h6>
                                                            </td>
                                                        </tr>
														<?php }}else{?>
														<tr>
														<td colspan="3"><h6 class="mb-1 " style="text-align: center;">No Facilities</h6> </td>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
			<div class="col-md-12 col-xl-6">
                                    <div class="card code-table" style="min-height: 500px;">
                                        <div class="card-header">
                                            <h5>Recent Shift Managers</h5>
                                            
                                        </div>
                                        <div class="card-block pb-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
														   <th>Facility Name</th>
                                                            <th>Shift Manager Name</th>
                                                            <th>Mobile</th>
															<th>Status</th>
                                                    </tr></thead>
                                                    <tbody>
													    <?php if(!empty($smDetails)){
														foreach($smDetails as $shifts){?>
                                                        <tr>
														    <td>
                                                                <h6 class="mb-1"><?php echo $shifts['fo_fname'].'&nbsp;'.$shifts['fo_lname'];?></h6>
                                                            </td>
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
														<td colspan="4"><h6 class="mb-1 " style="text-align: center;">No Shift Managers</h6> </td>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
         </div>   
	</div>
    </section>
<style>
    .datepicker>.datepicker-days {
        display: block !important;
    }
</style>