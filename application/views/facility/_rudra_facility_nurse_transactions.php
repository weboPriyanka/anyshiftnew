<?php $mainMenu = $this->uri->segment(1); ?>

<link rel="stylesheet" href="<?= base_url('app_') ?>assets/plugins/data-tables/css/datatables.min.css" /> <link rel="stylesheet" href="<?= base_url('app_') ?>assets/css/style.css" />
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
			  <form id="filter" name="filter"> 
                <div class="card text-left">
                    <div class="card-body">
					   <div class="row">
					    <div class="form-group col-sm-3 ">
                            <input type="hidden" name="cg_id" id="cg_id" class="form-control cg_id"  >
							<input type="text" name="searchBy" id="searchBy" onkeyup="keyPressed(this.value)" class="form-control searchBy"  placeholder="Care Giver Name">
                            <div class="suggetions_listings" style="display:none;">
                               <ul class="list-group">
										<li class="list-group-item">No Nurse Found</li>
								</ul>
                        </div>
						</div>
						<div class="form-group col-sm-3 ">
                            <input type="hidden" name="job_id" id="job_id" class="form-control job_id"  >
							<input type="text" name="searchBy2" id="searchBy2" onkeyup="keyPressed2(this.value)" class="form-control searchBy2"  placeholder="Job Title">
                            <div class="suggetions_listings2" style="display:none;">
                               <ul class="list-group">
										<li class="list-group-item">No Job Found</li>
								</ul>
                        </div>
						</div>
                        <div class="form-group col-sm-3 ">
                            <div class="input-daterange input-group " id="datepicker_range">
                                <input type="text" class="form-control text-left" placeholder="Start date" id="start_date_stat"  name="start">
                                <input type="text" class="form-control text-right" placeholder="End date" id="end_date_stat"  name="end">
                            </div>
                        </div>
						<div class="form-group col-sm-3 ">
                            <button type="submit"  type="button" class="btn btn-glow-success btn-info" title="" data-toggle="tooltip" data-original-title="Filter" aria-describedby="tooltip651610">Filter</button>&nbsp;
                                
                        </div>
						</div>
                    </div>
                </div>
				</form>
            </div>
           <div class="clear-fix clearfix"></div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="<?= site_url('facility-facility-transactions') ?>" class="nav-link"><h5  class=" <?= ($mainMenu == 'facility-facility-transactions' ? 'text-bold text-uppercase' : '')  ?> "><?= $page_first_header ?></h5></a>
                        </div>
                        <div class="col-sm-4">
                            <a href="<?= site_url('facility-nurse-transactions') ?>" class="nav-link"><h5 class=" <?= ($mainMenu == 'facility-nurse-transactions' ? 'text-bold text-uppercase' : '')  ?> "><?= $page_second_header ?></h5></a>
                        </div>
                        <div class="col-sm-4 text-right">
                             <h5>Account Balance :  $<?php echo  $account_balance;?></h5>
                        </div> 
                    </div> 
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="responsive-table-modeldddd" class="display table dt-responsive nowrap table-striped table-hover user_post" style="width:100%">
                                <thead><tr>
								    <th>Id</th>
									<th>Fwt Amount</th>
									<th>Fwt Type</th>
									<th>Status</th>
									<th>Admin Name</th>
									<th>Job Title</th>
									<th>Ad Type</th>
									<th>Actions</th>
									</tr>
									 </thead>
									  </table>
									</div>
									</div>
									</div>
									</div>
									</div>
<!--- FORM Modal Ends ---->
  <div class="md-modal md-effect-11 dynamic-modal" id="form_modal_rudra_facility_transactions">
       <div class="modal-content">
           <div class="modal-header theme-bg2 ">
               <h5 class="modal-title text-white" id="heading_rudra_facility_transactions">Loading...</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <form id="frm_rudra_facility_transactions" method="post" enctype="multipart/form-data">
               <div class="modal-body" id="modal_form_data_rudra_facility_transactions"> </div>             
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" disabled class="btn btn-primary btn-modal-form">Update</button>
    </div>
</form>
</div>
</div>
<!--- FORM Modal Ends ---->
<script src="<?= base_url('app_') ?>assets/plugins/data-tables/js/datatables.min.js"></script>
<script type="text/javascript">
var load_type = '<?= $load_type ?>';
var search_json = new Object();
search_json.load_type = load_type;
$("#filter").submit(function(e) {
            e.preventDefault();
   var cg_id = $('#cg_id').val();
   var job_id = $('#job_id').val();
   var searchByCare = $('#searchBy').val();
   var searchByJob = $('#searchBy2').val();
   if(searchByCare==''){
	   $('#cg_id').val('');
   }if(searchByJob==''){
	   $('#job_id').val('');
   }
   
   var start_date = $('#start_date_stat').val();
    var end_date = $('#end_date_stat').val();
    $('.user_post').DataTable().destroy();
    fill_server_data_table(search_json,cg_id, searchByCare,job_id,searchByJob,start_date,end_date);
  });
 $.fn.dataTable.ext.errMode = 'throw';
