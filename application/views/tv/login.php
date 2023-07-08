<?php 
	$this->load->view('tv/common_front/header');
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
                        <!-- <img src="<?= base_url('app_assets/images/logo.png') ?>" height="100" > -->
						<h2>Rochay TV</h2>
                    </div>
                    <h3 class="mb-4">TV Owner Login</h3>
                    <div class="input-group mb-3">
                        <input type="text" name="username" id="username" required class="form-control" placeholder="username" />
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" name="password" id="password" required class="form-control" placeholder="password" />
                    </div>
                   <input type="hidden" value="<?= (isset($_GET['req_uri'])?$_GET['req_uri']:'tv') ?>" name="req_uri" >
                    <button type="submit"  class="btn btn-success shadow-2 mb-4 btnlogin">Login</button>
                                 
			   </div>
			  </form>
            </div>
        </div>
    </div>
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

			url: '<?=base_url()?>do-tv-login',

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
				}else if(response.status=='success')
				{ 
					swal({
					  title: "Success",
					  text: response.msg,
					  icon: "success",
					});			
					 window.location = response.data.url; 
				} else {
					$(".btnlogin").prop('disabled',false);
					$(".btnlogin").addClass('btn-success');
					$(".btnlogin").removeClass('btn-warning');
					$(".btnlogin").html('Login');
					
				}

			}

		});
			
		}); 
	 });
	</script>
	<?php 
	$this->load->view('tv/common_front/theme_js');
	$this->load->view('tv/common_front/footer');
?>