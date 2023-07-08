<style>
.pcoded-navbar.menupos-static
{
    /* min-height: 188%; */
}
</style>
<!-- Required Js -->

<!--script src="<?= base_url() ?>app_assets/js/menu-setting.min.js"></script-->
<script src="<?= base_url() ?>app_assets/js/pcoded.min.js"></script>
<!-- amchart js -->
<!--script src="<?= base_url() ?>app_assets/plugins/amchart/js/amcharts.js"></script>
    <script src="<?= base_url() ?>app_assets/plugins/amchart/js/gauge.js"></script>
    <script src="<?= base_url() ?>app_assets/plugins/amchart/js/serial.js"></script>
    <script src="<?= base_url() ?>app_assets/plugins/amchart/js/light.js"></script>
    <script src="<?= base_url() ?>app_assets/plugins/amchart/js/pie.min.js"></script>
    <script src="<?= base_url() ?>app_assets/plugins/amchart/js/ammap.min.js"></script>
    <script src="<?= base_url() ?>app_assets/plugins/amchart/js/usaLow.js"></script>
    <script src="<?= base_url() ?>app_assets/plugins/amchart/js/radar.js"></script>
    <script src="<?= base_url() ?>app_assets/plugins/amchart/js/worldLow.js"></script-->
<!-- notification Js -->
<script src="<?= base_url() ?>app_assets/plugins/notification/js/bootstrap-growl.min.js"></script>

<!-- dashboard-custom js -->
<!--script src="<?= base_url() ?>app_assets/js/pages/dashboard-custom.js"></script-->

<!-- datepicker js -->
<script src="<?= base_url() ?>app_assets/plugins/bootstrap-datetimepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>app_assets/js/pages/ac-datepicker.js"></script>
<!-- modal-window-effects Js -->
<script src="<?= base_url() ?>app_assets/plugins/modal-window-effects/js/classie.js"></script>
<script src="<?= base_url() ?>app_assets/plugins/modal-window-effects/js/modalEffects.js"></script>
<!-- sweet alert Js -->
<?php $this->load->view('crm/common/modal_js'); ?>

<script src="<?php echo base_url('app_assets/plugins/sweetalert/js/sweetalert.min.js');?>"></script>
<script src="<?php echo base_url('app_assets/js/pages/ac-alert.js');?>"></script>
<script type="text/javascript">
function read_notification(){
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('clearNotifications');?>',
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
				}else 
				{ 
					swal({
					  title: "Success",
					  text: stripTags(response.msg),
					  icon: "success",
					});			
				} 
    
                }
            });
        }
		function stripTags (original) {
  return original.replace(/(<([^>]+)>)/gi, "");
}
</script>
	
	
</body>

</html>