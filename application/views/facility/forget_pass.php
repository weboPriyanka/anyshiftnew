<?php 
	$this->load->view('facility/common_front/header');
?>
<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
			<form id="frmlogin" method="post">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <img src="<?= base_url('assets/images/logo.jpg') ?>" height="100" >
                    </div>
                    <h3 class="mb-4">Change Password</h3>
                    <div class="input-group mb-3">
                        <input type="password" name="new_password"  required class="form-control" placeholder="New Password" />
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" name="confirm_password"  required class="form-control" placeholder="Confirm New Password" />
                    </div>
                   <input type="hidden" value="<?= (isset($_GET['req_uri'])?$_GET['req_uri']:'facility') ?>" name="req_uri" >
                    <button type="submit"  class="btn btn-success shadow-2 mb-4 btnlogin">Change Password</button>
                                 
			   </div>
			   <input type="hidden" name="fo_forget_link"  value="<?php echo $forget_link;?>" required class="form-control" placeholder="fo_forget_link" />
			  </form>
            </div>
        </div>
    </div>
	<!-- sweet alert Js -->
   <script src="<?php echo base_url('app_assets/plugins/sweetalert/js/sweetalert.min.js');?>"></script>
   <script src="<?php echo base_url('app_assets/js/pages/ac-alert.js');?>"></script>
	<script>
	 $(document).ready(function(){
		$("#frmlogin").submit(function(e){
			e.preventDefault();
			//$(".btnlogin").prop('disabled',true);
			$(".btnlogin").addClass('btn-success');
			$(".btnlogin").removeClass('btn-warning');
			//$(".btnlogin").html('Authenticating...');
			var formData = new FormData($("#frmlogin")[0]);
			$.ajax({

			type: 'POST',

			url: '<?=base_url()?>fo-ajaxforget-pass',

			data:  formData,

			cache: false,

			processData: false,

			contentType: false,

			success: function (data) {
				console.log(data);
				response = JSON.parse(data);
				
				if(response.status=='error')
				{ 
					swal({
					  title: "Error",
					  text: response.msg,
					  icon: "error",
					});	
					$(".btnlogin").prop('disabled',false);
					$(".btnlogin").removeClass('btn-success');
					$(".btnlogin").addClass('btn-success');
					$(".btnlogin").removeClass('btn-warning');
					$(".btnlogin").html('Change Password');
					//console.log(response.data.url);
					setTimeout(function(){ window.location = response.data.url; }, 3000);
					

				}else if(response.status=='success')
				{ 
					swal({
					  title: "Success",
					  text: response.msg,
					  icon: "success",
					});			
					$(".btnlogin").removeClass('btn-success');
					$(".btnlogin").addClass('btn-success');
					$(".btnlogin").removeClass('btn-warning');
					$(".btnlogin").html('Change Password');
					window.location = '<?php echo site_url('fo-login');?>';
					

				}
				else{
					$(".btnlogin").prop('disabled',false);
					$(".btnlogin").addClass('btn-success');
					$(".btnlogin").removeClass('btn-warning');
					$(".btnlogin").html('Change Password');
					
				}

			}

		});
			
		}); 
	 });
	</script>
	
	<?php 
	$this->load->view('facility/common_front/theme_js');
	$this->load->view('facility/common_front/footer');
?>