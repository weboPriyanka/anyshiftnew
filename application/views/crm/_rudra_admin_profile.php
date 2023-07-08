<link rel="stylesheet" href="<?= base_url('app_') ?>assets/plugins/data-tables/css/datatables.min.css" /> <link rel="stylesheet" href="<?= base_url('app_') ?>assets/css/style.css" />
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [Total-user section] start -->
            <!--div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="col-sm-3 float-right">
                            <div class="input-daterange input-group " id="datepicker_range">
                                <input type="text" class="form-control text-left" placeholder="Start date" id="start_date_stat" name="start">
                                <input type="text" class="form-control text-right" placeholder="End date" id="end_date_stat" name="end">
                            </div>
                        </div>
                    </div>
                </div>
            </div-->
            <div class="clear-fix clearfix"></div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                        <div class="col-sm-5">

                        <h5><?= $page_header ?></h5>
                        </div>
                       </div> 
                        </div>

                    <div class="card-block">
					  <div class="row">
					   <div class="col-lg-4">
							<div class="card user-card user-card-1">
							<div class="card-body pb-0">
							<div class="float-end">
							<!--<span class="badge badge-success">Pro</span>-->
							</div>
							<div class="media user-about-block align-items-center mt-0 mb-3">
							<div class="position-relative d-inline-block">
							<!--<img class="img-radius img-fluid wid-80" src="../assets/images/user/avatar-5.jpg" alt="User image">-->
							<div class="certificated-badge">
							<i class="fas fa-certificate text-primary bg-icon"></i>
							<i class="fas fa-check front-icon text-white"></i>
							</div>
							</div>
							<div class="media-body ms-3">
							<h6 class="mb-1"><?php echo $profileDetails['name'];?></h6>
							<p class="mb-0 text-muted"><?php echo $profileDetails['username'];?></p>
							</div>
							</div>
							</div>
							
							<div class="card-body">
							<div class="row text-center">
							<div class="col">
							<h6 class="mb-1"><?php echo $facility_owners['counts'];?></h6>
							<p class="mb-0">Facility Owners</p>
							</div>
							<div class="col border-start">
							<h6 class="mb-1"><?php echo $shift_managers['counts'];?></h6>
							<p class="mb-0">Shift Manager</p>
							</div>
							<div class="col border-start">
							<h6 class="mb-1"><?php echo $care_givers['counts'];?></h6>
							<p class="mb-0">Care Givers</p>
							</div>
							<div class="col border-start">
							<h6 class="mb-1"><?php echo $activeJobs['counts'];?></h6>
							<p class="mb-0">Active Jobs</p>
							</div>
							<div class="col border-start">
							<h6 class="mb-1"><?php echo $completedJobs['counts'];?></h6>
							<p class="mb-0">Jobs Completed</p>
							</div>
							</div>
							</div>
							<div class="nav flex-column nav-pills list-group list-group-flush list-pills" id="user-set-tab" role="tablist" aria-orientation="vertical">