var usrTable;
fill_server_data_table(search_json);
function fill_server_data_table(search_json,cg_id ='',searchByCare = '',job_id ='',searchByJob = '',start_date = '', end_date = '') {
	usrTable = $('.user_post').DataTable({
"processing": true,
"serverSide": true,
 fixedHeader: true,
responsive: true,
"ajax": {
	"url": "<?php echo base_url('facility-facility-nurse-transactions/list') ?>",
	"dataType": "json",
	"type": "POST",
	"data": {
	'searchByCare': searchByCare,
	'searchByJob': searchByJob,
		'cg_id': cg_id,
		'job_id': job_id,
	search_json: search_json,
	 start_date: start_date,
	end_date:end_date,
  }
 },	 "columns": [
 {
		 "data": "id"
 },
{
		 "data": "fwt_amount"
 },
{
		 "data": "fwt_type"
 },
{
		 "data": "status"
 },
{
		 "data": "name"
 },
 {
		 "data": "job_title"
 },
{
		 "data": "ad_type"
 },
	 {
		 "data": "actions"
},
 ],
 "columnDefs": [{
 targets: "_all",
 orderable: true
 }]
  });
 }
</script>
<!-- Form Scripts Starts Here -->
<script type='text/javascript'>
function static_form_modal(data_url, action_url, mtype, heading) {
            $("#form_modal_rudra_facility_transactions").modal();
            $("#form_modal_rudra_facility_transactions").addClass('md-show');
            $("#heading_rudra_facility_transactions").text(heading);
            $("#frm_rudra_facility_transactions").attr("action", '<?= base_url() ?>' + action_url);
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>' + data_url,
                data: {},
                success: function(data) {
                    response = JSON.parse(data);
                    if (response.status) {
                        jsonData = JSON.parse(JSON.stringify(response.data));
                        //console.log(jsonData);
                        $("#modal_form_data_rudra_facility_transactions").html(jsonData.form_data);
                        $(".btn-modal-form").prop("disabled", false);
                    } else {
                        $(".btnlogin").prop('disabled', false);
                        $(".btnlogin").addClass('btn-success');
                        $(".btnlogin").removeClass('btn-warning');
                        $(".btnlogin").html('Login');
                    }
                }
            });
        }

$("#frm_rudra_facility_transactions").submit(function(e) {
            e.preventDefault();
            $(".btn-modal-form").prop('disabled', true);
            $(".btn-modal-form").html('Wait...');
            var formData = new FormData($("#frm_rudra_facility_transactions")[0]);
            var action_url = $("#frm_rudra_facility_transactions").attr("action");
            $.ajax({
                type: 'POST',
                url: action_url,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    response = JSON.parse(data);
                    if (response.text) {
                        loadTextData();
                        $(".btn-modal-form").prop('disabled', false);
                        $(".btn-modal-form").html('Update');
                        $('.dynamic-modal').modal('hide');
                        $("#static_form_modal").modal('hide');
                        //setTimeout(function(){ window.location = response.data.url; }, 3000);
                    } else if (response.status) {
                        $(".btn-modal-form").prop('disabled', false);
                        $(".btn-modal-form").html('Update');
                        usrTable.ajax.reload(null, false);
                        $('.dynamic-modal').modal('hide');
                        //setTimeout(function(){ window.location = response.data.url; }, 3000);
                    } else {
                        $(".btn-modal-form").prop('disabled', false);
                        $(".btn-modal-form").html('Update');
                    }
    
                }
            });
        });
	function keyPressed(cg_id){
			let formData = new FormData();
			formData.append('searchBy', cg_id);
            $.ajax({
                url: '<?php echo site_url('facility-facility-transactions/searchByNurse') ?>',
                method: 'POST',
				data: formData,
				contentType:false,
				cache : false,
				processData : false,async:true,
                success: function(response){
					$('#cg_id').val('');
					$(".suggetions_listings").show();
					if(response.status == 'success') {
						
						$(".suggetions_listings").html(response.message);
                    }else 
					{   
						$(".suggetions_listings").hide();
					}
					 
                  
                },error: function(response) { 
				console.log(response);
				//$(".zip_error").show(); 
				}
    });}
    function foShow(id,nurse_name){ 
	$(".searchBy").val(nurse_name);
	$("#cg_id").val(id);
	$(".suggetions_listings").hide();
	
}
function keyPressed2(job_id){
			let formData = new FormData();
			formData.append('searchBy2', job_id);
            $.ajax({
                url: '<?php echo site_url('facility-facility-transactions/searchbyjob') ?>',
                method: 'POST',
				data: formData,
				contentType:false,
				cache : false,
				processData : false,async:true,
                success: function(response){
					$('#job_id').val('');
					$(".suggetions_listings2").show();
					if(response.status == 'success') {
						
						$(".suggetions_listings2").html(response.message);
                    }else 
					{   
						$(".suggetions_listings2").hide();
					}
					 
                  
                },error: function(response) { 
				console.log(response);
				//$(".zip_error").show(); 
				}
    });}
    function jobShow(id,job_title){ 
	$(".searchBy2").val(job_title);
	$("#job_id").val(id);
	$(".suggetions_listings2").hide();
	
}
</script>