
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">

<?php $options = $admin_id; ?>
<div class="form-group col-sm-6">

	<label>Admin Id</label>

	<select  id='admin_id'  name="admin_id" class="form-control" >
<?php 
 foreach($options as $dk => $dv) 
{
	 $selectop = '';
	 if(!empty($form_data) && $form_data->admin_id == $dv->id)
	{
		$selectop = 'selected="selected"';  
	} ?> 
	<option <?= $selectop ?> value="<?= $dv->id ?>"  ><?= $dv->id?></option>
<?php  } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Name</label>
 	<input type="text"  name="name" class="form-control" value="<?= (!empty($form_data) ? $form_data->name : ''); ?>"   placeholder="Name"   />
</div>
</div>
<!--Uncomment if Scroll Required div -->
