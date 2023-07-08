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
												    <?php if(!empty(@$FacilityDetails)){ ?>
												    <div class="col-md-4 col-xs-12 invoice-client-info">
                                                        <h6>Facility Information :</h6>
                                                        <h6 class="m-0"><?php echo $FacilityDetails['fo_fname'].'&nbsp;'.$FacilityDetails['fo_lname'];?></h6>
                                                        <p class="m-0 m-t-10">Mobile No. : <?php echo $FacilityDetails['fo_mobile'];?></p>
                                                    </div>
												    <?php  } if(!empty($JobDetails)){?>
                                                    <div class="col-md-4 col-xs-12 invoice-client-info">
                                                        <h6>Shift Manager Information :</h6>
                                                        <h6 class="m-0"><?php echo $JobDetails['sm_fname'].'&nbsp;'.$JobDetails['sm_lname'];?></h6>
                                                        <p class="m-0 m-t-10">Category : <?php echo $JobDetails['fc_name'];?></p>
														<p class="m-0 m-t-10">Nurse Category : <?php echo $JobDetails['nc_name'];?></p>
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
																    <?php $total =0; 
																	$i=0;foreach($NurseDetails as $row){?>
                                                                    <tr>
                                                                        <td>
                                                                            <h6><?php echo $row['cg_fname'].'&nbsp;'.$row['cg_lname'];?></h6>
                                                                        </td>
                                                                        <td><?php echo $row['cg_mobile'];?></td>
                                                                        <td><?php echo date('Y-m-d H:i A',strtotime($NurseEarnings[$i]['work_date']));?></td>
																		<td><?php echo $NurseEarnings[$i]['total_hours'];?></td>
                                                                        <td>$<?php echo number_format($NurseEarnings[$i]['total_earnings'],2);?></td>
                                                                    </tr>
																	<?php 
																	$total = $total + number_format($NurseEarnings[$i]['total_earnings'],2);$i++;
																	} ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                                        <h5 class="text-primary">$<?php echo number_format($total,2);?> </h5>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
												<div class="row text-center">
                                            <div class="col-sm-12 invoice-btn-group text-center">
                                                <button type="button" class="btn btn-primary btn-print-invoice m-b-10">Print</button>
                                                <button type="button" class="btn btn-secondary m-b-10 ">Cancel</button>
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
  <script>
    // print button
        function printData() {
            var printContents = document.getElementById("printTable").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        $('.btn-print-invoice').on('click', function() {
            printData();
        })

    </script>