<a class="nav-link list-group-item list-group-item-action label-primary active" id="user-set-information-tab" data-bs-toggle="pill" href="javascript:" onclick="javascript:tabChange('user-set-information');" role="tab" aria-controls="user-set-information" aria-selected="false">
<span class="f-w-500"><i class="feather icon-file-text m-r-10 h5 "></i>Personal
Information</span>
<span class="float-end"><i class="feather icon-chevron-right"></i></span>
</a>
<a class="nav-link list-group-item list-group-item-action label-primary" id="user-set-passwort-tab" data-bs-toggle="pill" href="javascript:"  onclick = "javascript:tabChange('user-set-passwort');" role="tab" aria-controls="user-set-passwort" aria-selected="true">
<span class="f-w-500"><i class="feather icon-shield m-r-10 h5 "></i>Change
Password</span>
<span class="float-end"><i class="feather icon-chevron-right"></i></span>
</a>
</div>
							</div>
					 </div>
					 <div class="col-lg-8">
							<div class="tab-content bg-transparent p-0 shadow-none" id="user-set-tabContent">
							<div class="tab-pane fade active show" id="user-set-information" role="tabpanel" aria-labelledby="user-set-information-tab">
							<div class="card">
							<form method="POST" name="updateProfile" id="updateProfile">
							<div class="card-header">
							<h5><i class="feather icon-user text-c-blue wid-20"></i><span class="p-l-5">Personal Information</span></h5>
							</div>
							<div class="card-body">
							<div class="row">
							<div class="col-sm-6">
							<div class="form-group">
							<label class="form-label">Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="name" value="<?php echo $profileDetails['name'];?>" required />
							</div>
							</div>
							<div class="col-sm-6">
							<div class="form-group">
							<label class="form-label">User Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="username" value="<?php echo $profileDetails['username'];?>" required />
							<input type="hidden" class="form-control" name="original" value="<?php echo $profileDetails['username'];?>" required />
							</div>
							</div>
							</div>
							<div class="card-footer text-end">
							<button class="btn btn-glow-success btn-info">Update Profile</button>
							</div>
							</div>
							
							</form>
							
							</div></div>
							
							<div class="tab-pane" style="display:none;" id="user-set-passwort" role="tabpanel" aria-labelledby="user-set-passwort-tab">

<div class="card">
<form method="POST" name="changePassword" id="changePassword" >
<div class="card-header">
<h5><i data-feather="lock" class="icon-svg-primary wid-20"></i><span class="p-l-5">Change Password</span></h5>
</div>
<div class="card-body">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label class="form-label">Current Password <span class="text-danger">*</span></label>
<input type="password" name="password" id="password" class="form-control" placeholder="Enter Your currunt password">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label class="form-label">New Password <span class="text-danger">*</span></label>
<input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter New password">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label class="form-label">Confirm Password <span class="text-danger">*</span></label>
<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter your password again">
</div>
</div>
</div>
</div>
<div class="card-footer text-end">
<button type="submit" class="btn btn-glow-success btn-info">Change Password</button>
</div>
</form>
</div>
</div>
							</div>
							
<!-- sweet alert Js -->
<script src="<?php echo base_url('app_assets/plugins/sweetalert/js/sweetalert.min.js');?>"></script>
<script src="<?php echo base_url('app_assets/js/pages/ac-alert.js');?>"></script>
                     
</div>
 <script> 
function tabChange(id){
	if(id=='user-set-passwort'){
		$('#user-set-information').hide();
		$('#user-set-passwort').show();
		$('#user-set-passwort-tab').addClass("active");
		$('#user-set-information-tab').removeClass("active");
	}
	else{
		$('#user-set-passwort').hide();
		$('#user-set-information').show();
		$('#user-set-information-tab').addClass("active");
		$('#user-set-passwort-tab').removeClass("active");
		
	}
} 
$("#changePassword").submit(function(e) {
            e.preventDefault();
            var formData = new FormData($("#changePassword")[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('admin-edit-password');?>',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    response = JSON.parse(data);
                    console.log(response);
					if(response.status=='error')
				{ 
					swal({
					  title: "Error",
					  text: stripTags(response.msg),
					  icon: "error",
					});	
				}else 
				{ 
					swal({
					  title: "Success",
					  text: stripTags(response.msg),
					  icon: "success",
					});	
					$('#password').val('');
					$('#new_password').val('');
					$('#confirm_password').val('');
				} 
    
                }
            });
        });
		$("#updateProfile").submit(function(e) {
            e.preventDefault();
            var formData = new FormData($("#updateProfile")[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('admin-update-profile');?>',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    response = JSON.parse(data);
                    console.log(response);
					if(response.status=='error')
				{ 
					swal({
					  title: "Error",
					  text: stripTags(response.msg),
					  icon: "error",
					});	
				}else 
				{ 
					swal({
					  title: "Success",
					  text: stripTags(response.msg),
					  icon: "success",
					});
				    setTimeout(function(){ window.location = response.data.url; }, 2000);
				} 
    
                }
            });
        });
		function stripTags (original) {
  return original.replace(/(<([^>]+)>)/gi, "");
}
</script>
</div>
</div>
</div>
</div>
