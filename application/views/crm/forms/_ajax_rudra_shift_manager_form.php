
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<div class="form-group col-sm-6">
	<label>Fo Id</label>
 	<!-- <input type="number"  name="fo_id" class="form-control" value="<?= (!empty($form_data) ? $form_data->fo_id : ''); ?>"   placeholder="Fo Id"   /> -->
	 <select class="form-control" name="fo_id">
	  <option value="">Choose Facility Owner</option>
	  <?php 
	  foreach($fo_data as $fo){?>
	  <option value="<?php echo $fo->id;?>"  <?php echo (!empty($form_data)&&($form_data->fo_id==$fo->id))?'selected':''; ?>><?php echo $fo->fo_fname.'&nbsp;'.$fo->fo_lname; ?></option>
	  <?php } ?>
	</select>
</div>
<!-- <div class="form-group col-sm-6">
	<label>Facility</label>
	<select class="form-control" name="fo_id">
	  <option value="">Choose Facility</option>
	  <?php 
	  foreach($facility as $fo){?>
	  <option value="<?php echo $fo->id;?>"  <?php echo (!empty($form_data)&&($form_data->fo_id==$fo->id))?'selected':''; ?>><?php echo $fo->fo_fname.'&nbsp;'.$fo->fo_lname; ?></option>
	  <?php } ?>
	</select>
</div> -->
<div class="form-group col-sm-6">
	<label>Sm Fname</label>
 	<input type="text"  name="sm_fname" class="form-control" value="<?= (!empty($form_data) ? $form_data->sm_fname : ''); ?>"   placeholder="Sm Fname"   />
</div>
<div class="form-group col-sm-6">
	<label>Sm Lname</label>
 	<input type="text"  name="sm_lname" class="form-control" value="<?= (!empty($form_data) ? $form_data->sm_lname : ''); ?>"   placeholder="Sm Lname"   />
</div>
<div class="form-group col-sm-6">
	<label>Sm Mobile</label>
 	<input type="text"  name="sm_mobile" class="form-control" value="<?= (!empty($form_data) ? $form_data->sm_mobile : ''); ?>"   placeholder="Sm Mobile"   />
</div>
<div class="form-group col-sm-6">
	<label>Sm Email</label>
 	<input type="text"  name="sm_email" class="form-control" value="<?= (!empty($form_data) ? $form_data->sm_email : ''); ?>"   placeholder="Sm Email"   />
</div>
<!-- <div class="form-group col-sm-6">
	<label>Sm Password</label>
 	<input type="text"  name="sm_password" class="form-control" value="<?= (!empty($form_data) ? $form_data->sm_password : ''); ?>"   placeholder="Sm Password"   />
</div> -->

<div class="form-group col-sm-6">
	<label>Sm Image</label>
 	<input type="file"  name="sm_image" class="form-control" value="<?= (!empty($form_data) ? $form_data->sm_image : ''); ?>"   placeholder="Sm Password"   />
		<?php if($form_data->sm_image){ ?>
			<a href="<?=base_url($form_data->sm_image)?>" target="_blank"><img src="<?=base_url($form_data->sm_image)?>" width="50px" /></a>
	<?php } ?>
</div>

<?php $options = $status; ?>
<div class="form-group col-sm-6">

	<label>Status</label>

	<select  id='status'  name="status" class="form-control" >

<option value="Active"  <?php echo (!empty($form_data)&&($form_data->status=='Active'))?'selected':''; ?>>Active</option>
<option value="Inactive"  <?php echo (!empty($form_data)&&($form_data->status=='Inactive'))?'selected':''; ?>>Inactive</option>

	</select>
</div>
</div>
<!--Uncomment if Scroll Required div -->
