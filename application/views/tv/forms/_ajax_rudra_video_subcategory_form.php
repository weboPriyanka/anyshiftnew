
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<div class="form-group col-sm-6">
	<label>Category Name</label>
	<select class="form-control" name="cat_id">
	  <option value="">Choose Category Name</option>
	  <?php 
	  foreach($video_categories as $cat){?>
	  <option value="<?php echo $cat->id;?>"  <?php echo (!empty($form_data)&&($form_data->cat_id==$cat->id))?'selected':''; ?>><?php echo $cat->cat_name; ?></option>
	  <?php } ?>
	</select>
</div>
<div class="form-group col-sm-6">
	<label>Sub Category Name</label>
 	<input type="text"  name="subcat_name" class="form-control" value="<?= (!empty($form_data) ? $form_data->subcat_name : ''); ?>"   placeholder="Subcat Name"   />
</div>
</div>
<!--Uncomment if Scroll Required div -->
