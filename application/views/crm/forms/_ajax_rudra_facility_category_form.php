
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<input type="hidden" required name="original_name" value="<?= (!empty($form_data) ? $form_data->fc_name : ''); ?>">
<div class="form-group col-sm-6">
	<label>Department</label>
 	<input type="text" required name="fc_name" class="form-control" value="<?= (!empty($form_data) ? $form_data->fc_name : ''); ?>"   placeholder="Department"   />
</div>

<?php $options = $status; ?>
<div class="form-group col-sm-6">

	<label>Status</label>

	<select  id='status'  name="status" class="form-control" > 
	<option <?php if(!empty($form_data) && $form_data->status == 'Active'){echo 'selected="selected"';} ?> value="Active" >Active</option>
	<option <?php if(!empty($form_data) && $form_data->status == 'Inactive'){echo 'selected="selected"';} ?> value="Inactive" >Inactive</option>
	</select>
</div>
</div>
<!--Uncomment if Scroll Required div -->
