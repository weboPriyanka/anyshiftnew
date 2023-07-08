
<ul class="list-group">
 <?php  
 if(!empty($ajax_data)) { foreach($ajax_data as $data){?>
 
	<li class="list-group-item " onclick="foShow('<?php echo $data['id'];?>','<?php echo trim($data['fo_fname']).'&nbsp;'.trim($data['fo_lname'])?>');" ><?php echo trim($data['fo_fname']).'&nbsp;'.trim($data['fo_lname']).'&nbsp;';?></li>
	<?php } }else{?>
	<li class="list-group-item">No Facility Found</li>
	<?php } ?>
</ul>

                    