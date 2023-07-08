
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<div class="form-group col-sm-6">
	<label>Fo Id</label>
 	<input type="number"  name="fo_id" class="form-control" value="<?= (!empty($form_data) ? $form_data->fo_id : ''); ?>"   placeholder="Fo Id"   />
</div>
<div class="form-group col-sm-6">
	<label>Fwt Amount</label>
 	<input type="number"  name="fwt_amount" class="form-control" value="<?= (!empty($form_data) ? $form_data->fwt_amount : ''); ?>"   placeholder="Fwt Amount"   />
</div>

<?php $options = $fwt_type; ?>
<div class="form-group col-sm-6">

	<label>Fwt Type</label>

	<select  id='fwt_type'  name="fwt_type" class="form-control" >
<?php 
 foreach($options as $dk => $dv) 
{
	 $selectop = '';
	 if(!empty($form_data) && $form_data->fwt_type == $dv)
	{
		$selectop = 'selected="selected"';  
	} ?> 
	<option <?= $selectop ?> value="<?= $dv ?>"  ><?= $dv?></option>
<?php  } ?>
	</select>
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
	<label>Ad Id</label>
 	<input type="number"  name="ad_id" class="form-control" value="<?= (!empty($form_data) ? $form_data->ad_id : ''); ?>"   placeholder="Ad Id"   />
</div>

<?php $options = $ad_type; ?>
<div class="form-group col-sm-6">

	<label>Ad Type</label>

	<select  id='ad_type'  name="ad_type" class="form-control" >
<?php 
 foreach($options as $dk => $dv) 
{
	 $selectop = '';
	 if(!empty($form_data) && $form_data->ad_type == $dv)
	{
		$selectop = 'selected="selected"';  
	} ?> 
	<option <?= $selectop ?> value="<?= $dv ?>"  ><?= $dv?></option>
<?php  } ?>
	</select>
</div>
</div>
<!--Uncomment if Scroll Required div -->
