
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<div class="form-group col-sm-6">
	<label>Category Name</label>
	<select class="form-control" name="fcat_id">
	  <option value="">Choose Category</option>
	  <?php 
	  foreach($categories as $category){?>
	  <option value="<?php echo $category->id;?>"  <?php echo (!empty($form_data)&&($form_data->fcat_id==$category->id))?'selected':''; ?>><?php echo $category->fc_name; ?></option>
	  <?php } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Normal Rate</label>
 	<input type="number"  name="normal_rate" class="form-control" min=0 value="<?= (!empty($form_data) ? $form_data->normal_rate : ''); ?>"   placeholder="Normal Rate"   />
</div>
<div class="form-group col-sm-6">
	<label>Premium Rate</label>
 	<input type="number"  name="premium_rate" class="form-control" min=0 value="<?= (!empty($form_data) ? $form_data->premium_rate : ''); ?>"   placeholder="Premium Rate"   />
</div>
</div>
<!--Uncomment if Scroll Required div -->
