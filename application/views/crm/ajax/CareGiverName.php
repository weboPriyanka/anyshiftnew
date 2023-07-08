<ul class="list-group">
 <?php  
 if(!empty($ajax_data)) { foreach($ajax_data as $data){?>
	<li class="list-group-item " onclick="CareShow('<?php echo $data['id'];?>','<?php echo trim($data['cg_fname']).'&nbsp;'.trim($data['cg_lname'])?>');" ><?php echo trim($data['cg_fname']).'&nbsp;'.trim($data['cg_lname']).'&nbsp;';?></li>
	<?php } }else{?>
	<li class="list-group-item">No CareGiver Found</li>
	<?php } ?>
</ul>

                    