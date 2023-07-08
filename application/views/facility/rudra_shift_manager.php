<link rel="stylesheet" href="<?= base_url('app_') ?>assets/plugins/data-tables/css/datatables.min.css" /> <link rel="stylesheet" href="<?= base_url('app_') ?>assets/css/style.css" />
        <!-- [Main Content] start -->
        <div class="row">
            <!-- [Total-user section] start -->
            <div class="col-sm-12">
			  <form id="filter" name="filter"> 
                <div class="card text-left">
                    <div class="card-body">
					   <div class="row">
						<div class="form-group col-sm-3 ">
                            <input type="hidden" name="sm_id" id="sm_id" class="form-control sm_id"  >
							<input type="text" name="searchBy2" id="searchBy2" oninput="keyPressed2(this.value)" onkeyup="keyPressed2(this.value)"  onKeyDown="keyPressed2(this.value)" onKeyPress="keyPressed2(this.value)"class="form-control searchBy2"  placeholder="Shift Manager Name">
                            <div class="suggetions_listings2" style="display:none;">
                               <ul class="list-group">
										<li class="list-group-item">No Shift Manager Found</li>
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
                        <div class="col-sm-5">
                        <h5><?= $page_header ?></h5>
                        </div>
                            <div class="col-sm-7 text-right">
                                <button onclick="static_form_modal('facility-shift-manager/post_actions/get_data?id=0','facility-shift-manager/post_actions/insert_data','md','Update Details')" type="button" class="btn btn-glow-success btn-info" title="" data-toggle="tooltip" data-original-title="Add New Item" aria-describedby="tooltip651610">New</button>&nbsp;
                                <a href="facility-shift-manager/post_actions/export_data" type="button" class="btn btn-glow-danger btn-warning" title="" data-toggle="tooltip" data-original-title="Export CSV" aria-describedby="tooltip651610">CSV</a>
                            
                                </div> 
                            </div> 
                        </div>

                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="responsive-table-modeldddd" class="display table dt-responsive nowrap table-striped table-hover user_post" style="width:100%">
                                <thead><tr>
<th>Id</th>
<th>Shift Manager Name</th>
<th>Mobile</th>
<th>Email</th>
<th>Password</th>
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
  <div class="md-modal md-effect-11 dynamic-modal" id="form_modal_rudra_facility_owner">
       <div class="modal-content">
           <div class="modal-header theme-bg2 ">
               <h5 class="modal-title text-white" id="heading_rudra_facility_owner">Loading...</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
           </div>
           <form id="frm_rudra_facility_owner" method="post" enctype="multipart/form-data">
               <div class="modal-body" id="modal_form_data_rudra_facility_owner"> </div>         
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
   var sm_id = $('#sm_id').val();
   var searchBySM = $('#searchBy2').val();
   if(searchBySM==''){
	   $('#sm_id').val('');
   }
   var start_date = $('#start_date_stat').val();
    var end_date = $('#end_date_stat').val();
    $('.user_post').DataTable().destroy();
    fill_server_data_table(search_json,sm_id,searchBySM,start_date,end_date);
  });
 $.fn.dataTable.ext.errMode = 'throw';
var usrTable;
fill_server_data_table(search_json);
function fill_server_data_table(search_json,sm_id ='',searchBySM ='',start_date ='',end_date =''){
	usrTable = $('.user_post').DataTable({
"processing": true,
"serverSide": true,
 fixedHeader: true,
responsive: true,
"ajax": {
	"url": "<?php echo base_url('facility-shift-manager/list') ?>",
	"dataType": "json",
	"type": "POST",
	"data": {
	search_json: search_json,
	 start_date: start_date,
	 end_date :end_date,
	 sm_id : sm_id,
	 searchBySM :searchBySM,
	 
  }
 },	 "columns": [
{
		 "data": "id"
 },
{
		 "data": "sm_name"
 },
{
		 "data": "sm_mobile"
 },
{
		 "data": "sm_email"
 },
{
		 "data": "sm_password"
 },
{
		 "data": "status"
 },{
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
            $("#form_modal_rudra_facility_owner").modal();
            $("#form_modal_rudra_facility_owner").addClass('md-show');
            $("#heading_rudra_facility_owner").text(heading);
            $("#frm_rudra_facility_owner").attr("action", '<?= base_url() ?>' + action_url);
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>' + data_url,
                data: {},
                success: function(data) {
                    response = JSON.parse(data);
                    if (response.status) {
                        jsonData = JSON.parse(JSON.stringify(response.data));
                        //console.log(jsonData);
                        $("#modal_form_data_rudra_facility_owner").html(jsonData.form_data);
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

$("#frm_rudra_facility_owner").submit(function(e) {
            e.preventDefault();
            var formData = new FormData($("#frm_rudra_facility_owner")[0]);
            var action_url = $("#frm_rudra_facility_owner").attr("action");
            $.ajax({
                type: 'POST',
                url: action_url,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    response = JSON.parse(data);
					if(response.status=='error')
				{ 
					swal({
					  title: "Error",
					  text: stripTags(response.msg),
					  icon: "error",
					});	
					//console.log(response.data.url);
					//setTimeout(function(){ window.location = response.data.url; }, 3000);
				}else if(response.status=='success')
				{ 
					swal({
					  title: "Success",
					  text: stripTags(response.msg),
					  icon: "success",
					});			
					 $(".btn-modal-form").prop('disabled', false);
                        $(".btn-modal-form").html('Update');
                        usrTable.ajax.reload(null, false);
                        $('.dynamic-modal').modal('hide');
					

				} else {
                        $(".btn-modal-form").prop('disabled', false);
                        $(".btn-modal-form").html('Update');
                    }
    
                }
            });
        });
		function stripTags (original) {
  return original.replace(/(<([^>]+)>)/gi, "");
}function keyPressed2(sm_id){
			let formData = new FormData();
			formData.append('searchBy2', sm_id);
            $.ajax({
                url: '<?php echo site_url('facility-shift-manager/searchbymanager') ?>',
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
</script>