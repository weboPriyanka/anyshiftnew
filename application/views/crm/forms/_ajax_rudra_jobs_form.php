
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<div class="form-group col-sm-6">
	<label>Shift Manager</label>
	<select class="form-control" name="sm_id">
	  <option value="">Choose Shift Manager</option>
	  <?php 
	  foreach($shift_managers as $sm){?>
	  <option value="<?php echo $sm->id;?>"  <?php echo (!empty($form_data)&&($form_data->sm_id==$sm->id))?'selected':''; ?>><?php echo $sm->sm_fname.'&nbsp;'.$sm->sm_lname; ?></option>
	  <?php } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Facility Category</label>
	<select class="form-control" name="fc_cat_id">
	  <option value="">Choose Facility Category</option>
	  <?php 
	  foreach($facility_categories as $fcat){?>
	  <option value="<?php echo $fcat->id;?>"  <?php echo (!empty($form_data)&&($form_data->fc_cat_id==$fcat->id))?'selected':''; ?>><?php echo $fcat->fc_name; ?></option>
	  <?php } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Nurse Category</label>
	<select class="form-control" name="cg_cat_id">
	  <option value="">Choose Nurse Category</option>
	  <?php 
	  foreach($nurse_categories as $ncat){?>
	  <option value="<?php echo $ncat->id;?>"  <?php echo (!empty($form_data)&&($form_data->cg_cat_id==$ncat->id))?'selected':''; ?>><?php echo $ncat->nc_name; ?></option>
	  <?php } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Job Title</label>
 	<input type="text"  name="job_title" class="form-control" value="<?= (!empty($form_data) ? $form_data->job_title : ''); ?>"   placeholder="Job Title"   />
</div>
<div class="form-group col-sm-6">
	<label>Job Description</label>
 	<input type="text"  name="job_description" class="form-control" value="<?= (!empty($form_data) ? $form_data->job_description : ''); ?>"   placeholder="Job Description"   />
</div>

<?php $options = $shift_type; ?>
<div class="form-group col-sm-6">

	<label>Shift Type</label>

	<select  id='shift_type'  name="shift_type" class="form-control" >
<option <?php if(!empty($form_data) && $form_data->shift_type == 'day'){echo 'selected="selected"';} ?> value="day" >Day</option>
	<option <?php if(!empty($form_data) && $form_data->shift_type == 'night'){echo 'selected="selected"';} ?> value="night" >Night</option>
	<option <?php if(!empty($form_data) && $form_data->shift_type == 'any'){echo 'selected="selected"';} ?> value="any" >Any</option>
	
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Job Hours</label>
 	<input type="number"  name="job_hours" min=0 class="form-control" value="<?= (!empty($form_data) ? $form_data->job_hours : ''); ?>"   placeholder="Job Hours"   />
</div>

<?php $options = $is_premium; ?>
<div class="form-group col-sm-6">

	<label>Is Premium</label>

	<select  id='is_premium'  name="is_premium" class="form-control" >
<option <?php if(!empty($form_data) && $form_data->is_premium == 'yes'){echo 'selected="selected"';} ?> value="yes" >Yes</option>
	<option <?php if(!empty($form_data) && $form_data->is_premium == 'no'){echo 'selected="selected"';} ?> value="no" >No</option>
	
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Job Rate</label>
 	<input type="number"  name="job_rate" min=0 class="form-control" value="<?= (!empty($form_data) ? $form_data->job_rate : ''); ?>"   placeholder="Job Rate"   />
</div>
<div class="form-group col-sm-6">
	<label>Job Prem Rate</label>
 	<input type="number"  name="job_prem_rate" min=0 class="form-control" value="<?= (!empty($form_data) ? $form_data->job_prem_rate : ''); ?>"   placeholder="Job Prem Rate"   />
</div>

<?php $options = $status; ?>
<div class="form-group col-sm-6">
	<label>Status</label>
	<select  id='status'  name="status" class="form-control" > 
	<option <?php if(!empty($form_data) && $form_data->status == 'Active'){echo 'selected="selected"';} ?> value="Active" >Active</option>
	<option <?php if(!empty($form_data) && $form_data->status == 'Pending'){echo 'selected="selected"';} ?> value="Pending" >Pending</option>
	<option <?php if(!empty($form_data) && $form_data->status == 'Published'){echo 'selected="selected"';} ?> value="Published" >Published</option>
	<option <?php if(!empty($form_data) && $form_data->status == 'Draft'){echo 'selected="selected"';} ?> value="Draft" >Draft</option>
	</select>
</div>
</div>
<!--Uncomment if Scroll Required div -->
