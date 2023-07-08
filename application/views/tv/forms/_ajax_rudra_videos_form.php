
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
	<select class="form-control" name="subcat_id">
	  <option value="">Choose Sub Category Name</option>
	  <?php 
	  foreach($subvideo_categories as $cat){?>
	  <option value="<?php echo $cat->id;?>"  <?php echo (!empty($form_data)&&($form_data->subcat_id==$cat->id))?'selected':''; ?>><?php echo $cat->subcat_name; ?></option>
	  <?php } ?>
	</select>
</div>

<div class="form-group col-sm-6">
	<label>Title</label>
 	<input type="text"  name="title" class="form-control" value="<?= (!empty($form_data) ? $form_data->title : ''); ?>"   placeholder="Title"   />
</div>

<div class="form-group col-sm-6">
	<label>Description</label>
 	<input type="text"  name="description" class="form-control" value="<?= (!empty($form_data) ? $form_data->description : ''); ?>"   placeholder="description"   />
</div>
<div class="form-group col-sm-6">
	<label>Video</label>
 	<input type="file"  name="video_url" class="form-control" value="<?= (!empty($form_data) ? $form_data->video_url : ''); ?>"   placeholder="Video Url"   />
	<?php if(!empty($form_data) && $form_data->video_url != '' ){ ?>
		<a target="_blank" href="<?=base_url('app_assets/uploads/videos/').$form_data->video_url?>"><?=$form_data->video_url?></a>
	<?php } ?>
</div>



<div class="form-group col-sm-6">
	<label>Image</label>
 	<input type="file"  name="image_url" class="form-control" value="<?= (!empty($form_data) ? $form_data->image_url : ''); ?>"   placeholder="Image Url"   />
	 <?php if(!empty($form_data) && $form_data->image_url != '' ){ ?>
		<a target="_blank" href="<?=base_url('app_assets/uploads/').$form_data->image_url?>"><img src="<?=base_url('app_assets/uploads/').$form_data->image_url?>" width="75px" /></a>
	<?php } ?>
</div>

<?php $options = $status; ?>
<div class="form-group col-sm-6">

	<label>Status</label>

	<select  id='status'  name="status" class="form-control" > 
	<option <?php if(!empty($form_data) && $form_data->status == 'active'){echo 'selected="selected"';} ?> value="Active" >Active</option>
	<option <?php if(!empty($form_data) && $form_data->status == 'inactive'){echo 'selected="selected"';} ?> value="InActive" >InActive</option>
	</select>
</div>
</div>
<!--Uncomment if Scroll Required div -->
