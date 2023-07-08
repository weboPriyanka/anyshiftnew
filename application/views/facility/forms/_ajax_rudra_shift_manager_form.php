<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<input type="hidden" required name="original_email" value="<?= (!empty($form_data) ? $form_data->sm_email : ''); ?>">
<div class="form-group col-sm-6">
	<label>Fname</label>
 	<input type="text" required name="sm_fname" class="form-control" value="<?= (!empty($form_data) ? $form_data->sm_fname : ''); ?>" placeholder="Fname" />
</div>
<div class="form-group col-sm-6">
	<label>Lname</label>
 	<input type="text" required name="sm_lname" class="form-control" value="<?= (!empty($form_data) ? $form_data->sm_lname : ''); ?>" placeholder="Lname" />
</div>
<div class="form-group col-sm-6">
	<label>Email</label>
 	<input type="text" required name="sm_email" class="form-control" value="<?= (!empty($form_data) ? $form_data->sm_email : ''); ?>" placeholder="Email" />
</div>
<div class="form-group col-sm-6">
	<label>Mobile</label>
 	<input type="text" required name="sm_mobile" class="form-control" value="<?= (!empty($form_data) ? $form_data->sm_mobile : ''); ?>" placeholder="Mobile" />
</div>
<div class="form-group col-sm-6">
	<label>Password</label>
	<?php $password_string = '!@#$%*&abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ23456789'; $password = substr(str_shuffle($password_string), 0, 12); ?>
 	<input type="text" required name="sm_password" class="form-control" value="<?php echo (!empty($form_data->sm_password))?$form_data->sm_password:$password; ?>" placeholder="Password" readonly   />
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
</div>
<!--Uncomment if Scroll Required div -->