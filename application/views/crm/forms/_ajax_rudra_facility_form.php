
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<div class="form-group col-sm-6">
	<label>Hospital Name</label>
 	<input type="text"  name="fc_name" class="form-control" value="<?= (!empty($form_data) ? $form_data->fc_name : ''); ?>"   placeholder="Hospital Name"   />
</div>
<!-- <div class="form-group col-sm-6">
	<label>Lat</label>
 	<input type="text"  name="fc_lat" class="form-control" value="<?= (!empty($form_data) ? $form_data->fc_lat : ''); ?>"   placeholder="Lat"   />
</div> -->
<!-- <div class="form-group col-sm-6">
	<label>Long</label>
 	<input type="text"  name="fc_long" class="form-control" value="<?= (!empty($form_data) ? $form_data->fc_long : ''); ?>"   placeholder="Long"   />
</div> -->
<div class="form-group col-sm-6">
	<label>Country</label>
	<select class="form-control" name="fc_country">
	  <option value="">Choose Country</option>
	  <?php 
	  foreach($country_data as $cd){?>
	  <option value="<?php echo $cd->id;?>"  <?php echo (empty($form_data)&&('233'==$cd->id))?'selected':''; ?> <?php echo (!empty($form_data)&&($form_data->fc_country==$cd->id))?'selected':''; ?>><?php echo $cd->name; ?></option>
	  <?php } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>State</label>
	<select class="form-control" name="fc_state">
	  <option value="">Choose State</option>
	  <?php 
	  foreach($state_data as $sd){?>
	  <option value="<?php echo $sd->id;?>"  <?php echo (!empty($form_data)&&($form_data->fc_state==$sd->id))?'selected':''; ?>><?php echo $sd->name; ?></option>
	  <?php } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>City</label>
 	<input type="text"  name="fc_city" class="form-control" value="<?= (!empty($form_data) ? $form_data->fc_city : ''); ?>"   placeholder="City"   />
</div>
<div class="form-group col-sm-6">
	<label>Ownership  Type</label>
	<select class="form-control" name="fc_ownership_type">
	  <option value="">Choose Ownership Type</option>
	  <?php 
	  foreach($ownership_data as $od){?>
	  <option value="<?php echo $od->id;?>"  <?php echo (!empty($form_data)&&($form_data->fc_ownership_type==$od->id))?'selected':''; ?>><?php echo $od->type; ?></option>
	  <?php } ?>
	</select>
 	
</div>
<div class="form-group col-sm-6">
	<label>Address</label>
 	<input type="text"  name="fc_address" class="form-control" value="<?= (!empty($form_data) ? $form_data->fc_address : ''); ?>"   placeholder="Address"   />
</div>
<div class="form-group col-sm-6">
	<label>Landmark</label>
 	<input type="text"  name="fc_landmark" class="form-control" value="<?= (!empty($form_data) ? $form_data->fc_landmark : ''); ?>"   placeholder="Landmark"   />
</div>
<div class="form-group col-sm-6">
	<label>Image</label>
 	<input type="file"  name="fc_image" class="form-control" value="<?= (!empty($form_data) ? $form_data->fc_image : ''); ?>"   placeholder="Image"   />
	 <?php if($form_data->fc_image){ ?>
		<a href="<?=base_url($form_data->fc_image)?>" target="_blank"><img src="<?=base_url($form_data->fc_image)?>" width="50px" /></a>
	<?php } ?>
</div>
</div>
<!--Uncomment if Scroll Required div -->
