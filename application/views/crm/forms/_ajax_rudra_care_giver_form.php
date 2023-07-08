
<!--UNComment if SCROLL BAR required --><div class='col-sm-12' style='max-height:500px;overflow: auto;'>
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<div class="form-group col-sm-6">
	<label>First Name</label>
 	<input type="text" required name="cg_fname" class="form-control" value="<?= (!empty($form_data) ? $form_data->cg_fname : ''); ?>"   placeholder="First Name"   />
</div>
<div class="form-group col-sm-6">
	<label>Last Name</label>
 	<input type="text" required name="cg_lname" class="form-control" value="<?= (!empty($form_data) ? $form_data->cg_lname : ''); ?>"   placeholder="Last Name"   />
</div>
<div class="form-group col-sm-6">
	<label>Mobile No.</label>
 	<input type="text" required name="cg_mobile" class="form-control" value="<?= (!empty($form_data) ? $form_data->cg_mobile : ''); ?>"   placeholder="Mobile No."   />
</div>
<div class="form-group col-sm-6">
	<label>Profile Pic</label>
 	<input type="file"  name="cg_profile_pic" class="form-control" value="<?= (!empty($form_data) ? $form_data->cg_profile_pic : ''); ?>"   placeholder="Profile Pic"   />
	 <?php if($form_data->cg_profile_pic){ ?>
	 <a href="<?=base_url($form_data->cg_profile_pic)?>" target="_blank"><img src="<?=base_url($form_data->cg_profile_pic)?>" width="50px" /></a>
	<?php } ?>
</div>
<div class="form-group col-sm-6">
	<label>Address</label>
 	<input type="text"  name="cg_address" class="form-control" value="<?= (!empty($form_data) ? $form_data->cg_address : ''); ?>"   placeholder="Address"   />
</div>
<div class="form-group col-sm-6">
	<label>Country</label>
	<select required id='cg_country'  name="cg_country" class="form-control" >
<?php $options = getCountryDropdown();
 foreach($options as $dk => $dv) 
{
	 $selectop = '';
	 if(!empty($form_data) && $form_data->cg_country == $dv['id'])
	{
		$selectop = 'selected="selected"';  
	} ?> 
	<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['name']?></option>
<?php  } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>State</label>
	<select required id='cg_state'  name="cg_state" class="form-control" >
<?php $options = getStateDropdown();
 foreach($options as $dk => $dv) 
{
	 $selectop = '';
	 if(!empty($form_data) && $form_data->cg_state == $dv['id'])
	{
		$selectop = 'selected="selected"';  
	} ?> 
	<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['name']?></option>
<?php  } ?>
	</select>
</div>

<div class="form-group col-sm-6">
	<label>City</label>
 	<input type="text" required name="cg_city" class="form-control" value="<?= (!empty($form_data) ? $form_data->cg_city : ''); ?>"   placeholder="City"   />
</div>
<div class="form-group col-sm-6">
	<label>Zipcode</label>
 	<input type="text" required name="cg_zipcode" class="form-control" value="<?= (!empty($form_data) ? $form_data->cg_zipcode : ''); ?>"   placeholder="Zipcode"   />
</div>
<?php $options = $status; ?>
<div class="form-group col-sm-6">

	<label>Status</label>

	<select required id='status'  name="status" class="form-control" >
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
	<label>Hours Completed</label>
 	<input type="number"  name="hours_completed" class="form-control" value="<?= (!empty($form_data) ? $form_data->hours_completed : ''); ?>"   placeholder="Hours Completed"   />
</div>
<div class="form-group col-sm-6">
	<label>Total Earned</label>
 	<input type="text"  name="total_earned" class="form-control" value="<?= (!empty($form_data) ? $form_data->total_earned : ''); ?>"   placeholder="Total Earned"   />
</div>
<div class="form-group col-sm-6">
	<label>Average Rating</label>
 	<input type="text"  name="average_rating" class="form-control" value="<?= (!empty($form_data) ? $form_data->average_rating : ''); ?>"   placeholder="Average Rating"   />
</div>
<div class="form-group col-sm-6">
	<label>License State</label>
 	<!-- <input type="text"  name="license_state" class="form-control" value="<?= (!empty($form_data) ? $form_data->license_state : ''); ?>"   placeholder="Average Rating"   /> -->
	<?php $options = getKeywordDropdown($filter = "licenseState"); ?> 
	<select id='license_state'  name="license_state" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->license_state == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>License Number</label>
 	<input type="text"  name="license_number" class="form-control" value="<?= (!empty($form_data) ? $form_data->license_number : ''); ?>"   placeholder="Average Rating"   />
</div>
<div class="form-group col-sm-6">
	<label>Speciality</label>
 	<!-- <input type="text"  name="speciality" class="form-control" value="<?= (!empty($form_data) ? $form_data->speciality : ''); ?>"   placeholder="Average Rating"   /> -->
	 <?php $options = getKeywordDropdown($filter = "speciality"); ?> 
	<select id='speciality'  name="speciality" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->speciality == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div> 

<div class="form-group col-sm-6">
	<label>License Type</label>
 	<!-- <input type="text"  name="license_type" class="form-control" value="<?= (!empty($form_data) ? $form_data->license_type : ''); ?>"   placeholder="Average Rating"   /> -->
	 <?php $options = getKeywordDropdown($filter = "licenseTypes"); ?> 
	<select id='license_type'  name="license_type" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->license_type == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>

