
<ul class="list-group">
 <?php  
 if(!empty($ajax_data)) { foreach($ajax_data as $data){?>
 
	<li class="list-group-item " onclick="smShow('<?php echo $data['id'];?>','<?php echo trim($data['sm_fname']).'&nbsp;'.trim($data['sm_lname'])?>');" ><?php echo trim($data['sm_fname']).'&nbsp;'.trim($data['sm_lname']);?></li>
	<?php } }else{?>
	<li class="list-group-item">No Shift Manager Found</li>
	<?php } ?>
</ul>

                    