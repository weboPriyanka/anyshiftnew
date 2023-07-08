<?php 
	$this->load->view('crm/common_front/header');
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
                        <img src="<?= base_url('app_assets/images/logo.png') ?>" height="70" >
                    </div>
                    <h3 class="mb-4">Admin Login</h3>
                    <div class="input-group mb-3">
                        <input type="text" name="username" id="username" required class="form-control" placeholder="username" />
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" name="password" id="password" required class="form-control" placeholder="password" />
                    </div>
                   <input type="hidden" value="<?= (isset($_GET['req_uri'])?$_GET['req_uri']:'admin') ?>" name="req_uri" >
                    <button type="submit"  class="btn btn-success shadow-2 mb-4 btnlogin">Login</button>
                                 
			   </div>
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
			//$(".btnlogin").removeClass('btn-warning');
			//$(".btnlogin").html('Authenticating...');
			var formData = new FormData($("#frmlogin")[0]);
			$.ajax({

			type: 'POST',

			url: '<?=base_url()?>do-admin-login',

			data:  formData,

			cache: false,

			processData: false,

			contentType: false,

			success: function (data) {
				console.log(data);
				response = JSON.parse(data);
				
				if(response.status)
				{ 
					swal({
					  title: "Success",
					  text: stripTags(response.msg),
					  icon: "success",
					});			
					$(".btnlogin").removeClass('btn-success');
					$(".btnlogin").addClass('btn-success');
					$(".btnlogin").removeClass('btn-warning');
					$(".btnlogin").html('Login');
					//console.log(response.data.url);
					setTimeout(function(){ window.location = response.data.url; }, 3000);
					

				}else 
				{ 
					swal({
					  title: "Error",
					  text: stripTags(response.msg),
					  icon: "error",
					});	
				}

			}

		});
			
		}); 
	 });
	 function stripTags (original) {
  return original.replace(/(<([^>]+)>)/gi, "");
}
	</script>
	<?php 
	$this->load->view('crm/common_front/theme_js');
	$this->load->view('crm/common_front/footer');
?>