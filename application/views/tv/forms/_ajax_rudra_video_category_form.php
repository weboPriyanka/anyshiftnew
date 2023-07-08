
<!--UNComment if SCROLL BAR required div class='col-sm-12' style='max-height:500px;overflow: auto;'-->
<div class='row'><input type="hidden" required name="id" value="<?= (isset($id) ? $id : 0); ?>">
<div class="form-group col-sm-6">
	<label>Cat Name</label>
 	<input type="text"  name="cat_name" class="form-control" value="<?= (!empty($form_data) ? $form_data->cat_name : ''); ?>"   placeholder="Cat Name"   />
</div>
</div>
<!--Uncomment if Scroll Required div -->
