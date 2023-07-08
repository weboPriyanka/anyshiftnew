<link rel="stylesheet" href="<?= base_url('app_') ?>assets/plugins/data-tables/css/datatables.min.css" /> <link rel="stylesheet" href="<?= base_url('app_') ?>assets/css/style.css" />
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [Total-user section] start -->
            <div class="col-sm-12">
			  <form id="filter" name="filter"> 
                <div class="card text-left">
                    <div class="card-body">
					   <div class="row">
					    <div class="form-group col-sm-2 ">
                            <input type="hidden" name="fo_id" id="fo_id" class="form-control fo_id"  >
							<input type="text" name="searchBy" id="searchBy" oninput="keyPressed(this.value)" onKeyUp="keyPressed(this.value)" onKeyDown="keyPressed(this.value)" onKeyPress="keyPressed(this.value)" class="form-control searchBy"  placeholder="Facility Name">
                            <div class="suggetions_listings" style="display:none;">
                               <ul class="list-group">
										<li class="list-group-item">No Facility Found</li>
								</ul>
                        </div>
						</div>
						<div class="form-group col-sm-2 ">
                            <input type="hidden" name="sm_id" id="sm_id" class="form-control sm_id"  >
							<input type="text" name="searchBy2" id="searchBy2" oninput="keyPressed2(this.value)" onkeyup="keyPressed2(this.value)"  onKeyDown="keyPressed2(this.value)" onKeyPress="keyPressed2(this.value)"class="form-control searchBy2"  placeholder="Shift Manager Name">
                            <div class="suggetions_listings2" style="display:none;">
                               <ul class="list-group">
										<li class="list-group-item">No Shift Manager Found</li>
								</ul>
                        </div>
						</div>
						<div class="form-group col-sm-2 ">
                            <input type="hidden" name="job_id" id="job_id" class="form-control job_id"  >
							<input type="text" name="searchBy3" id="searchBy3" oninput="keyPressed3(this.value)" onkeyup="keyPressed3(this.value)"  onKeyDown="keyPressed3(this.value)" onKeyPress="keyPressed3(this.value)"class="form-control searchBy3"  placeholder="Job Title">
                            <div class="suggetions_listings3" style="display:none;">
                               <ul class="list-group">
										<li class="list-group-item">No Job Found</li>
								</ul>
                        </div>
						</div>
                        <div class="form-group col-sm-4 ">
                            <div class="input-daterange input-group " id="datepicker_range">
                                <input type="text" class="form-control text-left" placeholder="Start date" id="start_date_stat"  name="start">
                                <input type="text" class="form-control text-right" placeholder="End date" id="end_date_stat"  name="end">
                            </div>
                        </div>
						<div class="form-group col-sm-2 ">
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
                        <div class="col-sm-5">
                        <h5><?= $page_header ?></h5>
                        </div>
                            <div class="col-sm-7 text-right">
                               <!-- <button onclick="static_form_modal('rudra_jobs/post_actions/get_data?id=0','rudra_jobs/post_actions/insert_data','md','Update Details')" type="button" class="btn btn-glow-success btn-info" title="" data-toggle="tooltip" data-original-title="Add New Item" aria-describedby="tooltip651610">New</button>-->&nbsp;
                                <a href="jobs/post_actions/export_data" type="button" class="btn btn-glow-danger btn-warning" title="" data-toggle="tooltip" data-original-title="Export CSV" aria-describedby="tooltip651610">CSV</a>
                            
                                </div> 
                            </div> 
                        </div>

                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="responsive-table-modeldddd" class="display table dt-responsive nowrap table-striped table-hover user_post" style="width:100%">
                                <thead><tr>
<th>Id</th>

<th>Category </th>
<th>Nurse Category</th>
<th>Facility Name</th>
<th>Shift Manager Name</th>
<th>Job Title</th>
<th>Start Date</th>
<th>End Date</th> 
<th>Created On</th> 
<th>Shift Type</th>
<th>Job Hours</th>
<th>Job Rate</th>
<th>Job Prem Rate</th>
<th>Status</th>
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
  <div class="md-modal md-effect-11 dynamic-modal" id="form_modal_rudra_jobs">
       <div class="modal-content">
           <div class="modal-header theme-bg2 ">
               <h5 class="modal-title text-white" id="heading_rudra_jobs">Loading...</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <form id="frm_rudra_jobs" method="post" enctype="multipart/form-data">
               <div class="modal-body" id="modal_form_data_rudra_jobs"> </div>
              
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
   var job_id = $('#job_id').val();
   var fo_id = $('#fo_id').val();
   var sm_id = $('#sm_id').val();
   var searchByFacility = $('#searchBy').val();
   var searchBySM = $('#searchBy2').val();
   var searchBy = $('#searchBy3').val();
   if(searchByFacility==''){
	   $('#fo_id').val('');
   }if(searchBySM==''){
	   $('#sm_id').val('');
   }if(searchBy==''){
	   $('#job_id').val('');
   }
   var start_date = $('#start_date_stat').val();
    var end_date = $('#end_date_stat').val();
    $('.user_post').DataTable().destroy();
    fill_server_data_table(search_json,job_id, searchBy,fo_id, searchByFacility,sm_id,searchBySM,start_date,end_date);
  });
 $.fn.dataTable.ext.errMode = 'throw';
