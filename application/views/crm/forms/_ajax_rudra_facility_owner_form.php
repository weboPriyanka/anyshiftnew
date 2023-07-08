
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<input type="hidden" required name="original_email" value="<?= (!empty($form_data) ? $form_data->fo_email : ''); ?>">
<div class="form-group col-sm-6">
	<label>First Name</label>
 	<input type="text" required name="fo_fname" class="form-control" value="<?= (!empty($form_data) ? $form_data->fo_fname : ''); ?>"   placeholder="Fname"   />
</div>
<div class="form-group col-sm-6">
	<label>Last Name</label>
 	<input type="text" required name="fo_lname" class="form-control" value="<?= (!empty($form_data) ? $form_data->fo_lname : ''); ?>"   placeholder="Lname"   />
</div>
<div class="form-group col-sm-6">
	<label>Email</label>
 	<input type="text" required name="fo_email" class="form-control" value="<?= (!empty($form_data) ? $form_data->fo_email : ''); ?>"   placeholder="Email"   />
</div>
<div class="form-group col-sm-6">
	<label>Mobile</label>
 	<input type="text" required name="fo_mobile" class="form-control" value="<?= (!empty($form_data) ? $form_data->fo_mobile : ''); ?>"   placeholder="Mobile"   />
</div>
<div class="form-group col-sm-6">
	<label>Password</label>
	<?php $password_string = '!@#$%*&abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ23456789'; $password = substr(str_shuffle($password_string), 0, 12); ?>
 	<input type="text" required name="fo_password" class="form-control" value="<?php echo (!empty($form_data->fo_password))?$form_data->fo_password:$password; ?>"   placeholder="Password" readonly   />
</div> 
<div class="form-group col-sm-6">
	<label>Profile Image</label>
 	<input type="file"  name="fo_image" class="form-control" value="<?= (!empty($form_data) ? $form_data->fo_image : ''); ?>"   placeholder="Sm Password"   />
		<?php if($form_data->fo_image){ ?>
			<a href="<?=base_url($form_data->fo_image)?>" target="_blank"><img src="<?=base_url($form_data->fo_image)?>" width="50px" /></a>
	<?php } ?>
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

<div class="form-group col-sm-12">
	<label> Amount</label>
 	<input type="number" name="fwt_amount" class="form-control" min=0 value=""   placeholder=" Amount"   />
</div>
<div class="form-group col-sm-4">
    <div class="form-check">
      <input type="checkbox" class="form-check-input" name="debit" value="1" >
      <label class="form-check-label" for="check1">Debit </label>
    </div>
</div>
</div>
<!--Uncomment if Scroll Required div -->
