
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<div class="form-group col-sm-6">
	<label>Filter</label>
 	<!-- <input type="text"  name="filter" class="form-control" value="<?= (!empty($form_data) ? $form_data->filter : ''); ?>"   placeholder="Filter"   /> -->
	<select  id='filter'  name="filter" class="form-control" required>
		<option value="">Select</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='licenseState'){ echo "selected"; } ?>>licenseState</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='speciality'){ echo "selected"; } ?>>speciality</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='preferredGeography'){ echo "selected"; } ?>>preferredGeography</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='licenseTypes'){ echo "selected"; } ?>>licenseTypes</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='nurseDegree'){ echo "selected"; } ?>>nurseDegree</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='jobTitle'){ echo "selected"; } ?>>jobTitle</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='slot'){ echo "selected"; } ?>>slot</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='searchCredential'){ echo "selected"; } ?>>searchCredential</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='availability'){ echo "selected"; } ?>>availability</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='shiftDuration'){ echo "selected"; } ?>>shiftDuration</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='assignmentDuration'){ echo "selected"; } ?>>assignmentDuration</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='preferredShift'){ echo "selected"; } ?>>preferredShift</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='experiences'){ echo "selected"; } ?>>experiences</option>
		<option <?php if(!empty($form_data) && $form_data->filter=='radius'){ echo "selected"; } ?>>radius</option>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Title</label>
 	<input type="text"  name="title" class="form-control" value="<?= (!empty($form_data) ? $form_data->title : ''); ?>"   placeholder="Title"   />
</div>

<?php $options = $status; ?>
<div class="form-group col-sm-6">

	<label>Status</label>

	<select  id='status'  name="status" class="form-control" >
<?php 
 foreach($options as $dk => $dv) 
{
	 $selectop = '';
	 if(!empty($form_data) && $form_data->status == $dv)
	{
		$selectop = 'selected="selected"';  
	} ?> 
	<option <?= $selectop ?> value="<?= $dv ?>"  ><?= $dv?></option>
<?php  } ?>
	</select>
</div>


<div class="form-group col-sm-6">
	<label>Icon Image</label>
 	<input type="file"  name="image" class="form-control" value="<?= (!empty($form_data) ? $form_data->image : ''); ?>"  />
	 <?php if($form_data->image){ ?>
	 <a href="<?=($form_data->image)?>" target="_blank"><img src="<?=($form_data->image)?>" width="50px" /></a>
	<?php } ?>
</div>
</div>
<!--Uncomment if Scroll Required div -->
