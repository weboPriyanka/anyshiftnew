
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<div class="form-group col-sm-6">
	<label>Id</label>
 	<input type="number"  name="fo_id" class="form-control" value="<?= (!empty($form_data) ? $form_data->fo_id : ''); ?>"   placeholder="Fo Id"   />
</div>
<div class="form-group col-sm-6">
	<label> Total Credit</label>
 	<input type="number"  name="fw_total_credit" class="form-control" value="<?= (!empty($form_data) ? $form_data->fw_total_credit : ''); ?>"   placeholder="Total Credit"   />
</div>
<div class="form-group col-sm-6">
	<label>Used</label>
 	<input type="number"  name="fw_used" class="form-control" value="<?= (!empty($form_data) ? $form_data->fw_used : ''); ?>"   placeholder="Used"   />
</div>
<div class="form-group col-sm-6">
	<label> Balance</label>
 	<input type="number"  name="fw_balance" class="form-control" value="<?= (!empty($form_data) ? $form_data->fw_balance : ''); ?>"   placeholder="Balance"   />
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
</div>
<!--Uncomment if Scroll Required div -->
