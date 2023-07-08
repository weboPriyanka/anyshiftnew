<!doctype html>
<html lang="en-US">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Facility Invoice Details</title>
    <meta name="description" content="Facility Invoice Details">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>
<style>

body {
    font-family: "Open Sans", sans-serif;
    font-size: 14px;
    color: #888;
    font-weight: 400;
    background: #f4f7fa;
    position: relative;
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
}
.card .card-block, .card .card-body {
    padding: 30px 25px;
}
.invoive-info {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 30px;
}
.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.col-md-4 {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
}
.col-sm-12 {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
}
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}
h6 {
    font-size: 14px;
}
</style>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!-- [ Invoice ] start -->
                                <div class="container" id="printTable">
                                    <div>
                                        <div class="card">
                                            
                                            <div class="card-block">
                                                <div class="row invoive-info">
												    <?php $total =0;  if(!empty(@$FacilityDetails)){ ?>
												    <div class="col-md-4 col-xs-12 invoice-client-info">
                                                        <h6 class="m-0 m-t-10">Facility Information :</h6>
                                                        <h6 class="m-0"><?php echo $FacilityDetails['fo_fname'].'&nbsp;'.$FacilityDetails['fo_lname'];?></h6>
                                                        <p class="m-0">Mobile No. : <?php echo $FacilityDetails['fo_mobile'];?></p>
                                                    </div>
													<?php  } if(!empty(@$TransactionDetails)&&$TransactionDetails['ad_type']=='admin'){ ?>
												    <div class="col-md-4 col-xs-12 invoice-client-info">
                                                        <h6 class="m-0 m-t-10">Fund transfered From Admin :</h6>
                                                        <p class="m-0">Amount : <?php echo $TransactionDetails['fwt_amount'];?></p>
                                                    </div>
												    <?php  } if(!empty($JobDetails)&&$TransactionDetails['ad_type']!='admin'){?>
                                                    <div class="col-md-4 col-xs-12 invoice-client-info">
                                                        <h6>Shift Manager Information :</h6>
                                                        <h6 class="m-0 m-t-10"><?php echo $JobDetails['sm_fname'].'&nbsp;'.$JobDetails['sm_lname'];?></h6>
                                                        <p class="m-0">Category : <?php echo $JobDetails['fc_name'];?></p>
														<p class="m-0">Nurse Category : <?php echo $JobDetails['nc_name'];?></p>
                                                        <p class="m-0"><?php echo $JobDetails['sm_mobile'];?></p>
                                                    </div>
													
                                                    <div class="col-md-4 col-sm-6">
                                                        <h6>Job Information :</h6>
                                                        <table class="table table-responsive invoice-table invoice-order table-borderless">
                                                            <tbody>
															    <tr>
                                                                    <th>Job Title :</th>
                                                                    <td><?php echo $JobDetails['job_title'];?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Start Date :</th>
                                                                    <td><?php echo date('Y-m-d H:i A',strtotime($JobDetails['start_date']));?></td>
                                                                </tr>
																<tr>
                                                                    <th>End Date :</th>
                                                                    <td><?php echo date('Y-m-d H:i A',strtotime($JobDetails['end_date']));?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Status :</th>
                                                                    <td>
                                                                        <span class="label label-warning"><?php echo $JobDetails['status'];?></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Id :</th>
                                                                    <td>
                                                                        #<?php echo $JobDetails['id'];?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
													<?php } ?>
                                                    <!--<div class="col-md-4 col-sm-6">
                                                        <h6 class="text-uppercase text-primary">Total Due :
                                                            <span><?php echo $TransactionDetails['fwt_amount']; ?></span>
                                                        </h6>
                                                    </div>-->
                                                </div>
												<?php if(!empty($NurseDetails)){?>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive">
                                                            <table class="table  invoice-detail-table">
                                                                <thead>
                                                                    <tr class="thead-default">
                                                                        <th>Nurse Name</th>
                                                                        <th>Mobile</th>
																		<th>Work Date</th>
                                                                        <th>Total Hours</th>
																		<th>Total Earnings	</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
																    <?php 
																	$i=0;foreach($NurseDetails as $row){?>
                                                                    <tr>
                                                                        <td>
                                                                            <h6><?php echo $row['cg_fname'].'&nbsp;'.$row['cg_lname'];?></h6>
                                                                        </td>
                                                                        <td><?php echo $row['cg_mobile'];?></td>
                                                                        <td><?php echo date('Y-m-d H:i A',strtotime($NurseEarnings[$i]['work_date']));?></td>
																		<td><?php echo $NurseEarnings[$i]['total_hours'];?></td>
                                                                        <td><?php echo number_format($NurseEarnings[$i]['total_earnings'],2);?></td>
                                                                    </tr>
																	<?php 
																	$total = $total + $NurseEarnings[$i]['total_earnings'];$i++;
																	} ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
												<?php  } if(!empty(@$TransactionDetails)&&$TransactionDetails['ad_type']=='admin'){ ?>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive">
                                                            <table class="table invoice-detail-table">
                                                                <thead>
                                                                    <tr class="thead-default">
                                                                        
                                                                        <th>From	</th>
																		<th>Type</th>
                                                                        <th>Status</th>
																		<th>Transfer Date</th>
																		<th>Amount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        
                                                                        <td><?php echo $TransactionDetails['ad_type'];?></td>
																		<td><?php echo $TransactionDetails['fwt_type'];?></td>
																		<td><?php echo $TransactionDetails['status'];?></td>
                                                                        <td><?php echo date('Y-m-d H:i A',strtotime($TransactionDetails['added_on']));?></td>
																		<td><h6><?php echo $TransactionDetails['fwt_amount'];?></h6></td>
																	</tr>
																	<?php 
																	$total = $total + $TransactionDetails['fwt_amount'];
																	 ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                
												<?php }?>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-responsive invoice-table invoice-total">
                                                            <tbody>
                                                                <tr class="text-info">
                                                                    <td>
                                                                        <hr />
                                                                        <h5 class="text-primary m-r-10">Total :</h5>
                                                                    </td>
                                                                    <td>
                                                                        <hr />
                                                                        <h5 class="text-primary"><?php echo number_format($total,2);?> </h5>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
												
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ Invoice ] end -->
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
    <!--/100% body table-->
</body>

</html>