var usrTable;
fill_server_data_table(search_json);
function fill_server_data_table(search_json,job_id = "",searchBy = "",fo_id ="", searchByFacility ="",sm_id ="",searchBySM ="",start_date ="",end_date = ""){
	usrTable = $('.user_post').DataTable({
"processing": true,
"serverSide": true,
 fixedHeader: true,
responsive: true,
"ajax": {
	"url": "<?php echo base_url('jobs/list') ?>",
	"dataType": "json",
	"type": "POST",
	"data": {
	search_json: search_json,
	job_id : job_id,
	searchBy: searchBy ,
	fo_id : fo_id,
	searchByFacility :searchByFacility,
	sm_id : sm_id,
	searchBySM : searchBySM,
	 start_date: start_date,
	end_date: end_date
  }
 },	 "columns": [
{
		 "data": "id"
 },
 {
		 "data": "fc_name"
 },
 {
		 "data": "nc_name"
 },
 {
		 "data": "fo_name"
 },
 {
		 "data": "sm_name"
 },
{
		 "data": "job_title"
 },
 {
		 "data": "start_date"
 },
 {
		 "data": "end_date"
 },
 {
		 "data": "added_on"
 },
 {
		 "data": "shift_type"
 },
{
		 "data": "job_hours"
 },
{
		 "data": "job_rate"
 },
{
		 "data": "job_prem_rate"
 },
 {
		 "data": "status"
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
            $("#form_modal_rudra_jobs").modal();
            $("#form_modal_rudra_jobs").addClass('md-show');
            $("#heading_rudra_jobs").text(heading);
            $("#frm_rudra_jobs").attr("action", '<?= base_url() ?>' + action_url);
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>' + data_url,
                data: {},
                success: function(data) {
                    response = JSON.parse(data);
                    if (response.status) {
                        jsonData = JSON.parse(JSON.stringify(response.data));
                        //console.log(jsonData);
                        $("#modal_form_data_rudra_jobs").html(jsonData.form_data);
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
$("#frm_rudra_jobs").submit(function(e) {
            e.preventDefault();
            //$(".btn-modal-form").prop('disabled', true);
            //$(".btn-modal-form").html('Wait...');
            var formData = new FormData($("#frm_rudra_jobs")[0]);
            var action_url = $("#frm_rudra_jobs").attr("action");
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
function keyPressed(foid){
			let formData = new FormData();
			formData.append('searchBy', foid);
            $.ajax({
                url: '<?php echo site_url('facility-owner/search') ?>',
                method: 'POST',
				data: formData,
				contentType:false,
				cache : false,
				processData : false,async:true,
                success: function(response){
					$('#fo_id').val('');
					$(".suggetions_listings").show();
					if(response.status == 'success') {
						
						$(".suggetions_listings").html(response.message);
                    }else 
					{   
						$(".suggetions_listings").hide();
					}
                },error: function(response) { 
				}
    });}
    function foShow(id,fo_name){ 
	$(".searchBy").val(fo_name);
	$("#fo_id").val(id);
	$(".suggetions_listings").hide();
	
}
function keyPressed2(sm_id){
			let formData = new FormData();
			formData.append('searchBy2', sm_id);
            $.ajax({
                url: '<?php echo site_url('shift-manager/searchbymanager') ?>',
                method: 'POST',
				data: formData,
				contentType:false,
				cache : false,
				processData : false,async:true,
                success: function(response){
					$('#sm_id').val('');
					$(".suggetions_listings2").show();
					if(response.status == 'success') {
						
						$(".suggetions_listings2").html(response.message);
                    }else 
					{   
						$(".suggetions_listings2").hide();
					}
                },error: function(response) { 
				console.log(response);
				}
    });}
    function smShow(id,sm_name){ 
	$(".searchBy2").val(sm_name);
	$("#sm_id").val(id);
	$(".suggetions_listings2").hide();
}
function keyPressed3(job_id){
			let formData = new FormData();
			formData.append('searchBy3', job_id);
            $.ajax({
                url: '<?php echo site_url('facility-transactions/searchbyjob') ?>',
                method: 'POST',
				data: formData,
				contentType:false,
				cache : false,
				processData : false,async:true,
                success: function(response){
					$('#job_id').val('');
					$(".suggetions_listings3").show();
					if(response.status == 'success') {
						$(".suggetions_listings3").html(response.message);
                    }else 
					{   
						$(".suggetions_listings3").hide();
					}
                },error: function(response) { 
				console.log(response);
				}
    });}
    function jobShow(id,job_title){ 
	$(".searchBy3").val(job_title);
	$("#job_id").val(id);
	$(".suggetions_listings3").hide();
}
</script>