<div class="form-group col-sm-6">
	<label>Search Status</label>
 	<input type="text"  name="search_status" class="form-control" value="<?= (!empty($form_data) ? $form_data->search_status : ''); ?>"   placeholder="Average Rating"   />
</div>
<div class="form-group col-sm-6">
	<label>Nurse Degree</label>
 	<!-- <input type="text"  name="nurse_degree" class="form-control" value="<?= (!empty($form_data) ? $form_data->nurse_degree : ''); ?>"   placeholder="Average Rating"   /> -->

	 <?php $options = getKeywordDropdown($filter = "nurseDegree"); ?> 
	<select id='nurse_degree'  name="nurse_degree" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->nurse_degree == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>University Name</label>
 	<input type="text"  name="university_name" class="form-control" value="<?= (!empty($form_data) ? $form_data->university_name : ''); ?>"   placeholder="Average Rating"   />
</div>
<div class="form-group col-sm-6">
	<label>University Country</label>
 	<input type="text"  name="university_country" class="form-control" value="<?= (!empty($form_data) ? $form_data->university_country : ''); ?>"   placeholder="Average Rating"   />
</div>
<div class="form-group col-sm-6">
	<label>University State</label>
 	<input type="text"  name="university_state" class="form-control" value="<?= (!empty($form_data) ? $form_data->university_state : ''); ?>"   placeholder="Average Rating"   />
</div>
<div class="form-group col-sm-6">
	<label>University city</label>
 	<input type="text"  name="university_city" class="form-control" value="<?= (!empty($form_data) ? $form_data->university_city : ''); ?>"   placeholder="Average Rating"   />
</div>
<div class="form-group col-sm-6">
	<label>Slot</label>
 	<!-- <input type="text"  name="slot" class="form-control" value="<?= (!empty($form_data) ? $form_data->slot : ''); ?>"   placeholder="Average Rating"   /> -->
	 <?php $options = getKeywordDropdown($filter = "slot"); ?> 
	<select id='slot'  name="slot" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->slot == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Job title</label>
 	<!-- <input type="text"  name="job_title" class="form-control" value="<?= (!empty($form_data) ? $form_data->job_title : ''); ?>"   placeholder="Average Rating"   /> -->
	 <?php $options = getKeywordDropdown($filter = "jobTitle"); ?> 
	<select id='job_title'  name="job_title" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->job_title == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Feedback</label>
 	<input type="text"  name="feedback" class="form-control" value="<?= (!empty($form_data) ? $form_data->feedback : ''); ?>"   placeholder="Average Rating"   />
</div>
<div class="form-group col-sm-6">
	<label>Search Credentials</label>
 	<!-- <input type="text"  name="search_cred" class="form-control" value="<?= (!empty($form_data) ? $form_data->search_cred : ''); ?>"   placeholder="Average Rating"   /> -->
	 <?php $options = getKeywordDropdown($filter = "searchCredential"); ?> 
	<select id='search_cred'  name="search_cred" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->search_cred == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Expiration date</label>
 	<input type="date"  name="expiration_date" class="form-control" value="<?= (!empty($form_data) ? $form_data->expiration_date : ''); ?>"   placeholder="Average Rating"   />
</div>
<div class="form-group col-sm-6">
	<label>Effective date</label>
 	<input type="date"  name="effective_date" class="form-control" value="<?= (!empty($form_data) ? $form_data->effective_date : ''); ?>"   placeholder="Average Rating"   />
</div>

<div class="form-group col-sm-6">
	<label>Availability</label>
	 <?php $options = getKeywordDropdown($filter = "availability"); ?> 
	<select id='availability'  name="availability" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->availability == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>


<div class="form-group col-sm-6">
	<label>Shift Duration</label>
	 <?php $options = getKeywordDropdown($filter = "shiftDuration"); ?> 
	<select id='shift_duration'  name="shift_duration" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->shift_duration == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>

<div class="form-group col-sm-6">
	<label>Assignment duration</label>
	 <?php $options = getKeywordDropdown($filter = "assignmentDuration"); ?> 
	<select id='assignment_duration'  name="assignment_duration" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->assignment_duration == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>


<div class="form-group col-sm-6">
	<label>Preferred shift</label>
	 <?php $options = getKeywordDropdown($filter = "preferredShift"); ?> 
	<select id='preferred_shift'  name="preferred_shift" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->preferred_shift == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>

<div class="form-group col-sm-6">
	<label>Preferred geography</label>
	 <?php $options = getKeywordDropdown($filter = "preferredGeography"); ?> 
	<select id='preferred_geography'  name="preferred_geography" class="form-control" >
		<option value="">Select</option>
		<?php 
		foreach($options as $dk => $dv) 
		{
			$selectop = '';
			if(!empty($form_data) && $form_data->preferred_geography == $dv['id'])
			{
				$selectop = 'selected="selected"';  
			} ?> 
			<option <?= $selectop ?> value="<?= $dv['id'] ?>"  ><?= $dv['title']?></option>
		<?php  } ?>
	</select>
</div>

<div class="form-group col-sm-6">
	<label>Earliest Start Date</label>
 	<input type="date"  name="earliest_start_date" class="form-control" value="<?= (!empty($form_data) ? $form_data->earliest_start_date : ''); ?>"   placeholder="Average Rating"   />
</div>
<!--Uncomment if Scroll Required --><div>
